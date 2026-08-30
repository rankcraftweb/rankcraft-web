<?php
/**
 * Case Study archive template.
 *
 * This is the page the site calls its proof, and it used to be the
 * thinnest page on it: 131 words, no framing, and not one of the four
 * measured numbers each case study carries in post meta. The proof was
 * in the database and nothing rendered it.
 *
 * Cards now show the first three stats. The fourth is left off on
 * purpose - some of the fourth labels are full sentences and would
 * wreck the row - and every card still links through to the write-up,
 * where all four appear.
 *
 * @package RankCraft_Web
 */

get_header();
?>

<section class="portfolio-archive">
	<div class="container">
		<p class="section-label">Portfolio</p>
		<h1>Work you can go and check</h1>
		<p class="section-intro portfolio-intro">Each of these links to the live site it describes, and to a write-up of what the project had to do and where it ended up. Nothing here has to be taken on trust.</p>

		<div class="portfolio-grid">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					// Same meta the single template reads. Capped at three:
					// the card is roughly half the container and a fourth
					// column leaves no room for a label to wrap into.
					$card_stats = array();
					for ( $i = 1; $i <= 3; $i++ ) {
						$number = get_post_meta( get_the_ID(), '_rc_stat_' . $i . '_number', true );
						$label  = get_post_meta( get_the_ID(), '_rc_stat_' . $i . '_label', true );
						if ( '' !== $number && '' !== $label ) {
							$card_stats[] = array( 'number' => $number, 'label' => $label );
						}
					}
					?>
					<a href="<?php the_permalink(); ?>" class="portfolio-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="portfolio-card-image">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</div>
						<?php endif; ?>
						<div class="portfolio-card-body">
							<h2><?php the_title(); ?></h2>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>

							<?php if ( ! empty( $card_stats ) ) : ?>
								<div class="card-stats">
									<?php foreach ( $card_stats as $stat ) : ?>
										<div class="card-stat">
											<span class="card-stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
											<span class="card-stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<span class="link-arrow">Read case study &rarr;</span>
						</div>
					</a>
				<?php endwhile; ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Case studies coming soon.', 'rankcraft-web' ); ?></p>
			<?php endif; ?>
		</div>

		<div class="blog-pagination">
			<?php
			echo paginate_links( array(
				'prev_text' => '&larr; Previous',
				'next_text' => 'Next &rarr;',
			) );
			?>
		</div>
	</div>
</section>

<section class="about-cta about-cta--shaded">
	<div class="container">
		<h2>Want to know where your own site stands?</h2>
		<div class="about-cta-buttons">
			<a href="https://audit.rankcraftweb.com" class="btn btn-primary">Get your free audit</a>
			<a href="/contact" class="btn btn-secondary-dark">Get in touch</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
