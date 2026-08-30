<?php
/**
 * Template for the SEO and Local Search service page (slug: seo-and-local-search).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container">
		<img src="<?php echo esc_url( RANKCRAFT_URI . '/assets/images/service-icon-seo.png' ); ?>" alt="" width="56" height="56" class="service-hero-icon">
		<p class="section-label">Services</p>
		<h1>SEO and local search that brings in the right customers</h1>
		<p class="service-hero-lead">On-page optimization, technical fixes, and local search strategy so the people searching for what you offer actually find you.</p>
		<div class="hero-cta">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary">Get in touch</a>
		</div>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Ranking is about fundamentals, not tricks</h2>
		<p>Most sites that don't rank aren't missing some secret tactic, they're missing the fundamentals: clean technical SEO, structured data search engines can actually read, and content that matches what people are searching for. See <a href="/technical-seo-fixes-that-move-rankings/">5 technical SEO fixes that actually move rankings</a> for the specific checks I run.</p>
		<p>I focus on the fixes that move the needle for small and service-based businesses, the ones whose website has to bring in enquiries rather than just look presentable. That usually means getting the technical foundations clean first, then the local signals that decide whether you appear at all when somebody nearby is ready to buy. The structured data side of that work is set out in the <a href="/portfolio/rossi-real-estate">Rossi Real Estate case study</a>.</p>
		<p>That includes technical SEO, on-page optimization, and local search signals like schema markup and Google Business Profile, tracked and reported on every month so you can see what's actually working. If your site also needs a rebuild rather than just fixes, that's what <a href="/wordpress-development">custom WordPress development</a> is for.</p>
	</div>
</section>

<section class="service-deliverables">
	<div class="container">
		<h2>What this covers</h2>
		<div class="sub-services">
			<div class="sub-service">
				<h3>Technical SEO Fixes</h3>
				<p>Crawl, indexing, canonicals and redirects. This is the layer that decides whether any of the rest counts: a canonical pointing one redirect away from itself will hold a page back for months without ever looking broken.</p>
			</div>
			<div class="sub-service">
				<h3>Local SEO &amp; Google Business Profile</h3>
				<p>Categories, service areas and the details that decide whether you appear in the map pack at all. A profile set to the wrong service area can put your pin in the middle of the ocean, which is a real thing I have had to fix.</p>
			</div>
			<div class="sub-service">
				<h3>Structured Data &amp; Schema Markup</h3>
				<p>Hand-written schema telling search engines what the business is, where it works and what it offers, so the site and the listing agree with each other. Most sites either skip this or leave a plugin guessing.</p>
			</div>
			<div class="sub-service">
				<h3>Search Console Setup &amp; Reporting</h3>
				<p>What people actually searched, where you appeared and what moved, monthly. Including the queries that turn out to be the wrong country entirely, which is worth knowing before you write anything for them.</p>
			</div>
		</div>
	</div>
</section>

<section class="about-cta">
	<div class="container">
		<h2>Want to know where your site stands in search?</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
