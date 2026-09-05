# CLAUDE.md

Guidance for Claude Code (or any future session) working in this repo.

## Deploying to production

There is no auto-deploy. This theme lives on Hostinger (rankcraftweb.com)
and changes go up over SSH after `git push`.

### bin/deploy.sh — the normal path

```bash
bin/deploy.sh                                    # print the plan, change nothing
bin/deploy.sh --yes                              # deploy
bin/deploy.sh --check http://rankcraft-web.local --yes
bin/deploy.sh --all --yes                        # every tracked theme file
```

Works out what changed by diffing `HEAD` against `refs/deploys/production`,
a local ref recording what this machine last put on that server, then
uploads exactly those files and purges LiteSpeed. On the first run there is
no baseline, so use `--all` or `--since <ref>` once and it records itself
from then on.

Nothing happens without `--yes`. A bare run is a dry run, which doubles as
the answer to "what have I not deployed yet?"

It refuses to run unless you are on `main`, the working tree is clean, and
`HEAD` matches `origin/main` — so whatever is live can always be rebuilt
from a commit that exists in the remote. Deleted files are **reported, not
removed**: that is the one action with no cheap undo, and a file gone from
git may have been renamed rather than retired.

`--check <url>` runs `check-responsive.js` against a host serving the new
code (a Local install) and aborts before uploading anything if it fails.
Without it that gate is skipped, and the only check is the one that runs
against the live site afterwards — by which point a bad layout is already
public. There is no rollback.

### By hand

For a one-off file, or when the script's preconditions are in the way:

```bash
scp -i ~/.ssh/hostinger_rankcraftweb -P 65002 <local-file> \
  u803773560@37.44.245.62:~/domains/rankcraftweb.com/public_html/wp-content/themes/rankcraft-web/<same-relative-path>

ssh -i ~/.ssh/hostinger_rankcraftweb -p 65002 u803773560@37.44.245.62 \
  "cd ~/domains/rankcraftweb.com/public_html && wp litespeed-purge all --allow-root"
```

SSH connection details:

- Host: `37.44.245.62`, Port: `65002`, User: `u803773560`
- Key: `~/.ssh/hostinger_rankcraftweb` (already authorized in Hostinger hPanel)
- WP-CLI is available on the server at `/usr/local/bin/wp` — always pass
  `--allow-root`, since the SSH user isn't `www-data`.

## The local site

Local by Flywheel serves this theme at `http://rankcraft-web.local`
(nginx on port 10004). `.claude/launch.json` attaches to it rather than
launching anything — Local starts its own nginx, so the site has to be
running in the Local app first.

The theme directory it serves is a **directory junction** to this repo:

```
C:\Users\JC\Local Sites\rankcraft-web\app\public\wp-content\themes\rankcraft-web
  ->  C:\Users\JC\Projects\rankcraft-web
```

So editing a file here changes what the local site serves, immediately, with
nothing to sync. That is the point of the junction. It replaced a second,
independent clone of this repo that Local was serving, which had drifted 124
commits and 33 theme files behind — meaning the local preview showed code
from months earlier while looking perfectly current. The old copy is parked
at `Local Sites\rankcraft-web\theme-backup-20260905` and can be deleted once
you are satisfied nothing was lost.

If the junction is ever broken (restoring the site from a Local backup will
do it), the symptom is a local site that ignores your edits. Recreate it
with the theme folder removed first:

```powershell
New-Item -ItemType Junction `
  -Path 'C:\Users\JC\Local Sites\rankcraft-web\app\public\wp-content\themes\rankcraft-web' `
  -Target 'C:\Users\JC\Projects\rankcraft-web'
```

## Checking the site before a deploy

Two scripts in `bin/`, both driving a real headless browser. They exist
because three overflow bugs and three design problems shipped unnoticed in
a single afternoon, and between them they cover the two different kinds of
mistake that caused it.

### bin/check-responsive.js

```bash
node bin/check-responsive.js                      # live site, all pages
node bin/check-responsive.js http://localhost:8080 # same pages, another host
node bin/check-responsive.js https://.../about/    # one page
```

Loads each page at thirteen widths and reports any that scroll sideways,
naming the element at fault. Exits 1 on any overflow, so it can gate a
deploy.

Only horizontal overflow, deliberately. That is the one responsive fault
that is fully objective: the document is either wider than the viewport or
it is not. Measure, spacing and appearance need judgement, and automating
them would only manufacture confidence.

The width list includes 769 and 901, one pixel past each of the theme's
breakpoints. Two of the three bugs it was written for were hiding exactly
there, between the widths being spot checked.

### bin/screenshot.js

```bash
node bin/screenshot.js https://rankcraftweb.com/
node bin/screenshot.js https://rankcraftweb.com/ --selector "#services .services-grid"
node bin/screenshot.js http://localhost:8080/ --width 375 --full --out mobile.png
```

Photographs a page or one element on it, at 2x.

Use it whenever a change is visual. Measurements will not tell you that an
illustration is floating in a half-empty frame, that a drawing is too pale
to register against the card behind it, or that a card's contents are in
the wrong order. All three of those shipped past a full set of passing
checks, and every one measured identically to the version that replaced
it.

It also works where the editor's browser pane does not: IntersectionObserver
never fires there while the pane is hidden, so anything behind the scroll
reveal photographs as a blank rectangle. The script scrolls the page first
for the same reason.

### Playwright

Neither script declares a dependency. This theme has no build step and no
package.json, so `bin/lib/find-playwright.js` locates the copy already on
the machine, including the one in the npx cache, and falls back to the
installed Chrome if the bundled Chromium is missing or the wrong revision.
If it cannot find anything: `npm i -D playwright`.

## Creating or updating case studies via WP-CLI

Browser-based Gutenberg editing is slow and unreliable for long case study
content with embedded images. Use `bin/deploy-case-study.sh` instead — it
creates the post and sets every field `inc/case-study-meta.php` expects,
over SSH, from local files.

### Usage

1. Create a directory anywhere (a natural spot is `case-studies/<client-name>/`)
   containing:
   - `content.html` — the post body as Gutenberg block markup (the same
     `<!-- wp:paragraph -->` style format the post_content column expects)
   - `meta.env` — a bash-sourced KEY=VALUE file with the case study's
     metadata; see `case-studies/EXAMPLE/meta.env` for the full format
     (title, client name, project URL, up to 4 stat pairs, and an
     optional featured image)
2. Run:
   ```bash
   bin/deploy-case-study.sh case-studies/<client-name>
   ```
3. The script prints the new post ID, the wp-admin edit link, and the
   live view link. Verify in the browser before considering it done.

### What it does, step by step

```bash
# 1. Upload the content file to a scratch dir on the server
scp -i ~/.ssh/hostinger_rankcraftweb -P 65002 content.html \
  u803773560@37.44.245.62:~/case-study-uploads/content.html

# 2. Create the post from that file (--porcelain returns just the ID)
wp post create ~/case-study-uploads/content.html \
  --post_type=case_study --post_title="..." --post_status=publish \
  --porcelain --allow-root

# 3. Set the custom fields inc/case-study-meta.php reads
wp post meta update <post_id> _rc_client_name "..." --allow-root
wp post meta update <post_id> _rc_project_url "..." --allow-root
wp post meta update <post_id> _rc_stat_1_number "99" --allow-root
wp post meta update <post_id> _rc_stat_1_label "Performance (mobile)" --allow-root
# ...repeat for stats 2-4 as needed

# 4a. Featured image from an already-uploaded attachment ID
wp post meta update <post_id> _thumbnail_id <attachment_id> --allow-root

# 4b. Or upload a new local image and set it as featured in one step
scp -i ~/.ssh/hostinger_rankcraftweb -P 65002 image.jpg \
  u803773560@37.44.245.62:~/case-study-uploads/image.jpg
wp media import ~/case-study-uploads/image.jpg --post_id=<post_id> \
  --featured_image --title="..." --allow-root
```

### Gotcha: filtering `wp post list` by ID

`wp post list --include=<id>` does **not** filter as you'd expect (it
silently returns the whole list). Use `--post__in=<id>` instead — that's
the actual `WP_Query` argument name and it works correctly:

```bash
wp post list --post_type=case_study --post__in=<post_id> \
  --fields=ID,post_title,post_status --allow-root
```

Confirmed against WP-CLI 2.12.0 / WordPress 7.0.4 on this Hostinger
account, 2026-08-21.
