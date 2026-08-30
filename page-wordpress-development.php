<?php
/**
 * Template for the WordPress Development service page (slug: wordpress-development).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container">
		<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-development.png' ); ?>" alt="" width="56" height="56" class="service-hero-icon">
		<p class="section-label">Services</p>
		<h1>WordPress development built to perform</h1>
		<p class="service-hero-lead">Hand-coded or built with tools like Elementor depending on what the project needs, always optimized for speed and search. I build clean, fast WordPress sites tailored to your business.</p>
		<div class="hero-cta">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary">Get in touch</a>
		</div>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Websites built to convert, not just look nice</h2>
		<p>A good-looking site that loads slowly or doesn't rank won't grow your business. I build every site the way it needs to be built, hand-coded or with tools like Elementor, always optimized so it loads fast, ranks well, and holds up as your business grows. Not sure which approach fits your project? <a href="/elementor-vs-custom-wordpress-theme-which-one-actually-fits-your-business/">Here's how I decide</a>, using <a href="/portfolio/ironclad-sites-case-study">Ironclad Sites</a> as an example.</p>
		<p>That means a custom theme built around your content and goals, not a generic template stretched to fit. Every build includes structured data, accessible markup, and a foundation that's easy to maintain, the same groundwork that makes <a href="/seo-and-local-search">SEO and local search</a> work effective from day one.</p>
		<p>And because I handle every project personally, you're never waiting on a queue of other clients or explaining your business to a new account manager. Not sure a rebuild is even what you need? A <a href="/performance-audits">performance audit</a> will tell you first.</p>
	</div>
</section>

<section class="service-deliverables">
	<div class="container">
		<h2>What I build</h2>
		<div class="sub-services">
			<div class="sub-service">
				<h3>Custom WordPress Themes</h3>
				<p>Built for your site rather than a theme bought and bent into shape. Responsive and checked at thirteen widths, not two, because most responsive faults hide between the sizes people think to test. These builds land at 97 to 99 on mobile.</p>
			</div>
			<div class="sub-service">
				<h3>Page Builder Builds</h3>
				<p>Not every project needs a hand-coded theme, and pretending otherwise costs you money. Where Elementor is the right answer I use it, then strip what the page does not need so the result stays fast.</p>
			</div>
			<div class="sub-service">
				<h3>Plugin Development &amp; Integration</h3>
				<p>Custom functionality for when nothing off the shelf fits: REST endpoints, forms that post into other systems, admin screens for the data your business actually keeps. The free audit tool talks to this site that way.</p>
			</div>
			<div class="sub-service">
				<h3>Maintenance &amp; Support</h3>
				<p>Updates, backups and security monitoring after launch, with one person to reach rather than a ticket queue. Priced separately so you are not paying for it inside the build.</p>
			</div>
		</div>
	</div>
</section>

<section class="about-cta">
	<div class="container">
		<h2>Ready to build a site that works as hard as you do?</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
