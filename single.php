<?php
/**
 * Template for single blog posts.
 *
 * @package RankCraft_Web
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<article <?php post_class( 'single-post' ); ?>>
		<header class="single-post-header">
			<div class="container">
				<p class="section-label">Blog</p>
				<h1><?php the_title(); ?></h1>
				<span class="single-post-date"><?php echo esc_html( get_the_date() ); ?></span>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="single-post-thumb container">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="single-post-content container">
			<?php the_content(); ?>
		</div>

		<div class="single-post-back container">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="link-arrow">← Back to the blog</a>
		</div>
	</article>

	<?php
endwhile;

get_footer();
