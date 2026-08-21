<?php
/**
 * Single Case Study template.
 *
 * @package RankCraft_Web
 */

get_header();

while ( have_posts() ) :
	the_post();

	$client_name = get_post_meta( get_the_ID(), '_rc_client_name', true );
	$project_url = get_post_meta( get_the_ID(), '_rc_project_url', true );
	?>

	<article class="case-study-single">

		<header class="case-study-hero">
			<div class="container">
				<p class="section-label">Case study</p>
				<h1><?php the_title(); ?></h1>
				<?php if ( $client_name ) : ?>
					<p class="case-study-client">
						<?php echo esc_html( $client_name ); ?>
						<?php if ( $project_url ) : ?>
							&middot; <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener">Visit site ↗</a>
						<?php endif; ?>
					</p>
				<?php endif; ?>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="case-study-featured-image container">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<?php
		// Build the stat row from meta fields, skipping any that are empty.
		$stats = array();
		for ( $i = 1; $i <= 4; $i++ ) {
			$number = get_post_meta( get_the_ID(), '_rc_stat_' . $i . '_number', true );
			$label  = get_post_meta( get_the_ID(), '_rc_stat_' . $i . '_label', true );
			if ( $number && $label ) {
				$stats[] = array( 'number' => $number, 'label' => $label );
			}
		}
		?>

		<?php if ( ! empty( $stats ) ) : ?>
			<div class="container case-study-content">
				<div class="stat-row case-study-stats">
					<?php foreach ( $stats as $stat ) : ?>
						<div class="stat">
							<span class="stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
							<span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="container case-study-content">
			<?php the_content(); ?>
		</div>

		<div class="container case-study-cta">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/portfolio" class="link-arrow">← Back to all case studies</a>
		</div>

	</article>

	<?php
endwhile;

get_footer();
