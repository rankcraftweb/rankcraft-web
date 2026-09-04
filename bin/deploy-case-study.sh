#!/usr/bin/env bash
#
# Deploy a case study to the live rankcraftweb.com site via WP-CLI over SSH.
# Replaces browser-based Gutenberg editing for long content with embedded
# images, which has been slow and unreliable.
#
# Usage:
#   bin/deploy-case-study.sh path/to/case-study-dir
#
# The directory must contain:
#   content.html   Gutenberg block markup for the post body
#                  (the same <!-- wp:paragraph --> style format
#                  inc/case-study-meta.php expects in post_content)
#   meta.env       KEY=VALUE metadata, see case-studies/EXAMPLE/meta.env
#
# Run from anywhere inside the repo; paths in meta.env are resolved
# relative to the case study directory, not the current shell location.

set -euo pipefail

SSH_KEY="$HOME/.ssh/hostinger_rankcraftweb"
SSH_PORT=65002
SSH_HOST="u803773560@37.44.245.62"
REMOTE_WP_PATH="~/domains/rankcraftweb.com/public_html"
REMOTE_SCRATCH="~/case-study-uploads"

ssh_cmd() {
	ssh -i "$SSH_KEY" -p "$SSH_PORT" "$SSH_HOST" "cd $REMOTE_WP_PATH && $1"
}

DIR="${1:?Usage: bin/deploy-case-study.sh path/to/case-study-dir}"
CONTENT_FILE="$DIR/content.html"
META_FILE="$DIR/meta.env"

[ -f "$CONTENT_FILE" ] || { echo "Missing $CONTENT_FILE"; exit 1; }
[ -f "$META_FILE" ] || { echo "Missing $META_FILE"; exit 1; }

# shellcheck disable=SC1090
source "$META_FILE"

: "${TITLE:?TITLE is required in meta.env}"
: "${CLIENT_NAME:?CLIENT_NAME is required in meta.env}"
: "${PROJECT_URL:?PROJECT_URL is required in meta.env}"

echo "==> Uploading content file..."
ssh -i "$SSH_KEY" -p "$SSH_PORT" "$SSH_HOST" "mkdir -p $REMOTE_SCRATCH"
scp -i "$SSH_KEY" -P "$SSH_PORT" "$CONTENT_FILE" "$SSH_HOST:$REMOTE_SCRATCH/content.html"

# Defaults to publish so existing meta.env files behave exactly as before.
# Set POST_STATUS="draft" to stage one for review first.
POST_STATUS="${POST_STATUS:-publish}"

echo "==> Creating post (status: $POST_STATUS)..."
POST_ID=$(ssh_cmd "wp post create $REMOTE_SCRATCH/content.html --post_type=case_study --post_title='$TITLE' --post_status='$POST_STATUS' --porcelain --allow-root")
echo "Created post ID: $POST_ID"

# The excerpt is not decoration: the theme uses post_excerpt as the meta
# description for case studies, so a post without one ships with no
# description at all. Every case study already on the site has one, which
# means they were being set by hand after this script ran.
#
# It travels as a file rather than a command-line argument. An excerpt is a
# sentence of prose - apostrophes, commas, em dashes - and quoting that
# through ssh into wp is how you get a truncated field or a shell error.
if [ -n "${EXCERPT:-}" ]; then
	echo "==> Setting excerpt..."
	printf '%s' "$EXCERPT" > "$DIR/.excerpt.tmp"
	scp -i "$SSH_KEY" -P "$SSH_PORT" "$DIR/.excerpt.tmp" "$SSH_HOST:$REMOTE_SCRATCH/excerpt.txt"
	rm -f "$DIR/.excerpt.tmp"
	ssh_cmd 'wp post update '"$POST_ID"' --post_excerpt="$(cat '"$REMOTE_SCRATCH"'/excerpt.txt)" --allow-root'
fi

echo "==> Setting meta fields..."
ssh_cmd "wp post meta update $POST_ID _rc_client_name '$CLIENT_NAME' --allow-root"
ssh_cmd "wp post meta update $POST_ID _rc_project_url '$PROJECT_URL' --allow-root"

for i in 1 2 3 4; do
	num_var="STAT${i}_NUMBER"
	label_var="STAT${i}_LABEL"
	num_val="${!num_var:-}"
	label_val="${!label_var:-}"
	if [ -n "$num_val" ] && [ -n "$label_val" ]; then
		ssh_cmd "wp post meta update $POST_ID _rc_stat_${i}_number '$num_val' --allow-root"
		ssh_cmd "wp post meta update $POST_ID _rc_stat_${i}_label '$label_val' --allow-root"
	fi
done

echo "==> Setting featured image..."
if [ -n "${FEATURED_IMAGE_ID:-}" ]; then
	ssh_cmd "wp post meta update $POST_ID _thumbnail_id '$FEATURED_IMAGE_ID' --allow-root"
elif [ -n "${FEATURED_IMAGE:-}" ]; then
	IMAGE_PATH="$DIR/$FEATURED_IMAGE"
	[ -f "$IMAGE_PATH" ] || { echo "Missing $IMAGE_PATH"; exit 1; }
	IMAGE_BASENAME=$(basename "$IMAGE_PATH")
	scp -i "$SSH_KEY" -P "$SSH_PORT" "$IMAGE_PATH" "$SSH_HOST:$REMOTE_SCRATCH/$IMAGE_BASENAME"
	ssh_cmd "wp media import $REMOTE_SCRATCH/$IMAGE_BASENAME --post_id=$POST_ID --featured_image --title='$TITLE' --allow-root"
else
	echo "(no featured image specified in meta.env, skipping)"
fi

echo "==> Cleaning up remote scratch files..."
ssh_cmd "rm -rf $REMOTE_SCRATCH" || true

SLUG=$(ssh_cmd "wp post get $POST_ID --field=post_name --allow-root")

echo
echo "==> Done."
ssh_cmd "wp post list --post_type=case_study --post__in=$POST_ID --fields=ID,post_title,post_status --allow-root"
echo "Edit: https://rankcraftweb.com/wp-admin/post.php?post=$POST_ID&action=edit"
echo "View: https://rankcraftweb.com/portfolio/$SLUG"
