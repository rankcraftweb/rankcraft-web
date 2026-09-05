#!/usr/bin/env bash
#
# Deploy changed theme files to the live rankcraftweb.com site.
#
# Replaces deploying by hand, one scp per file, from the recipe in
# CLAUDE.md. That worked, but it asks you to remember which files a change
# touched, and the failure mode when you forget one is a live site running
# half of a change - a template calling a function that never arrived, or
# CSS for markup that is not there yet.
#
# Git already knows exactly which files changed. This script asks git.
#
# Usage:
#   bin/deploy.sh                      # print the plan, change nothing
#   bin/deploy.sh --yes                # actually deploy
#   bin/deploy.sh --check http://rankcraft-web.local --yes
#   bin/deploy.sh --all --yes          # every tracked theme file
#   bin/deploy.sh --since <ref> --yes  # override the baseline
#   bin/deploy.sh --yes --no-verify    # skip the post-deploy live check
#
# Nothing happens without --yes. A run without it is a dry run that prints
# the file list and exits, which is also the answer to "what have I not
# deployed yet?"

set -euo pipefail

SSH_KEY="$HOME/.ssh/hostinger_rankcraftweb"
SSH_PORT=65002
SSH_HOST="u803773560@37.44.245.62"
REMOTE_WP_PATH="~/domains/rankcraftweb.com/public_html"
REMOTE_THEME_PATH="$REMOTE_WP_PATH/wp-content/themes/rankcraft-web"
LIVE_URL="https://rankcraftweb.com/"

# The commit last deployed by this script, stored as a local ref. It is
# deliberately not a branch and never pushed: it records what this machine
# put on that server, which is a fact about this machine, not about the
# repo. A second machine deploying would need its own baseline, and
# --since exists for exactly that.
DEPLOY_REF="refs/deploys/production"

# Files that are tracked in git but have no business sitting in a public
# theme directory. bin/ is tooling, case-studies/ is source material for
# content that lives in the database, and the rest is documentation.
EXCLUDE_RE='^(bin/|case-studies/|\.claude/|CLAUDE\.md$|README\.md$|\.gitignore$)'

REPO_ROOT="$(git rev-parse --show-toplevel)"
cd "$REPO_ROOT"

CONFIRMED=false
CHECK_URL=""
DEPLOY_ALL=false
SINCE=""
VERIFY=true

while [ $# -gt 0 ]; do
	case "$1" in
		--yes) CONFIRMED=true ;;
		--all) DEPLOY_ALL=true ;;
		--no-verify) VERIFY=false ;;
		--check) CHECK_URL="${2:?--check needs a URL}"; shift ;;
		--since) SINCE="${2:?--since needs a git ref}"; shift ;;
		-h|--help) awk 'NR>1 && /^#/ { sub(/^# ?/, ""); print; next } NR>1 { exit }' "$0"; exit 0 ;;
		*) echo "Unknown option: $1" >&2; exit 1 ;;
	esac
	shift
done

# ---------------------------------------------------------------------------
# Preconditions
#
# All three exist to keep one promise: whatever is on that server can be
# reproduced from a commit in origin/main. Break it and the only record of
# what production is running lives on the server itself, which is the
# situation this repo exists to avoid.
# ---------------------------------------------------------------------------

BRANCH="$(git rev-parse --abbrev-ref HEAD)"
if [ "$BRANCH" != "main" ]; then
	echo "On branch '$BRANCH', not main. Deploy from main." >&2
	exit 1
fi

if [ -n "$(git status --porcelain)" ]; then
	echo "Working tree is dirty. Commit or stash first:" >&2
	git status --short >&2
	exit 1
fi

git fetch -q origin main
if [ "$(git rev-parse HEAD)" != "$(git rev-parse origin/main)" ]; then
	echo "HEAD does not match origin/main. Push (or pull) before deploying." >&2
	exit 1
fi

# ---------------------------------------------------------------------------
# Work out what to send
# ---------------------------------------------------------------------------

if $DEPLOY_ALL; then
	BASE=""
	FILES="$(git ls-files)"
	DELETED=""
else
	if [ -n "$SINCE" ]; then
		BASE="$(git rev-parse --verify "$SINCE")"
	elif ! BASE="$(git rev-parse --verify --quiet "$DEPLOY_REF")"; then
		cat >&2 <<-EOF
			No deploy baseline recorded yet, so there is nothing to diff against.

			Pick one:
			  bin/deploy.sh --all --yes          send every theme file
			  bin/deploy.sh --since <ref> --yes  diff from a commit you know is live

			After the first successful run this is recorded automatically.
		EOF
		exit 1
	fi
	FILES="$(git diff --name-only --diff-filter=ACMRT "$BASE" HEAD)"
	DELETED="$(git diff --name-only --diff-filter=D "$BASE" HEAD)"
fi

FILES="$(printf '%s\n' "$FILES" | grep -Ev "$EXCLUDE_RE" || true)"
DELETED="$(printf '%s\n' "$DELETED" | grep -Ev "$EXCLUDE_RE" || true)"

FILES="$(printf '%s\n' "$FILES" | sed '/^$/d')"
DELETED="$(printf '%s\n' "$DELETED" | sed '/^$/d')"

COUNT="$(printf '%s\n' "$FILES" | sed '/^$/d' | wc -l | tr -d ' ')"

echo "==> Deploying to rankcraftweb.com"
if [ -n "${BASE:-}" ]; then
	echo "    baseline: $(git rev-parse --short "$BASE")  ->  HEAD: $(git rev-parse --short HEAD)"
else
	echo "    every tracked theme file (--all)"
fi
echo

if [ "$COUNT" -eq 0 ]; then
	echo "Nothing to deploy - no theme files changed since the baseline."
	[ -n "$DELETED" ] && echo && echo "(but see deletions below)"
fi

if [ "$COUNT" -gt 0 ]; then
	echo "Files to upload ($COUNT):"
	printf '%s\n' "$FILES" | sed 's/^/  /'
	echo
fi

# Deletions are reported and never performed. Removing a file from a live
# theme is the one action here with no cheap undo, and a file that vanished
# from git is not always a file that should vanish from the server - it may
# have been renamed, or it may be the only copy of something. Deciding that
# is a person's job.
if [ -n "$DELETED" ]; then
	echo "Deleted in git, still on the server - remove by hand if that is right:"
	printf '%s\n' "$DELETED" | sed 's/^/  /'
	echo
fi

if ! $CONFIRMED; then
	echo "Dry run. Re-run with --yes to deploy."
	exit 0
fi

[ "$COUNT" -eq 0 ] && exit 0

# ---------------------------------------------------------------------------
# Pre-deploy check
#
# Optional, because it needs a host running the code you are about to send,
# and that is a local WordPress install this script cannot assume. When you
# can point it at one, it is the difference between catching an overflow
# bug and shipping it.
# ---------------------------------------------------------------------------

if [ -n "$CHECK_URL" ]; then
	echo "==> Checking $CHECK_URL for horizontal overflow..."
	if ! node bin/check-responsive.js "$CHECK_URL"; then
		echo >&2
		echo "Responsive check failed. Nothing was uploaded." >&2
		exit 1
	fi
	echo
else
	echo "==> No --check host given; skipping the pre-deploy responsive check."
	echo
fi

# ---------------------------------------------------------------------------
# Upload
# ---------------------------------------------------------------------------

# scp will not create intermediate directories, and a new file in a new
# subdirectory is a normal thing to add. One mkdir -p for every directory
# involved, in a single connection, before any file moves.
DIRS="$(printf '%s\n' "$FILES" | xargs -n1 dirname | sort -u | grep -v '^\.$' || true)"
if [ -n "$DIRS" ]; then
	MKDIR_ARGS="$(printf '%s\n' "$DIRS" | sed "s|^|$REMOTE_THEME_PATH/|" | tr '\n' ' ')"
	ssh -i "$SSH_KEY" -p "$SSH_PORT" "$SSH_HOST" "mkdir -p $MKDIR_ARGS"
fi

# One scp per file. Slower than a tar pipe, but it is the operation
# CLAUDE.md documents, and when it fails it fails on a named file instead
# of halfway through a stream.
N=0
while IFS= read -r f; do
	[ -z "$f" ] && continue
	N=$((N + 1))
	printf '    [%d/%d] %s\n' "$N" "$COUNT" "$f"
	scp -q -i "$SSH_KEY" -P "$SSH_PORT" "$f" "$SSH_HOST:$REMOTE_THEME_PATH/$f"
done <<< "$FILES"
echo

echo "==> Purging LiteSpeed cache..."
ssh -i "$SSH_KEY" -p "$SSH_PORT" "$SSH_HOST" \
	"cd $REMOTE_WP_PATH && wp litespeed-purge all --allow-root"
echo

# Recorded only after every upload and the purge succeeded. If the run dies
# halfway, the baseline stays where it was and the next run re-sends the
# files that did land - re-uploading an identical file is harmless, while
# skipping one that never arrived is not.
git update-ref "$DEPLOY_REF" HEAD
echo "==> Recorded $(git rev-parse --short HEAD) as deployed."
echo

if $VERIFY; then
	echo "==> Verifying the live site..."
	if ! node bin/check-responsive.js "$LIVE_URL"; then
		echo >&2
		echo "The live site now has a horizontal overflow." >&2
		echo "There is no rollback here - fix it and deploy again." >&2
		exit 1
	fi
fi

echo "==> Done. https://rankcraftweb.com/"
