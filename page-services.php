<?php
/**
 * Template for the Services hub page (slug: services).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container">
		<p class="section-label">Services</p>
		<h1>WordPress development, SEO, and performance audits</h1>
		<p class="service-hero-lead">Three ways to work together, each one built around the same goal: a site that loads fast, ranks well, and actually brings in business.</p>
		<div class="hero-cta">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary">Get in touch</a>
		</div>
	</div>
</section>

<section class="services">
	<div class="container">
		<h2>What I do</h2>
		<div class="services-grid">
			<div class="service-card">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-development.png' ); ?>" alt="" width="48" height="48" loading="lazy">
				<h3>WordPress development</h3>
				<p>Custom-built WordPress sites, hand-coded or built with tools like Elementor depending on what the project needs, always optimized to load fast and stay easy to manage.</p>
				<a href="/wordpress-development" class="link-arrow">Learn more →</a>
			</div>
			<div class="service-card">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-seo.png' ); ?>" alt="" width="48" height="48" loading="lazy">
				<h3>SEO and local search</h3>
				<p>On-page optimization, structured data, and local search strategy that help the right customers find you first.</p>
				<a href="/seo-and-local-search" class="link-arrow">Learn more →</a>
			</div>
			<div class="service-card">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-performance.png' ); ?>" alt="" width="48" height="48" loading="lazy">
				<h3>Performance audits</h3>
				<p>A full technical audit of your existing site. I'll show you what's slowing you down and how to fix it.</p>
				<a href="/performance-audits" class="link-arrow">Learn more →</a>
			</div>
		</div>
	</div>
</section>

<section class="about-cta">
	<div class="container">
		<h2>Not sure which one you need?</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
