<?php
/**
 * Template for the Silang / Cavite local landing page
 * (slug: website-developer-silang-cavite).
 *
 * Built for the two strongest non-branded queries in Search Console:
 * "website developer in silang" and "website designer in silang", each
 * with 10 impressions over three months and sitting around position 60
 * because nothing on the site addresses them.
 *
 * It worked, unevenly. By 8 September 2026 "website designer in silang"
 * had moved from about 60 to **position 30** - the best non-branded
 * position on the whole site, and the only query anywhere near reach.
 * Every other query sits either in the top six (brand) or at 84 to 98,
 * which is not "almost there".
 *
 * The uneven part is that the page was written around the wrong word.
 * "Developer" appeared three times; "designer" appeared once, and in
 * neither the title, the description, nor the H1 - while "designer" is
 * the query that ranks AND the primary category on the Google Business
 * Profile. So the title, excerpt, H1 and the "Designer or developer?"
 * section now cover it, without dropping "developer", which has its own
 * impressions.
 *
 * That section is deliberately an argument rather than a keyword: the
 * handover between design and build is where page weight is decided,
 * and it is the honest reason one person doing both is worth something.
 *
 * The measured-sites section is what keeps this from being a doorway
 * page. The numbers come from an actual PageSpeed Insights run across
 * nine local business websites on 30 August 2026, so the page says
 * something no competing city page can copy. Re-run the sample before
 * changing the figures; they are dated on the page for that reason.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container service-hero-inner">
		<div class="service-hero-text">
			<p class="section-label">Silang, Cavite</p>
			<h1>Website designer and developer in Silang, Cavite</h1>
			<p class="service-hero-lead">I design and build fast WordPress sites, and fix technical SEO, for businesses around Silang, Tagaytay, and the rest of Cavite. I live here, so you are hiring one person you can actually reach, not an agency queue. You can check the <a href="https://maps.google.com/?cid=8104698444060568540" target="_blank" rel="noopener">Google Business Profile</a> too.</p>
			<div class="hero-cta">
				<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
				<a href="/contact" class="btn btn-secondary">Get in touch</a>
			</div>
		</div>
		<div class="service-hero-visual"><svg class="hero-illustration" viewBox="0 0 400 300" aria-hidden="true" focusable="false"><rect x="20" y="30" width="360" height="240" rx="16" fill="#F4F6F9" stroke="#B9C6D6" stroke-width="1.5"/><g stroke="#B9C6D6" stroke-width="3" fill="none" stroke-linecap="round"><path d="M34 112h136l40 40h176"/><path d="M122 44v68"/><path d="M258 258v-84l46-46"/><path d="M34 212h84l28-28"/></g><circle cx="96" cy="84" r="5" fill="#8496AC"/><circle cx="312" cy="180" r="5" fill="#8496AC"/><circle cx="126" cy="228" r="5" fill="#8496AC"/><path d="M200 92c-21 0-38 17-38 38 0 27 38 66 38 66s38-39 38-66c0-21-17-38-38-38z" fill="#17805F"/><circle cx="200" cy="130" r="13" fill="#DCE4ED"/></svg></div>
	</div>
</section>

<section class="about-proof">
	<div class="container">
		<h2>I measured nine local business websites. Here is what came back.</h2>
		<div class="stat-row">
			<div class="stat">
				<span class="stat-number">55</span>
				<span class="stat-label">Median mobile PageSpeed score out of 100</span>
			</div>
			<div class="stat">
				<span class="stat-number">6 of 9</span>
				<span class="stat-label">Took more than 10 seconds to show the main image on a phone</span>
			</div>
			<div class="stat">
				<span class="stat-number">1 of 9</span>
				<span class="stat-label">Loaded in under 3 seconds, which is the target</span>
			</div>
		</div>
		<p class="section-intro">Resorts, restaurants, event venues, and dental clinics around Silang, Tagaytay, and Cavite, measured on 30 August 2026 with Google PageSpeed Insights. The slowest took 23.7 seconds. Three of the nine homepages weighed more than 5MB, which is roughly five times what a homepage should be.</p>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Why that matters here</h2>
		<p>Almost everyone searching for a venue, a clinic, or a restaurant in Cavite is doing it on a phone, often on mobile data with several tabs already open. A homepage that takes 17 seconds does not get read slowly. It gets abandoned, and the visitor goes back to the search results and picks somebody else.</p>
		<p>Google measures this too. Loading speed and layout stability are ranking signals, so a slow site is losing customers twice: the ones who leave, and the ones who never see it in the first place.</p>
		<p>None of the nine sites had a problem that needed a rebuild. Uncompressed photos, images without a set size, and unused code loading before anything appears accounted for nearly all of it. That is a week of work on most of them, not a new website.</p>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Designer or developer?</h2>
		<p>People search for one and usually need both, so it is worth saying plainly which is which. A designer decides how the site looks and how someone moves through it. A developer builds the thing that actually loads in a browser. They are different jobs, and on a small business site they are very often the same person.</p>
		<p>The reason that matters is the handover. A design signed off as a set of pictures has made no decisions about weight, and it is at exactly that point that speed disappears: a hero image that looked right in the mockup arrives as a four megabyte photograph, and nobody who chose it was thinking about a phone on mobile data. Of the nine sites above, not one was slow because of bad design. They were slow because nothing connected the design to what it would cost to load.</p>
		<p>I do both, which means those decisions get made once. When a layout would be expensive, I know while it is still a layout.</p>
	</div>
</section>

<section class="service-deliverables">
	<div class="container">
		<h2>What I do</h2>
		<ul class="skills-list">
			<li><a href="/wordpress-development">WordPress development</a>, hand-coded or on a builder, whichever keeps the site fast</li>
			<li><a href="/performance-audits">Performance audits</a> with Core Web Vitals, and the fixes afterwards</li>
			<li><a href="/seo-and-local-search">Technical SEO and local search</a>, including schema markup and Google Business Profile</li>
			<li>Rebuilds and repairs of existing WordPress sites</li>
			<li>Ongoing maintenance, updates, and hosting support after launch</li>
		</ul>
	</div>
</section>

<section class="service-process">
	<div class="container">
		<h2>How it starts</h2>
		<div class="steps-grid">
			<div class="step">
				<span class="step-number">1</span>
				<h3>Free audit</h3>
				<p>Put your address into the <a href="https://audit.rankcraftweb.com">free audit tool</a> and you get the same measurements I used above, for your own site, whether or not you hire me.</p>
			</div>
			<div class="step">
				<span class="step-number">2</span>
				<h3>We talk about what it found</h3>
				<p>I tell you which problems are worth fixing and which ones are not. If your site is fine, I will say that instead of selling you something.</p>
			</div>
			<div class="step">
				<span class="step-number">3</span>
				<h3>Fix in order of impact</h3>
				<p>Biggest problems first, one change at a time, with before and after numbers so you can see what the work actually did.</p>
			</div>
		</div>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>Working with someone nearby</h2>
		<p>Most of my work happens over email and calls, and that suits a lot of clients fine. But being in Silang means I can meet you if that is easier, I answer within business hours you actually keep, and there is no handover between an account manager and whoever ends up writing the code. You brief me, and I am the one who builds it.</p>
		<p>You can see how I work on the <a href="/about">about page</a>, and the sites themselves in the <a href="/portfolio">portfolio</a>. I have measured <a href="/website-designer-dasmarinas-cavite/">six sites in Dasmariñas</a> as well, if that is nearer to you.</p>
	</div>
</section>

<section class="about-cta">
	<div class="container">
		<h2>Find out where your site stands</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
