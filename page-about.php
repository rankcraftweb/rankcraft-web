<?php
/**
 * Template for the About page (slug: about).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="about-hero">
	<div class="container about-hero-inner">
		<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/about-headshot.png' ); ?>" alt="Jan, founder of RankCraft Web" class="about-hero-headshot" width="180" height="180">
		<div>
			<p class="section-label">About</p>
			<h1>Hi, I'm Jan.</h1>
			<p class="about-hero-lead">I'm a WordPress developer and SEO specialist based in the Philippines, working with clients across the US. I build fast, search-optimized websites, and handle every project personally from the first audit to final launch.</p>
		</div>
	</div>
</section>

<section class="about-bio">
	<div class="container about-bio-inner">
		<h2>How I work</h2>
		<p>Most agencies hand your project between account managers, designers, and developers before it ever gets built. RankCraft is different: it's just me. When you work with RankCraft, you're talking directly to the person writing the code, running the SEO audit, and fixing what's broken.</p>
		<p>That means fewer handoffs, faster turnaround, and someone who's personally accountable for the results, not just the deliverable. You can see that in the <a href="/portfolio">portfolio</a> — real client sites, with the numbers to back them up.</p>
		<p>Before freelancing, I spent years as a technician in industrial and product engineering roles, work that was structured, procedural, and documentation-driven. I bring that same discipline to client sites: clear audits, systematic fixes, and records of what changed and why.</p>
		<p>I got here through hands-on practice rather than a single formal path: hundreds of hours building real front-end projects, hands-on client work managing WordPress sites and SEO, and continuously testing what actually moves rankings versus what's just theory.</p>
	</div>
</section>

<section class="skills">
	<div class="container">
		<h2>Core skills</h2>
		<ul class="skills-list">
			<li><a href="/wordpress-development">Custom WordPress theme and plugin development</a></li>
			<li>Full-stack development with Next.js, React, and TypeScript</li>
			<li>REST API design and third-party API integration</li>
			<li><a href="/seo-and-local-search">Technical SEO and schema markup</a></li>
			<li><a href="/seo-and-local-search">On-page and local SEO strategy</a></li>
			<li><a href="/performance-audits">Site performance and Core Web Vitals optimization</a></li>
			<li>Deployment and hosting (Vercel, Hostinger, SSH, WP-CLI)</li>
			<li>Git version control</li>
		</ul>
	</div>
</section>

<section class="experience">
	<div class="container">
		<h2>Experience</h2>
		<p class="section-intro">From structured technical documentation to freelance web and SEO work.</p>

		<div class="experience-list">
			<div class="experience-item">
				<div class="experience-header">
					<h3>Founder &amp; Full-Stack Developer</h3>
					<span class="experience-date">2026 – Present</span>
				</div>
				<p class="experience-role">RankCraft Web (self-initiated ecosystem)</p>
				<ul>
					<li>Designed and built a three-part product ecosystem end to end: a custom WordPress marketing site, a Next.js website-audit tool deployed on Vercel, and a lead-tracking system, all connected via server-to-server REST API calls</li>
					<li>Built the WordPress site from scratch with a hand-coded theme (no page builder): custom post types, a working contact form with spam protection, blog, and a <a href="/portfolio/the-rankcraft-ecosystem">case-study system</a>, passing a full pre-launch audit across SEO, performance, accessibility, and security</li>
					<li>Built the audit tool with Next.js, TypeScript, and Tailwind CSS, integrating Google's PageSpeed Insights API server-side to keep credentials off the client</li>
					<li>Set up Google Search Console and GA4 tracking, and established a technical-SEO content calendar</li>
				</ul>
			</div>

			<div class="experience-item">
				<div class="experience-header">
					<h3>WordPress Developer &amp; SEO Specialist</h3>
					<span class="experience-date">2026 – Present</span>
				</div>
				<p class="experience-role">Freelance – Rossi Real Estate &amp; Ironclad Sites</p>
				<ul>
					<li>Delivered full website builds (WordPress + Elementor) optimized for performance and search, achieving PageSpeed scores of 95–99 across mobile and desktop for both clients</li>
					<li>Provide ongoing hosting and management of both clients' live production sites, including updates, uptime monitoring, and technical support</li>
					<li>Implemented structured data (schema.org) for real-estate and service-business clients, validated through Google's Rich Results Test with zero errors</li>
					<li>Integrated third-party services including IDX Broker for real-estate MLS listings, and built a custom WordPress plugin for schema markup where off-the-shelf plugins fell short</li>
				</ul>
			</div>

			<div class="experience-item">
				<div class="experience-header">
					<h3>Technician I — Product Engineering</h3>
					<span class="experience-date">Jun 2022 – Feb 2026</span>
				</div>
				<p class="experience-role">Analog Devices General Trias Inc.</p>
				<ul>
					<li>Set up, calibrate, and operate test equipment and automated handlers for electronic products</li>
					<li>Perform first-level verification on yield or quality assurance (QA) failures and analyze test circuit faults</li>
					<li>Maintain, repair, and clean test hardware, performance boards, and contact assemblies</li>
					<li>Record test results, document activities through tracking systems, and report findings to engineering teams</li>
				</ul>
			</div>

			<div class="experience-item">
				<div class="experience-header">
					<h3>Technician I — Equipment Maintenance</h3>
					<span class="experience-date">Dec 2021 – Apr 2022</span>
				</div>
				<p class="experience-role">Telford Services Philippines Inc.</p>
				<ul>
					<li>Set up, convert, and calibrate automated test handlers and related sub-assemblies</li>
					<li>Diagnose and repair hardware, circuit boards, and test chambers</li>
					<li>Run tests, load samples, and log data to assist engineers</li>
					<li>Perform routine checks and predictive maintenance to prevent machine downtime</li>
				</ul>
			</div>

			<div class="experience-item">
				<div class="experience-header">
					<h3>Technical Assistant</h3>
					<span class="experience-date">Oct 2013 – Jan 2018</span>
				</div>
				<p class="experience-role">LBG Industries Inc.</p>
				<ul>
					<li>Maintained project documentation and technical records</li>
					<li>Assisted in preparing operational and equipment documentation</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="education">
	<div class="container">
		<h2>Education</h2>
		<div class="education-item">
			<h3>B.S. Industrial Technology, Mechanical Technology</h3>
			<p class="education-school">Aurora State College of Technology</p>
		</div>
	</div>
</section>

<section class="certifications">
	<div class="container">
		<h2>Certifications</h2>
		<p class="section-intro">Ongoing training across SEO platforms and web development.</p>

		<div class="cert-grid">
			<div class="cert-card">
				<span class="cert-issuer">Ahrefs</span>
				<h3>Ahrefs' Marketing Platform</h3>
				<span class="cert-date">Issued March 2026</span>
				<a href="https://ahrefs.com/academy/certificate/7698a4e0522f43c29026c61e921b49eb" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">HubSpot Academy</span>
				<h3>SEO Certified</h3>
				<span class="cert-date">Issued March 2026</span>
				<a href="https://app-na2.hubspot.com/academy/achievements/mwqcd44w/en/1/jan-christopher-buen/seo" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">Semrush Academy</span>
				<h3>SEO Toolkit Crash Course</h3>
				<span class="cert-date">Issued 2026</span>
				<a href="https://static.semrush.com/academy/certificates/01cfb57b77/jan-christopher-buen_25.pdf" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">Semrush Academy</span>
				<h3>Technical SEO and AI Search Essentials</h3>
				<span class="cert-date">Issued 2026</span>
				<a href="https://static.semrush.com/academy/certificates/a730b13fe9/jan-christopher-buen_25.pdf" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">freeCodeCamp</span>
				<h3>Responsive Web Design</h3>
				<span class="cert-date">Issued March 2026</span>
				<a href="https://freecodecamp.org/certification/janchristopherbuen/responsive-web-design-v9" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">freeCodeCamp</span>
				<h3>JavaScript</h3>
				<span class="cert-date">Issued May 2026</span>
				<a href="https://freecodecamp.org/certification/janchristopherbuen/javascript-v9" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">freeCodeCamp</span>
				<h3>Front-End Development Libraries</h3>
				<span class="cert-date">Issued August 2026</span>
				<a href="https://freecodecamp.org/certification/janchristopherbuen/front-end-development-libraries-v9" target="_blank" rel="noopener" class="cert-verify">Verify →</a>
			</div>
		</div>
	</div>
</section>

<section class="about-cta">
	<div class="container">
		<h2>Want to work together?</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
