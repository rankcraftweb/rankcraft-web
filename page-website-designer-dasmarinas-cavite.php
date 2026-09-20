<?php
/**
 * Template for the Dasmariñas local landing page
 * (slug: website-designer-dasmarinas-cavite).
 *
 * The second geo page, built because the first one demonstrably worked.
 * Search Console, domain property: "website designer in silang" went
 * from about 60 to 30 to 24.8, and "website developer in silang" now
 * sits at 17.3, which was the only query anywhere in the 8-20 band.
 * Dasmariñas is also where most of the site's Philippine traffic comes
 * from in GA4, so there is demand evidence on both sides.
 *
 * "Designer" leads the slug, title and H1 because that is the word that
 * ranked first on the Silang page and it is the primary category on the
 * Google Business Profile. "Developer" is carried too; both have their
 * own impressions.
 *
 * THIS PAGE MUST NOT BECOME A COPY OF THE SILANG ONE. A city page that
 * swaps a place name and changes nothing else is a doorway page, which
 * is a thing Google penalises and a thing that deserves penalising.
 * Two deliberate differences:
 *
 * 1. Its own survey. Six Dasmariñas sites measured on 20 September 2026
 *    with PageSpeed Insights - dental clinics, a hotel, and three
 *    schools. Median 60, every one over four seconds to first image,
 *    four of six over ten, none under three, slowest 26.2s. Three
 *    homepages over 5 MB and one at 33 MB. Re-run before changing the
 *    figures; they are dated on the page for that reason. Three more
 *    (dlsud.edu.ph, dlshsi.edu.ph, primacaredental.ph) would not
 *    resolve from here and were left out rather than guessed at.
 *
 * 2. A different argument. The Silang page argues abandonment and
 *    ranking signals. This one argues the data bill, because a 33 MB
 *    homepage is not an abstraction to somebody on a prepaid bundle.
 *
 * Nine sentences ARE shared with the Silang page: the three process
 * steps, three service list items and a stat label. That is deliberate
 * and was left alone. The process really is the same one, and rewriting
 * an accurate description into different words purely to defeat a
 * similarity check produces worse prose for a machine's benefit. The
 * measured figure is roughly a fifth of the body; the hero, the survey,
 * the argument and the closing section are all this page's own.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container service-hero-inner">
		<div class="service-hero-text">
			<p class="section-label">Dasmariñas, Cavite</p>
			<h1>Website designer and developer in Dasmariñas, Cavite</h1>
			<p class="service-hero-lead">I design and build fast WordPress sites, and fix technical SEO, for businesses in Dasmariñas and across Cavite. I work from Silang, half an hour down the road, so you are hiring one person you can actually reach rather than an agency queue. You can check the <a href="https://maps.google.com/?cid=8104698444060568540" target="_blank" rel="noopener">Google Business Profile</a> too.</p>
			<div class="hero-cta">
				<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
				<a href="/contact" class="btn btn-secondary">Get in touch</a>
			</div>
		</div>
		<div class="service-hero-visual"><svg class="hero-illustration" viewBox="0 0 400 300" aria-hidden="true" focusable="false"><rect x="20" y="30" width="360" height="240" rx="16" fill="#F4F6F9" stroke="#B9C6D6" stroke-width="1.5"/><g stroke="#B9C6D6" stroke-width="3" fill="none" stroke-linecap="round"><path d="M34 96h108l34 34h190"/><path d="M104 44v52"/><path d="M246 258v-72l40-40"/><path d="M34 226h96l30-30"/></g><circle cx="80" cy="70" r="5" fill="#8496AC"/><circle cx="300" cy="166" r="5" fill="#8496AC"/><circle cx="140" cy="240" r="5" fill="#8496AC"/><path d="M200 86c-22 0-40 18-40 40 0 28 40 70 40 70s40-42 40-70c0-22-18-40-40-40z" fill="#17805F"/><circle cx="200" cy="126" r="14" fill="#DCE4ED"/></svg></div>
	</div>
</section>

<section class="about-proof">
	<div class="container">
		<h2>I measured six Dasmariñas websites. Not one was quick.</h2>
		<div class="stat-row">
			<div class="stat">
				<span class="stat-number">60</span>
				<span class="stat-label">Median mobile PageSpeed score out of 100</span>
			</div>
			<div class="stat">
				<span class="stat-number">6 of 6</span>
				<span class="stat-label">Took more than four seconds to show the main image on a phone</span>
			</div>
			<div class="stat">
				<span class="stat-number">33 MB</span>
				<span class="stat-label">The heaviest homepage, on a page meant to load on mobile data</span>
			</div>
		</div>
		<p class="section-intro">Dental clinics, a hotel, and three schools in Dasmariñas, measured on 20 September 2026 with Google PageSpeed Insights. Four of the six took more than ten seconds to show their main image and the slowest took 26.2 seconds. None managed it in under three, which is the target. Three of the six homepages weighed more than 5MB.</p>
	</div>
</section>

<section class="service-overview">
	<div class="container service-overview-inner">
		<h2>What a 33MB homepage actually costs</h2>
		<p>Most advice about page weight is written as if data were free. It is not. A visitor opening that homepage on a prepaid bundle spends 33 megabytes of it before reading a word, and they spend it again next time if the site has not been told to cache anything. One of the six here is that site. Another is 19.7MB.</p>
		<p>They will not complain about it. They will not even know why the page felt wrong. They will go back to the search results and open whoever is second, and the only thing the business ever sees is a number that did not move.</p>
		<p>None of the six needed a rebuild. Photographs at full camera resolution, images with no dimensions set, and code loading ahead of anything the visitor can see accounted for nearly all of it. On most of these that is a few days of work, not a new website.</p>
	</div>
</section>

<section class="service-deliverables">
	<div class="container">
		<h2>What I do</h2>
		<ul class="skills-list">
			<li>Design and build, by the same person, so the layout and what it costs to load are decided together</li>
			<li><a href="/wordpress-development">WordPress development</a>, hand-coded or on a builder, whichever keeps the site fast</li>
			<li><a href="/performance-audits">Performance audits</a> with Core Web Vitals, and the fixes afterwards</li>
			<li><a href="/seo-and-local-search">Technical SEO and local search</a>, including schema markup and Google Business Profile</li>
			<li>Rebuilds and repairs of existing WordPress sites, which is usually the cheaper answer</li>
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
		<h2>Close enough to turn up</h2>
		<p>I am in Silang, which is about half an hour from Dasmariñas depending on Aguinaldo Highway. Most of the work happens over email and calls regardless, but being this close means meeting in person is a normal thing rather than a production, and I keep the same business hours you do.</p>
		<p>It also means one person. You brief me, and I am the one who designs it, builds it, and answers when something breaks afterwards. There is no account manager in between, and nothing gets lost on the way to whoever writes the code.</p>
		<p>You can see how I work on the <a href="/about">about page</a>, the sites themselves in the <a href="/portfolio">portfolio</a>, and what I found across <a href="/website-developer-silang-cavite/">Silang and the wider Cavite sample</a>.</p>
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
