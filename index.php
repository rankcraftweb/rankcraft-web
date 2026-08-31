<?php
/**
 * Fallback template.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<div class="container">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
			<?php
		endwhile;
	else :
		echo '<p>' . esc_html__( 'Nothing found.', 'rankcraft-web' ) . '</p>';
	endif;
	?>
</div>

<?php get_footer(); ?>
