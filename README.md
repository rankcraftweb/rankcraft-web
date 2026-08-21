# RankCraft Web

Custom-coded WordPress theme powering [rankcraftweb.com](https://rankcraftweb.com) — a WordPress development, SEO, and website audit service. **Live in production**, hosted on Hostinger.

No page builders. No theme bloat. Hand-coded PHP, structured data, and performance built in from the start.

## Stack

- WordPress (custom theme, no Elementor/Divi, no ACF — custom meta boxes instead)
- PHP 8+
- Vanilla JS (scroll-reveal animation, mobile nav toggle, no framework dependency)
- Hosted on Hostinger with LiteSpeed Cache and Wordfence
- Outgoing mail routed through Hostinger SMTP (see `inc/smtp.php`)

## Features

- Custom `case_study` post type for portfolio/case study content, with a hand-built meta box (`inc/case-study-meta.php`) for client name, project URL, and stat highlights — no ACF dependency
- Dedicated service pages: WordPress Development, SEO and Local Search, Performance Audits
- Blog (posts page + single post template) with featured images
- About, Contact, Privacy Policy, and Terms of Service pages
- Lightweight, no-plugin contact form with nonce verification, honeypot spam protection, and email delivery (`inc/contact-form.php`)
- JSON-LD structured data (`ProfessionalService` schema) injected via `wp_head` (`inc/schema-markup.php`)
- Hand-coded meta description, Open Graph, and Twitter Card tags per page type, no SEO plugin (`inc/seo-meta.php`)
- Responsive hamburger mobile navigation, no JS framework
- WCAG AA-compliant color contrast and visible focus states throughout
- Lightweight IntersectionObserver-based scroll animations
- Fully responsive, mobile-first layout

## Local development

1. Clone this repo into your local WordPress `wp-content/themes/` directory
2. Activate "RankCraft Web" from the WordPress admin under Appearance → Themes
3. Set a static homepage in Settings → Reading, using the `front-page.php` template, and assign a posts page for the blog (`home.php`)

## Folder structure

```
rankcraft-web/
├── style.css                        # Theme header (required by WordPress)
├── functions.php                    # Theme setup, enqueue, custom post types
├── front-page.php                   # Homepage template
├── home.php                         # Blog index (posts page) template
├── single.php                       # Single blog post template
├── index.php                        # Fallback template
├── header.php
├── footer.php
├── page-about.php
├── page-contact.php
├── page-wordpress-development.php
├── page-seo-and-local-search.php
├── page-performance-audits.php
├── page-privacy-policy.php
├── page-terms-of-service.php
├── archive-case_study.php           # Portfolio archive
├── single-case_study.php            # Single case study template
├── inc/
│   ├── schema-markup.php            # JSON-LD structured data
│   ├── seo-meta.php                 # Meta description, Open Graph, Twitter Card tags
│   ├── contact-form.php             # Contact form handler + markup
│   ├── case-study-meta.php          # Case study custom meta box
│   ├── leads.php                    # RankCraft Business System: lead capture REST endpoint
│   └── smtp.php                     # Hostinger SMTP configuration
├── bin/
│   └── deploy-case-study.sh         # Create/update case studies on production via WP-CLI over SSH
├── case-studies/
│   └── EXAMPLE/                     # Template content.html + meta.env for the script above
└── assets/
    ├── css/main.css
    ├── js/main.js
    └── images/
```

## Deploying content

There's no auto-deploy; changes go to production over SSH. See
[CLAUDE.md](CLAUDE.md) for the exact commands, including the
`bin/deploy-case-study.sh` workflow for creating case studies via
WP-CLI instead of browser-based Gutenberg editing.

## Roadmap

Initial build (case studies, contact form, About page) is complete and deployed. Candidate next steps:

- [ ] Add more portfolio case studies (only one live so far)
- [ ] Google Analytics / Search Console integration
- [ ] Grow blog cadence beyond the initial 3 posts
- [ ] Conversion tracking on the "Get your free audit" CTA
- [ ] Scheduled Wordfence scans

## License

GPL v2 or later, same as WordPress itself.
