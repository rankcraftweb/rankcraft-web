<?php
/**
 * Homepage template.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<main id="free-audit">

	<section class="hero">
		<div class="container hero-inner">
			<div class="hero-text">
				<h1>Fast, findable, and built to convert.</h1>
				<p class="hero-subhead">RankCraft builds WordPress websites engineered for speed and search, not just good looks. Get a free audit and see exactly where your site stands.</p>
				<div class="hero-cta">
					<a href="#audit-form" class="btn btn-primary">Get your free audit</a>
					<a href="/portfolio" class="btn btn-secondary">View our work</a>
				</div>
			</div>
			<div class="hero-visual">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/hero-dashboard-mockup.png' ); ?>" alt="Website audit report dashboard showing performance, SEO, and accessibility scores" width="1400" height="1000">
			</div>
		</div>
	</section>

	<section class="proof">
		<div class="container">
			<p class="section-label">Real results, not promises</p>
			<h2>From a slow, unranked site to a 100/100 SEO score</h2>
			<p>Michael Rossi needed a website to serve two real estate markets, New York and Florida. He needed more than a nice design. He needed a site that loaded fast, ranked well, and actually brought in leads.</p>

			<div class="stat-row">
				<div class="stat"><span class="stat-number">99</span><span class="stat-label">Performance (mobile)</span></div>
				<div class="stat"><span class="stat-number">100</span><span class="stat-label">SEO</span></div>
				<div class="stat"><span class="stat-number">100</span><span class="stat-label">Best practices</span></div>
				<div class="stat"><span class="stat-number">3</span><span class="stat-label">Valid schema items</span></div>
			</div>

			<a href="/portfolio/rossi-real-estate" class="link-arrow">Read the full case study →</a>
		</div>
	</section>

	<section class="services" id="services">
		<div class="container">
			<h2>What we do</h2>
			<div class="services-grid">
				<div class="service-card">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-development.png' ); ?>" alt="" width="48" height="48" loading="lazy">
					<h3>WordPress development</h3>
					<p>Custom-built WordPress sites. No bloated page builders, just clean code built to scale with your business.</p>
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
					<p>A full technical audit of your existing site. We'll show you what's slowing you down and how to fix it.</p>
					<a href="/performance-audits" class="link-arrow">Learn more →</a>
				</div>
			</div>
		</div>
	</section>

	<section class="how-it-works">
		<div class="container">
			<h2>Get your free audit in 3 steps</h2>
			<div class="steps-grid">
				<div class="step">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/step-icon-1-submit.png' ); ?>" alt="" width="48" height="48" loading="lazy">
					<h3>Submit your site</h3>
					<p>Share your website URL. Takes less than a minute.</p>
				</div>
				<div class="step">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/step-icon-2-report.png' ); ?>" alt="" width="48" height="48" loading="lazy">
					<h3>Get your audit report</h3>
					<p>We'll analyze your speed, SEO, and technical health, then send you a clear, no-jargon report.</p>
				</div>
				<div class="step">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/step-icon-3-call.png' ); ?>" alt="" width="48" height="48" loading="lazy">
					<h3>Book a free call</h3>
					<p>We'll walk you through the findings and what fixing them could mean for your business.</p>
				</div>
			</div>
			<div id="audit-form" class="audit-form-anchor">
				<a href="#" class="btn btn-primary">Get your free audit</a>
			</div>
		</div>
	</section>

	<section class="about-preview">
		<div class="container about-preview-inner">
			<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/about-headshot.png' ); ?>" alt="Jan, founder of RankCraft Web" class="about-headshot" width="150" height="150" loading="lazy">
			<div class="about-text">
				<h2>Built by someone who does the work himself</h2>
				<p>RankCraft is run by Jan, a WordPress developer and SEO specialist who manages every project personally, from first audit to final launch. No account managers, no outsourcing. Just direct, hands-on work.</p>
				<a href="/about" class="link-arrow">More about Jan →</a>
			</div>
		</div>
	</section>

	<section class="faq">
		<div class="container faq-inner">
			<h2>Frequently asked questions</h2>
			<div class="faq-list">
				<details class="faq-item">
					<summary>Do you build websites, help with SEO, or both?</summary>
					<p>Both. Most clients come to me for a WordPress build and ongoing technical SEO, since the two are hard to separate: a site that isn't built right technically will never rank as well as it should.</p>
				</details>
				<details class="faq-item">
					<summary>What type of businesses do you work with?</summary>
					<p>Mostly service-based businesses, real estate, home services, and local businesses that depend on their website to bring in leads, not just look good.</p>
				</details>
				<details class="faq-item">
					<summary>Can you work with my existing website, or does it need a full rebuild?</summary>
					<p>It depends on what's underneath. Sometimes a technical audit and targeted fixes are enough. Other times a rebuild is genuinely faster and cheaper long-term. I'll tell you honestly which one your site needs.</p>
				</details>
				<details class="faq-item">
					<summary>Will my website be mobile-friendly?</summary>
					<p>Yes. Every site I build is responsive and tested across devices, and mobile performance is part of every technical SEO audit since Google evaluates the mobile experience first.</p>
				</details>
				<details class="faq-item">
					<summary>How long does a typical project take?</summary>
					<p>A custom WordPress build usually takes 2 to 4 weeks depending on scope. Audits and SEO fixes move faster, often within a week of the initial call.</p>
				</details>
				<details class="faq-item">
					<summary>Do you offer support after the site launches?</summary>
					<p>Yes. I offer ongoing maintenance and support after launch, hosting, updates, and changes, so you're never stuck if something needs fixing down the line.</p>
				</details>
			</div>
		</div>
	</section>

	<section class="final-cta">
		<div class="container">
			<h2>Ready to see where your site stands?</h2>
			<p>Get a free, no-obligation audit of your website's speed, SEO, and technical health.</p>
			<a href="#free-audit" class="btn btn-primary">Get your free audit</a>
		</div>
	</section>

</main>

<?php get_footer(); ?>
