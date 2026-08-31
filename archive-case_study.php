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

<section class="service-hero">
	<div class="container service-hero-inner">
		<div class="service-hero-text">
			<p class="section-label">Portfolio</p>
			<h1>Work you can go and check</h1>
			<p class="service-hero-lead">Each of these links to the live site it describes, and to a write-up of what the project had to do and where it ended up. Nothing here has to be taken on trust.</p>
		</div>
		<div class="service-hero-visual"><svg class="hero-illustration" viewBox="0 0 400 300" aria-hidden="true" focusable="false"><rect x="24" y="88" width="130" height="118" rx="12" fill="#0F3252" stroke="#2A5F92" stroke-width="1.5"/><path d="M24 114h130" stroke="#2A5F92" stroke-width="1.5"/><g fill="#2A5F92"><rect x="40" y="130" width="68" height="7" rx="3.5"/><rect x="40" y="146" width="92" height="6" rx="3"/><rect x="40" y="160" width="58" height="6" rx="3"/></g><rect x="246" y="88" width="130" height="118" rx="12" fill="#0F3252" stroke="#2A5F92" stroke-width="1.5"/><path d="M246 114h130" stroke="#2A5F92" stroke-width="1.5"/><g fill="#2A5F92"><rect x="262" y="130" width="68" height="7" rx="3.5"/><rect x="262" y="146" width="92" height="6" rx="3"/><rect x="262" y="160" width="58" height="6" rx="3"/></g><rect x="120" y="50" width="160" height="194" rx="14" fill="#123A5E" stroke="#63C89F" stroke-width="2"/><path d="M120 84h160" stroke="#2A5F92" stroke-width="1.5"/><circle cx="139" cy="67" r="4" fill="#3C6E9C"/><circle cx="153" cy="67" r="4" fill="#3C6E9C"/><circle cx="167" cy="67" r="4" fill="#3C6E9C"/><rect x="140" y="104" width="92" height="9" rx="4.5" fill="#F4F6F9"/><g fill="#3C6E9C"><rect x="140" y="124" width="120" height="7" rx="3.5"/><rect x="140" y="140" width="96" height="7" rx="3.5"/></g><rect x="140" y="166" width="120" height="52" rx="10" fill="#0C2A4A"/><circle cx="166" cy="192" r="14" fill="#1D9E75"/><path d="M160 192l4 4 8-9" stroke="#F4F6F9" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/><rect x="190" y="183" width="56" height="7" rx="3.5" fill="#F4F6F9"/><rect x="190" y="197" width="40" height="6" rx="3" fill="#3C6E9C"/></svg></div>
	</div>
</section>

<section class="portfolio-archive">
	<div class="container">
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
