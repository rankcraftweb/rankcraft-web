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
		<div>
			<h2>How I work</h2>
			<p>Most agencies hand your project between account managers, designers, and developers before it ever gets built. RankCraft is different: it's just me. When you work with RankCraft, you're talking directly to the person writing the code, running the SEO audit, and fixing what's broken.</p>
			<p>That means fewer handoffs, faster turnaround, and someone who's personally accountable for the results, not just the deliverable.</p>
			<p>I got here through hands-on practice rather than a single formal path: hundreds of hours building real front-end projects, hands-on client work managing WordPress sites and SEO, and continuously testing what actually moves rankings versus what's just theory.</p>
		</div>

		<div class="skills-panel">
			<h3>Core skills</h3>
			<ul class="skills-list">
				<li>Custom WordPress theme and plugin development</li>
				<li>Technical SEO and schema markup</li>
				<li>On-page and local SEO strategy</li>
				<li>Site performance and Core Web Vitals optimization</li>
				<li>JavaScript and front-end development</li>
				<li>Git version control</li>
			</ul>
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
			</div>

			<div class="cert-card">
				<span class="cert-issuer">HubSpot Academy</span>
				<h3>SEO Certified</h3>
				<span class="cert-date">Issued March 2026</span>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">Semrush Academy</span>
				<h3>SEO Toolkit Crash Course</h3>
				<span class="cert-date">Issued 2026</span>
			</div>

			<div class="cert-card">
				<span class="cert-issuer">Semrush Academy</span>
				<h3>Technical SEO and AI Search Essentials</h3>
				<span class="cert-date">Issued 2026</span>
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
			<a href="/contact" class="btn btn-primary">Get in touch</a>
			<a href="/portfolio" class="btn btn-secondary-dark">See my work</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
