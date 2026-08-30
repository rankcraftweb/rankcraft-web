<?php
/**
 * Single Case Study template.
 *
 * @package RankCraft_Web
 */

get_header();

while ( have_posts() ) :
	the_post();

	$project_url = get_post_meta( get_the_ID(), '_rc_project_url', true );
	?>

	<article class="case-study-single">

		<header class="case-study-hero">
			<div class="container">
				<p class="section-label">Case study</p>
				<h1><?php the_title(); ?></h1>
				<?php if ( $project_url ) : ?>
					<p class="case-study-client">
						<a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener">Visit site ↗</a>
					</p>
				<?php endif; ?>
			</div>
		</header>

		<?php
		// Build the stat row from meta fields, skipping any that are empty.
		// Compared against the empty string rather than tested for truth:
		// "0" is falsy in PHP, so a truthiness check silently swallows a
		// zero, which is usually the whole point of the stat.
		$stats = array();
		for ( $i = 1; $i <= 4; $i++ ) {
			$number = get_post_meta( get_the_ID(), '_rc_stat_' . $i . '_number', true );
			$label  = get_post_meta( get_the_ID(), '_rc_stat_' . $i . '_label', true );
			if ( '' !== $number && '' !== $label ) {
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
