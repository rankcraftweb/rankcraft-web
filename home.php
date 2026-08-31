<?php
/**
 * Template for the blog index (posts page).
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="service-hero">
	<div class="container service-hero-inner">
		<div class="service-hero-text">
			<p class="section-label">Blog</p>
			<h1>Notes on WordPress, SEO, and site performance</h1>
			<p class="service-hero-lead">Practical, no-fluff write-ups from real client projects.</p>
		</div>
		<div class="service-hero-visual"><svg class="hero-illustration" viewBox="0 0 400 300" aria-hidden="true" focusable="false"><rect x="52" y="22" width="296" height="46" rx="12" fill="#E2E8F0" stroke="#B9C6D6" stroke-width="1.5"/><rect x="32" y="52" width="336" height="216" rx="16" fill="#F4F6F9" stroke="#B9C6D6" stroke-width="1.5"/><rect x="62" y="84" width="140" height="10" rx="5" fill="#17805F"/><g fill="#8496AC"><rect x="62" y="114" width="276" height="8" rx="4"/><rect x="62" y="134" width="240" height="8" rx="4"/><rect x="62" y="154" width="262" height="8" rx="4"/><rect x="62" y="182" width="196" height="8" rx="4"/><rect x="62" y="202" width="252" height="8" rx="4"/><rect x="62" y="222" width="174" height="8" rx="4"/></g><rect x="62" y="246" width="88" height="8" rx="4" fill="#0C2A4A"/></svg></div>
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
