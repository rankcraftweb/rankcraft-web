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
		<p class="hero-cta-note">Free audit = an instant automated report. Get in touch = talk it through with me directly.</p>
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

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Which one do you actually need?</h2>
		<p><strong>Building a new site, or replacing one that's holding you back?</strong> Start with <a href="/wordpress-development">WordPress development</a>.</p>
		<p><strong>Have a site already, but it's not showing up in search or ranking where it should?</strong> That's <a href="/seo-and-local-search">SEO and local search</a>.</p>
		<p><strong>Not sure what's actually wrong, just that something feels off?</strong> A <a href="/performance-audits">performance audit</a> tells you exactly what to fix before you commit to anything bigger.</p>
		<p>Most projects end up touching more than one of these; the audit is usually the fastest way to find out where to start.</p>
	</div>
</section>

<section class="service-local">
	<div class="container service-overview-inner">
		<h2>Where I work</h2>
		<p>Most of this work happens remotely and the location rarely matters. But I am based in Silang, and the businesses I end up measuring are mostly here in Cavite. If you are local, there is a page for that: <a href="/website-developer-silang-cavite">website development in Silang and Cavite</a>, including what came back when I ran nine local business websites through PageSpeed.</p>
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
