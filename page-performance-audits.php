<?php
/**
 * Template for the Performance Audits service page (slug: performance-audits).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container">
		<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-performance.png' ); ?>" alt="" width="56" height="56" class="service-hero-icon">
		<p class="section-label">Services</p>
		<h1>Find out exactly what's slowing your site down</h1>
		<p class="service-hero-lead">A full technical audit of your existing website, speed, SEO, and technical health, with a clear, no-jargon report and a plan to fix it.</p>
		<div class="hero-cta">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary">Get in touch</a>
		</div>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Know what's broken before you fix it</h2>
		<p>Before redesigning or rebuilding anything, it's worth knowing exactly what's actually holding your site back. A slow load time, missing schema, or a broken mobile layout can quietly cost you customers without you ever knowing why. If a rebuild does turn out to be the right call, that's what <a href="/wordpress-development">custom WordPress development</a> is for.</p>
		<p>My audits go beyond an automated score. I dig into the real technical health of your site, speed, SEO, accessibility, and best practices, and translate the findings into a prioritized, plain-English list of what to fix and why it matters. Curious what that actually looks like? See <a href="/technical-seo-fixes-that-move-rankings/">5 technical SEO fixes that actually move rankings</a> and <a href="/why-your-wordpress-site-feels-slow/">why WordPress sites feel slow</a> for the specific issues I check every time, or see the results on <a href="/portfolio/rossi-real-estate">Rossi Real Estate's site</a>, audited and fixed from the ground up.</p>
	</div>
</section>

<section class="service-deliverables">
	<div class="container">
		<h2>What's included</h2>
		<ul class="skills-list">
			<li>Core Web Vitals and speed analysis</li>
			<li>Full technical SEO audit</li>
			<li>Accessibility and best-practices check</li>
			<li>Prioritized, plain-English fix list</li>
			<li>Detailed walkthrough sent by email</li>
		</ul>
	</div>
</section>

<section class="service-process">
	<div class="container">
		<h2>Get your free audit in 3 steps</h2>
		<div class="steps-grid">
			<div class="step">
				<span class="step-number">1</span>
				<h3>Submit your site</h3>
				<p>Share your website URL. Takes less than a minute.</p>
			</div>
			<div class="step">
				<span class="step-number">2</span>
				<h3>Get your audit report</h3>
				<p>I'll analyze your speed, SEO, and technical health, then send you a clear, no-jargon report.</p>
			</div>
			<div class="step">
				<span class="step-number">3</span>
				<h3>Get your results by email</h3>
				<p>I'll send you the findings by email, along with what fixing them could mean for your business. No call needed.</p>
			</div>
		</div>
	</div>
</section>

<section class="final-cta">
	<div class="container">
		<h2>Ready to see where your site stands?</h2>
		<p>Get a free, no-obligation audit of your website's speed, SEO, and technical health.</p>
		<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
	</div>
</section>

<?php get_footer(); ?>
