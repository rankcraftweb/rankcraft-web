<?php
/**
 * Template for the Contact page (slug: contact).
 *
 * @package RankCraft_Web
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<section class="contact-page">
		<div class="container contact-page-inner">

			<div class="contact-intro">
				<h1><?php the_title(); ?></h1>
				<div class="contact-content"><?php the_content(); ?></div>
			</div>

			<div class="contact-form-wrap">
				<?php if ( isset( $_GET['contact'] ) && $_GET['contact'] === 'success' ) : ?>
					<div class="form-notice form-notice-success">Thanks, your message has been sent. We'll get back to you within one business day.</div>
				<?php elseif ( isset( $_GET['contact'] ) && $_GET['contact'] === 'error' ) : ?>
					<div class="form-notice form-notice-error">Something went wrong. Double check your details and try again, or email us directly.</div>
				<?php endif; ?>

				<?php rankcraft_contact_form(); ?>
			</div>

		</div>
	</section>

	<?php
endwhile;

get_footer();
