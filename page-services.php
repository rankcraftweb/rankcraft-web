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

<section class="process">
	<div class="container">
		<p class="section-label">Process</p>
		<h2>How the work runs</h2>
		<p class="section-intro">The same four steps whether it is a full build, an ongoing SEO engagement, or a single round of fixes. What gets done changes. The order does not.</p>
		<div class="process-timeline">
			<div class="process-rail" aria-hidden="true"><span class="process-rail-progress"></span></div>
			<ol class="process-steps">
			<li class="process-step">
				<span class="process-step-num" aria-hidden="true">01</span>
				<div class="process-step-body">
					<h3>Measure before anything changes</h3>
					<p>No work starts on a guess. I crawl the whole site and write down where it actually stands, so every decision after this has a number behind it. You get that baseline whether or not we end up working together.</p>
					<ul class="process-points">
						<li><strong>Full crawl and baseline</strong>Every page, redirect and broken link recorded before anything moves.</li>
						<li><strong>Core Web Vitals</strong>Real mobile figures for loading, responsiveness and layout stability, not a desktop score that flatters.</li>
						<li><strong>Indexing and canonicals</strong>What Google has actually indexed, and which of your pages are competing with each other.</li>
						<li><strong>Structured data</strong>What search engines can currently read about your business, and what is missing.</li>
					</ul>
				</div>
			</li>
			<li class="process-step">
				<span class="process-step-num" aria-hidden="true">02</span>
				<div class="process-step-body">
					<h3>Agree what actually gets done</h3>
					<p>Before I touch anything we settle what is worth doing and what is not. Most audit findings are not worth the hours they would cost, and saying so out loud is part of the job.</p>
					<ul class="process-points">
						<li><strong>Priority order</strong>Ranked by what moves the needle, not by what is quickest to bill for.</li>
						<li><strong>What stays out</strong>The findings I recommend ignoring, and the reason for each.</li>
						<li><strong>Time and cost</strong>A fixed scope agreed up front, so you are not discovering the price as we go.</li>
						<li><strong>What success looks like</strong>The specific numbers we expect to move, written down before the work starts.</li>
					</ul>
				</div>
			</li>
			<li class="process-step">
				<span class="process-step-num" aria-hidden="true">03</span>
				<div class="process-step-body">
					<h3>Build and fix, one change at a time</h3>
					<p>Changes go in small and reversible. When something breaks, and occasionally something does, you want to know exactly which change caused it rather than unpicking a week of work.</p>
					<ul class="process-points">
						<li><strong>Hand-built, no page builder</strong>Code written for your site, which is why these builds score 97 to 99 on mobile.</li>
						<li><strong>Tested as it goes</strong>Each change checked before the next one starts, not all at once at the end.</li>
						<li><strong>Nothing hidden</strong>You can watch the work happen rather than waiting for a reveal.</li>
						<li><strong>Reversible</strong>Every step is version controlled and can be rolled back on its own.</li>
					</ul>
				</div>
			</li>
			<li class="process-step">
				<span class="process-step-num" aria-hidden="true">04</span>
				<div class="process-step-body">
					<h3>Show what changed, then hand it over</h3>
					<p>The work ends with evidence rather than a summary. You get the same measurements from step one, run again under the same conditions, so the difference is yours to check instead of mine to claim.</p>
					<ul class="process-points">
						<li><strong>Before and after</strong>The same tests, the same conditions, side by side.</li>
						<li><strong>A record of every change</strong>What changed, when, and why it was worth doing.</li>
						<li><strong>What did not work</strong>If something failed to move the needle, that goes in the report too.</li>
						<li><strong>Handover and support</strong>Documentation you could hand to anyone, and ongoing help if you want it.</li>
					</ul>
				</div>
			</li>
			</ol>
		</div>
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
