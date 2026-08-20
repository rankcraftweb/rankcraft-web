# RankCraft Web

Custom-coded WordPress theme powering [rankcraftweb.com](https://rankcraftweb.com) — a WordPress development, SEO, and website audit service.

No page builders. No theme bloat. Hand-coded PHP, structured data, and performance built in from the start.

## Stack

- WordPress (custom theme, no Elementor/Divi)
- PHP 8+
- Vanilla JS (scroll-reveal animation, no framework dependency)
- Advanced Custom Fields (planned, for case study content management)
- Hosted on Hostinger with LiteSpeed Cache

## Features

- Custom `case_study` post type for portfolio/case study content
- JSON-LD structured data (`ProfessionalService` schema) injected via `wp_head`, following the same pattern used and validated on a live client project (see `/inc/schema-markup.php`)
- Lightweight IntersectionObserver-based scroll animations, no external animation library
- Fully responsive, mobile-first layout

## Local development

1. Clone this repo into your local WordPress `wp-content/themes/` directory
2. Activate "RankCraft Web" from the WordPress admin under Appearance → Themes
3. Set a static homepage in Settings → Reading, using the `front-page.php` template

## Folder structure

```
rankcraft-web/
├── style.css              # Theme header (required by WordPress)
├── functions.php          # Theme setup, enqueue, custom post types
├── front-page.php         # Homepage template
├── index.php              # Fallback template
├── header.php
├── footer.php
├── inc/
│   └── schema-markup.php  # JSON-LD structured data
├── template-parts/
└── assets/
    ├── css/main.css
    ├── js/main.js
    └── images/
```

## Roadmap

- [ ] Advanced Custom Fields integration for case study fields
- [ ] Case study archive and single templates
- [ ] Contact/audit request form
- [ ] About page template

## License

GPL v2 or later, same as WordPress itself.
