# CLAUDE.md

Guidance for Claude Code (or any future session) working in this repo.

## Deploying to production

There is no auto-deploy. This theme lives on Hostinger (rankcraftweb.com)
and changes are pushed manually over SSH after `git push`:

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
