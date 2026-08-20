<?php
/**
 * Case Study archive template.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="portfolio-archive">
	<div class="container">
		<h1>Our work</h1>
		<p class="section-intro">Real projects, real results. Here's what we've built for clients.</p>

		<div class="portfolio-grid">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="portfolio-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="portfolio-card-image">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</div>
						<?php endif; ?>
						<div class="portfolio-card-body">
							<h2><?php the_title(); ?></h2>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<span class="link-arrow">Read case study →</span>
						</div>
					</a>
				<?php endwhile; ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Case studies coming soon.', 'rankcraft-web' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
