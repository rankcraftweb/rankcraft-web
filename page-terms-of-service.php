<?php
/**
 * Template for the Terms of Service page (slug: terms-of-service).
 *
 * @package RankCraft_Web
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<section class="legal-page">
		<div class="container legal-page-inner">
			<p class="section-label">Legal</p>
			<h1><?php the_title(); ?></h1>
			<p class="legal-updated">Last updated: August 21, 2026</p>
			<div class="legal-content"><?php the_content(); ?></div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
