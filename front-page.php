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
				<h1>Fast WordPress sites and technical SEO, built end to end by one developer.</h1>
				<p class="hero-subhead">Speed and search built in from the start, not bolted on after. Sites I've built score 97 to 99 on Google PageSpeed. Get a free audit and see where yours stands.</p>
				<div class="hero-cta">
					<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
					<a href="/portfolio" class="btn btn-secondary">See my work</a>
				</div>
			</div>
			<div class="hero-visual">
				<?php
				/*
				 * Hand-drawn SVG rather than a rendered image: it's the LCP
				 * element, so inlining it costs no extra request, it stays
				 * sharp on any display, and every label is real text instead
				 * of the garbled type stock/AI mockups tend to bake in.
				 */
				?>
				<svg class="hero-visual-svg" viewBox="0 0 620 520" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="rc-hero-visual-title">
					<title id="rc-hero-visual-title">A website mockup surrounded by result cards: a 99 performance score, a perfect SEO score, and a rising organic traffic chart.</title>

					<defs>
						<linearGradient id="rc-screen" x1="0" y1="0" x2="0" y2="1">
							<stop offset="0" stop-color="#0E2E4E"/>
							<stop offset="1" stop-color="#0A2440"/>
						</linearGradient>
						<linearGradient id="rc-card" x1="0" y1="0" x2="1" y2="1">
							<stop offset="0" stop-color="#153E66"/>
							<stop offset="1" stop-color="#102F52"/>
						</linearGradient>
						<linearGradient id="rc-base" x1="0" y1="0" x2="0" y2="1">
							<stop offset="0" stop-color="#1B4571"/>
							<stop offset="1" stop-color="#102E4D"/>
						</linearGradient>
						<linearGradient id="rc-area" x1="0" y1="0" x2="0" y2="1">
							<stop offset="0" stop-color="#1D9E75" stop-opacity=".38"/>
							<stop offset="1" stop-color="#1D9E75" stop-opacity="0"/>
						</linearGradient>
						<radialGradient id="rc-glow" cx="50%" cy="45%" r="62%">
							<stop offset="0" stop-color="#1D9E75" stop-opacity=".16"/>
							<stop offset="1" stop-color="#1D9E75" stop-opacity="0"/>
						</radialGradient>
					</defs>

					<ellipse cx="330" cy="250" rx="300" ry="230" fill="url(#rc-glow)"/>

					<!-- Laptop -->
					<rect x="150" y="88" width="400" height="256" rx="12" fill="#16406B"/>
					<rect x="162" y="100" width="376" height="232" rx="6" fill="url(#rc-screen)"/>
					<path d="M148 344 H552 L588 382 H112 Z" fill="url(#rc-base)" stroke="#24547F" stroke-width="2" stroke-linejoin="round"/>
					<path d="M152 347 H548" stroke="#2A5F92" stroke-width="2" opacity=".55"/>

					<!-- Browser chrome -->
					<path d="M162 106a6 6 0 0 1 6-6h364a6 6 0 0 1 6 6v26H162Z" fill="#123A61"/>
					<circle cx="180" cy="116" r="4" fill="#2C5F8E"/>
					<circle cx="194" cy="116" r="4" fill="#2C5F8E"/>
					<circle cx="208" cy="116" r="4" fill="#2C5F8E"/>
					<rect x="228" y="108" width="210" height="16" rx="8" fill="#0A2440"/>
					<rect x="237" y="114" width="7" height="6" rx="1.5" fill="#63C89F"/>
					<path d="M238.6 114v-1.8a1.9 1.9 0 0 1 3.8 0V114" fill="none" stroke="#63C89F" stroke-width="1.2"/>
					<rect x="252" y="114" width="90" height="5" rx="2.5" fill="#35618C"/>

					<!-- Page being built -->
					<rect x="190" y="158" width="186" height="16" rx="4" fill="#F4F6F9" opacity=".92"/>
					<rect x="190" y="184" width="248" height="9" rx="4.5" fill="#4A7BA7"/>
					<rect x="190" y="200" width="196" height="9" rx="4.5" fill="#4A7BA7" opacity=".7"/>
					<rect x="190" y="224" width="96" height="28" rx="7" fill="#1D9E75"/>
					<rect x="296" y="224" width="88" height="28" rx="7" fill="none" stroke="#63C89F" stroke-width="1.5" opacity=".7"/>

					<g fill="#123A61">
						<rect x="190" y="272" width="104" height="44" rx="6"/>
						<rect x="306" y="272" width="104" height="44" rx="6"/>
						<rect x="422" y="272" width="104" height="44" rx="6"/>
					</g>
					<g fill="#63C89F">
						<rect x="202" y="284" width="30" height="5" rx="2.5"/>
						<rect x="318" y="284" width="30" height="5" rx="2.5"/>
						<rect x="434" y="284" width="30" height="5" rx="2.5"/>
					</g>
					<g fill="#3C6E9C">
						<rect x="202" y="296" width="68" height="4" rx="2"/>
						<rect x="318" y="296" width="68" height="4" rx="2"/>
						<rect x="434" y="296" width="68" height="4" rx="2"/>
					</g>
					<g fill="#3C6E9C" opacity=".7">
						<rect x="202" y="305" width="48" height="4" rx="2"/>
						<rect x="318" y="305" width="48" height="4" rx="2"/>
						<rect x="434" y="305" width="48" height="4" rx="2"/>
					</g>

					<!-- Performance score -->
					<g>
						<rect x="34" y="140" width="190" height="104" rx="14" fill="url(#rc-card)" stroke="#2A5F92" stroke-width="1.5"/>
						<circle cx="79" cy="192" r="27" fill="none" stroke="#1E4A72" stroke-width="8"/>
						<circle cx="79" cy="192" r="27" fill="none" stroke="#1D9E75" stroke-width="8" stroke-linecap="round" stroke-dasharray="168 170" transform="rotate(-90 79 192)"/>
						<text x="79" y="199" text-anchor="middle" font-family="Poppins, sans-serif" font-size="19" font-weight="700" fill="#F4F6F9">99</text>
						<text x="122" y="186" font-family="Poppins, sans-serif" font-size="13.5" font-weight="600" fill="#63C89F">Performance</text>
						<text x="122" y="204" font-family="Poppins, sans-serif" font-size="11.5" fill="#7FA0C4">PageSpeed</text>
					</g>

					<!-- SEO score -->
					<g>
						<rect x="452" y="44" width="142" height="52" rx="12" fill="url(#rc-card)" stroke="#2A5F92" stroke-width="1.5"/>
						<circle cx="481" cy="70" r="13" fill="#1D9E75" opacity=".18"/>
						<path d="M475.5 70l4 4 8.5-9" fill="none" stroke="#63C89F" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
						<text x="506" y="66" font-family="Poppins, sans-serif" font-size="13" font-weight="600" fill="#F4F6F9">SEO</text>
						<text x="506" y="83" font-family="Poppins, sans-serif" font-size="11.5" fill="#7FA0C4">100 / 100</text>
					</g>

					<!-- Organic traffic -->
					<g>
						<rect x="390" y="360" width="196" height="132" rx="14" fill="url(#rc-card)" stroke="#2A5F92" stroke-width="1.5"/>
						<text x="410" y="388" font-family="Poppins, sans-serif" font-size="13.5" font-weight="600" fill="#63C89F">Organic traffic</text>
						<path d="M410 462l31-16 31 6 31-28 31-12 32-22v72H410Z" fill="url(#rc-area)"/>
						<polyline points="410,462 441,446 472,452 503,424 534,412 566,390" fill="none" stroke="#1D9E75" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
						<circle cx="566" cy="390" r="4.5" fill="#63C89F"/>
					</g>
				</svg>
			</div>
		</div>
	</section>

	<section class="proof">
		<div class="container">
			<p class="section-label">Real results, not promises</p>
			<h2>Real sites, real numbers</h2>
			<div class="services-grid proof-grid">
				<a href="/portfolio/rossi-real-estate" class="service-card">
					<h3>Rossi Real Estate</h3>
					<div class="stat-row">
						<div class="stat"><span class="stat-number">99</span><span class="stat-label">Performance (mobile)</span></div>
						<div class="stat"><span class="stat-number">100</span><span class="stat-label">SEO</span></div>
					</div>
					<span class="link-arrow">Read the Rossi Real Estate case study →</span>
				</a>
				<a href="/portfolio/ironclad-sites-case-study" class="service-card">
					<h3>Ironclad Sites</h3>
					<div class="stat-row">
						<div class="stat"><span class="stat-number">97</span><span class="stat-label">Performance (mobile)</span></div>
						<div class="stat"><span class="stat-number">100</span><span class="stat-label">SEO</span></div>
					</div>
					<span class="link-arrow">Read the Ironclad Sites case study →</span>
				</a>
				<a href="/portfolio/the-rankcraft-ecosystem" class="service-card">
					<h3>The RankCraft Ecosystem</h3>
					<div class="stat-row">
						<div class="stat"><span class="stat-number">3</span><span class="stat-label">Connected products</span></div>
						<div class="stat"><span class="stat-number">100%</span><span class="stat-label">Automated, audit to lead</span></div>
					</div>
					<span class="link-arrow">Read the RankCraft Ecosystem case study →</span>
				</a>
			</div>
		</div>
	</section>

	<section class="services" id="services">
		<div class="container">
			<h2>What I do</h2>
			<div class="services-grid">
				<a href="/wordpress-development" class="service-card">
					<h3>WordPress development</h3>
					<svg class="service-illustration" viewBox="0 0 240 140" aria-hidden="true" focusable="false"><rect x="20" y="18" width="200" height="104" rx="10" fill="#0C2A4A"/><path d="M20 40h200" stroke="#2C4D6B" stroke-width="2"/><circle cx="34" cy="29" r="3" fill="#2C4D6B"/><circle cx="46" cy="29" r="3" fill="#2C4D6B"/><circle cx="58" cy="29" r="3" fill="#2C4D6B"/><rect x="36" y="56" width="70" height="8" rx="4" fill="#F4F6F9"/><rect x="36" y="72" width="104" height="8" rx="4" fill="#2C4D6B"/><rect x="36" y="88" width="52" height="8" rx="4" fill="#63C89F"/><rect x="36" y="104" width="86" height="8" rx="4" fill="#2C4D6B"/><path d="M172 64l-10 10 10 10M196 64l10 10-10 10" fill="none" stroke="#F4F6F9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
					<span class="link-arrow">WordPress development services &rarr;</span>
				</a>
				<a href="/seo-and-local-search" class="service-card">
					<h3>SEO and local search</h3>
					<svg class="service-illustration" viewBox="0 0 240 140" aria-hidden="true" focusable="false"><rect x="20" y="18" width="200" height="104" rx="10" fill="#0C2A4A"/><rect x="36" y="32" width="168" height="20" rx="10" fill="#0C2A4A" stroke="#2C4D6B" stroke-width="2"/><circle cx="51" cy="42" r="5" fill="none" stroke="#F4F6F9" stroke-width="2"/><path d="M55 46l4.5 4.5" stroke="#F4F6F9" stroke-width="2" stroke-linecap="round"/><rect x="36" y="66" width="112" height="7" rx="3.5" fill="#F4F6F9"/><rect x="36" y="78" width="146" height="6" rx="3" fill="#2C4D6B"/><rect x="36" y="96" width="92" height="7" rx="3.5" fill="#2C4D6B"/><rect x="36" y="108" width="124" height="6" rx="3" fill="#2C4D6B"/><path d="M196 62c0 7.5-9 17-9 17s-9-9.5-9-17a9 9 0 1 1 18 0z" fill="#63C89F"/><circle cx="187" cy="62" r="3.5" fill="#0C2A4A"/></svg>
					<span class="link-arrow">Explore SEO and local search &rarr;</span>
				</a>
				<a href="/performance-audits" class="service-card">
					<h3>Performance audits</h3>
					<svg class="service-illustration" viewBox="0 0 240 140" aria-hidden="true" focusable="false"><rect x="20" y="18" width="200" height="104" rx="10" fill="#0C2A4A"/><path d="M44 98a32 32 0 0 1 64 0" fill="none" stroke="#2C4D6B" stroke-width="9" stroke-linecap="round"/><path d="M44 98a32 32 0 0 1 48-27" fill="none" stroke="#63C89F" stroke-width="9" stroke-linecap="round"/><path d="M76 98l19-16" stroke="#F4F6F9" stroke-width="3.5" stroke-linecap="round"/><circle cx="76" cy="98" r="5" fill="#F4F6F9"/><rect x="130" y="48" width="58" height="8" rx="4" fill="#F4F6F9"/><rect x="130" y="66" width="74" height="7" rx="3.5" fill="#2C4D6B"/><rect x="130" y="82" width="40" height="7" rx="3.5" fill="#63C89F"/><rect x="130" y="98" width="64" height="7" rx="3.5" fill="#2C4D6B"/></svg>
					<span class="link-arrow">What a performance audit covers &rarr;</span>
				</a>
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
					<p>I'll analyze your speed, SEO, and technical health, then send you a clear, no-jargon report.</p>
				</div>
				<div class="step">
					<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/step-icon-3-email.png' ); ?>" alt="" width="48" height="48" loading="lazy">
					<h3>Get your results by email</h3>
					<p>I'll send you the findings by email, along with what fixing them could mean for your business. No call needed.</p>
				</div>
			</div>
			<div id="audit-form" class="audit-form-anchor">
				<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
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
					<p>Small and service-based businesses whose website has to bring in leads, not just look good. If your site is slow or isn't showing up in search, that's the work I do.</p>
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
					<p>A custom WordPress build usually takes 2 to 4 weeks depending on scope. Audits and SEO fixes move faster, often within a week of getting started.</p>
				</details>
				<details class="faq-item">
					<summary>Do you offer support after the site launches?</summary>
					<p>Yes, as a separate monthly plan rather than something folded into the build price. Hosting, updates, backups, security monitoring and small changes, so you are not stuck when something needs fixing later.</p>
				</details>
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

</main>

<?php get_footer(); ?>
