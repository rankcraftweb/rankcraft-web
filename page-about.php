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
		<p>That means fewer handoffs, faster turnaround, and someone who's personally accountable for the results, not just the deliverable. You can see that in the <a href="/portfolio">portfolio</a> — real sites, with the numbers to back them up.</p>
		<p>Every site I work on gets the same treatment: a clear audit, systematic fixes, and a record of what changed and why. No black boxes, no vague monthly reports.</p>
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
