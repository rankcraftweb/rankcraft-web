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
			<a href="/wordpress-development" class="service-card">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-development.png' ); ?>" alt="" width="48" height="48" loading="lazy">
				<h3>WordPress development</h3>
				<p>Custom-built WordPress sites, hand-coded or built with tools like Elementor depending on what the project needs, always optimized to load fast and stay easy to manage.</p>
				<span class="link-arrow">Learn more →</span>
			</a>
			<a href="/seo-and-local-search" class="service-card">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-seo.png' ); ?>" alt="" width="48" height="48" loading="lazy">
				<h3>SEO and local search</h3>
				<p>On-page optimization, structured data, and local search strategy that help the right customers find you first.</p>
				<span class="link-arrow">Learn more →</span>
			</a>
			<a href="/performance-audits" class="service-card">
				<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-performance.png' ); ?>" alt="" width="48" height="48" loading="lazy">
				<h3>Performance audits</h3>
				<p>A full technical audit of your existing site. I'll show you what's slowing you down and how to fix it.</p>
				<span class="link-arrow">Learn more →</span>
			</a>
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
	<div class="container process-inner">
		<div class="process-intro">
			<p class="section-label">Process</p>
			<h2>How the work runs</h2>
			<p class="section-intro">The same four steps whether it is a full build, an ongoing SEO engagement, or a single round of fixes. What gets done changes. The order does not.</p>
		</div>
		<div class="process-timeline">
			<div class="process-rail" aria-hidden="true"><span class="process-rail-progress"></span></div>
			<ol class="process-steps">
			<li class="process-step">
				<span class="process-step-num" aria-hidden="true">01</span>
				<div class="process-step-body">
					<span class="process-step-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M3.5 17a9 9 0 1 1 17 0"/><path d="M12 17l4-5"/><circle cx="12" cy="17" r="1.3" fill="currentColor" stroke="none"/></svg></span>
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
					<span class="process-step-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M9 5.5H6.5A1.5 1.5 0 0 0 5 7v12a1.5 1.5 0 0 0 1.5 1.5h11A1.5 1.5 0 0 0 19 19V7a1.5 1.5 0 0 0-1.5-1.5H15"/><rect x="9" y="3.5" width="6" height="3.5" rx="1"/><path d="M8.75 13.5l2.25 2.25 4.25-4.5"/></svg></span>
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
					<span class="process-step-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M8 7.5L3.5 12 8 16.5"/><path d="M16 7.5L20.5 12 16 16.5"/><path d="M13.5 4.5l-3 15"/></svg></span>
					<h3>Build and fix, one change at a time</h3>
					<p>Changes go in small and reversible. When something breaks, and occasionally something does, you want to know exactly which change caused it rather than unpicking a week of work.</p>
					<ul class="process-points">
						<li><strong>Built lean either way</strong>Hand-coded or on a page builder, whichever the project calls for, but what ships is stripped of everything the site does not use. That is what holds these builds at 97 to 99 on mobile.</li>
						<li><strong>Tested as it goes</strong>Each change checked before the next one starts, not all at once at the end.</li>
						<li><strong>Nothing hidden</strong>You can watch the work happen rather than waiting for a reveal.</li>
						<li><strong>Reversible</strong>Every step is version controlled and can be rolled back on its own.</li>
					</ul>
				</div>
			</li>
			<li class="process-step">
				<span class="process-step-num" aria-hidden="true">04</span>
				<div class="process-step-body">
					<span class="process-step-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 4.5v15h16"/><path d="M7.5 15l3.5-3.75 3 2.5L19.5 8"/><path d="M15.75 8h3.75v3.75"/></svg></span>
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
			<p class="process-outro"><a href="/portfolio">See what that produced in the portfolio &rarr;</a></p>
		</div>
	</div>
</section>

<section class="pricing">
	<div class="container">
		<p class="section-label">Pricing</p>
		<h2>What it costs</h2>
		<p class="section-intro">Starting figures rather than "contact us for a quote". If your budget is well under these, it is better that we both find that out now instead of after two emails.</p>
		<div class="services-grid">
			<div class="service-card">
				<span class="price-figure">from &#8369;45,000</span>
				<h3>Website build</h3>
				<p>A custom WordPress site built for speed rather than assembled from a template. What moves the final figure is the number of pages and how much of the content already exists.</p>
			</div>
			<div class="service-card">
				<span class="price-figure">&#8369;25,000<span class="price-unit">&nbsp;/ month</span></span>
				<h3>SEO and local search</h3>
				<p>Technical fixes, on-page work and local signals, with a report every month. Three month minimum, because nothing in search moves faster than that and a shorter run would only prove nothing.</p>
			</div>
			<div class="service-card">
				<span class="price-figure">&#8369;12,000</span>
				<h3>Manual audit</h3>
				<p>A technical review done by hand, which is a different thing from the automated one. Deducted from the cost if you go ahead with a build or a retainer afterwards.</p>
			</div>
		</div>
		<!-- TEMPORARY: launch offer. Delete this note and the paragraph
		     below once there are enough case studies, otherwise it stops
		     being a discount and quietly becomes the price.
		     Deliberately carries no count and no deadline: either would be
		     a claim about availability that nothing here can keep true, and
		     a stale one would sit in the pricing section of a site whose
		     whole argument is that it does not overstate things. -->
		<div class="pricing-offer">
			<p><strong>&#8369;10,000 off</strong> in exchange for a review and permission to write the work up as a case study using your real numbers. Say so at the quote stage.</p>
		</div>

		<div class="pricing-notes">
			<p>After launch, hosting and maintenance is <strong>&#8369;3,500 a month</strong>: hosting, updates, backups, security monitoring, and up to an hour of small changes. Anything bigger is quoted before it starts, never after.</p>
			<p>The automated audit stays free, and always will. That one is a tool, not a service.</p>
			<p>Prices are in Philippine pesos. Working from outside the Philippines? Get in touch and I will quote for your market.</p>
		</div>
	</div>
</section>

<section class="not-a-fit">
	<div class="container service-overview-inner">
		<p class="section-label">Fit</p>
		<h2>When I am not the right person</h2>
		<p class="section-intro">Saying this here saves us both an email chain.</p>
		<ul class="not-a-fit-list">
			<li><strong>You need it live next week.</strong>A custom build takes two to four weeks. I would rather turn the work down than rush it and hand you something I would not put in the portfolio.</li>
			<li><strong>You want a guaranteed position in search.</strong>Nobody can promise that, and anyone who does is either guessing or selling you something else. I can tell you what is holding the site back, and fix it. Where it lands after that is Google’s call.</li>
			<li><strong>You are looking for the cheapest quote.</strong>There is always someone cheaper, and for a simple brochure site they may well be the right answer. This costs more because it is measured first, tested as it goes, and written down.</li>
			<li><strong>You want someone who will just do what they are told.</strong>The work starts by measuring, and sometimes what that turns up is that the thing you asked for is not the thing that will help. I will say so before starting rather than after invoicing. If you would rather skip that conversation, we will both end up frustrated.</li>
		</ul>
	</div>
</section>

<section class="service-local">
	<div class="container service-overview-inner">
		<h2>Where I work</h2>
		<p>Most of this work happens remotely and the location rarely matters. But I am based in Silang, and the businesses I end up measuring are mostly here in Cavite. If you are local, there is a page for that: <a href="/website-developer-silang-cavite">website development in Silang and Cavite</a>, including what came back when I ran nine local business websites through PageSpeed.</p>
	</div>
</section>

<section class="about-cta about-cta--shaded">
	<div class="container">
		<h2>Not sure which one you need?</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
