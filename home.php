<?php
/**
 * Template for the blog index (posts page).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container">
		<p class="section-label">Blog</p>
		<h1>Notes on WordPress, SEO, and site performance</h1>
		<p class="service-hero-lead">Practical, no-fluff write-ups from real client projects.</p>
	</div>
</section>

<section class="blog-list">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="blog-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'blog-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="blog-card-thumb">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</a>
						<?php endif; ?>
						<div class="blog-card-body">
							<span class="blog-card-date"><?php echo esc_html( get_the_date() ); ?></span>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="link-arrow">Read more →</a>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<div class="blog-pagination">
				<?php
				echo paginate_links( array(
					'prev_text' => '← Previous',
					'next_text' => 'Next →',
				) );
				?>
			</div>
		<?php else : ?>
			<p class="blog-empty">No posts yet, check back soon.</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
