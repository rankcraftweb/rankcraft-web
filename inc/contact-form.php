<?php
/**
 * Contact Form Handler
 *
 * Lightweight, no-plugin contact form processing. Validates input,
 * checks a honeypot field and a Cloudflare Turnstile token (see
 * inc/turnstile.php), sends via wp_mail, then redirects back to the
 * Contact page with a status flag.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rankcraft_handle_contact_form() {
	if ( $_SERVER['REQUEST_METHOD'] !== 'POST' || ! isset( $_POST['rankcraft_contact_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['rankcraft_contact_nonce'], 'rankcraft_contact_submit' ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
		exit;
	}

	// Honeypot: real users never fill this hidden field. Bots usually do.
	if ( ! empty( $_POST['rc_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
		exit;
	}

	$name    = isset( $_POST['rc_name'] ) ? sanitize_text_field( $_POST['rc_name'] ) : '';
	$email   = isset( $_POST['rc_email'] ) ? sanitize_email( $_POST['rc_email'] ) : '';
	$message = isset( $_POST['rc_message'] ) ? sanitize_textarea_field( $_POST['rc_message'] ) : '';

	// Turnstile, when it is configured. Checked before the field
	// validation below so a bot never reaches wp_mail, and after
	// sanitising so a human who fails the challenge still gets their
	// text back rather than an empty form.
	$token = isset( $_POST['cf-turnstile-response'] ) ? sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) ) : '';

	if ( ! rankcraft_turnstile_verify( $token ) ) {
		rankcraft_contact_retry_redirect( 'challenge', $name, $email, $message );
	}

	if ( empty( $name ) || empty( $message ) || ! is_email( $email ) ) {
		rankcraft_contact_retry_redirect( 'error', $name, $email, $message );
	}

	$to      = get_option( 'admin_email' );
	$subject = 'New contact form submission from ' . $name;
	$body    = "Name: {$name}\nEmail: {$email}\n\nMessage:\n{$message}";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	rankcraft_record_contact_form_lead( $name, $email, $message );

	wp_safe_redirect( add_query_arg( 'contact', $sent ? 'success' : 'error', wp_get_referer() ) );
	exit;
}

/**
 * Bounce back to the form with a status, without losing what was typed.
 *
 * A failed submit used to return a fully blank form. The typed values are
 * stashed under a one-time token instead, so the form can refill itself.
 * Never returns.
 */
function rankcraft_contact_retry_redirect( $status, $name, $email, $message ) {
	$retry_token = wp_generate_password( 20, false );

	set_transient( 'rc_contact_retry_' . $retry_token, array(
		'name'    => $name,
		'email'   => $email,
		'message' => $message,
	), 5 * MINUTE_IN_SECONDS );

	wp_safe_redirect( add_query_arg( array(
		'contact'  => $status,
		'rc_retry' => $retry_token,
	), wp_get_referer() ) );
	exit;
}

/**
 * Contact-form submissions used to be invisible to the rc_lead pipeline
 * that the audit tool feeds — anyone who filled this form instead had
 * no record in the same status pipeline. Route them into the same CPT,
 * tagged by source, so there's one place to track every lead.
 */
function rankcraft_record_contact_form_lead( $name, $email, $message ) {
	$post_id = wp_insert_post( array(
		'post_type'   => 'rc_lead',
		'post_title'  => $name,
		'post_status' => 'publish',
	), true );

	if ( is_wp_error( $post_id ) ) {
		return;
	}

	update_post_meta( $post_id, '_rc_email', $email );
	update_post_meta( $post_id, '_rc_lead_status', 'new' );
	update_post_meta( $post_id, '_rc_lead_source', 'contact_form' );
	update_post_meta( $post_id, '_rc_message', $message );
}
add_action( 'template_redirect', 'rankcraft_handle_contact_form' );

/**
 * Render the contact form markup. Call with rankcraft_contact_form() in templates.
 */
function rankcraft_contact_form() {
	$sticky = array( 'name' => '', 'email' => '', 'message' => '' );

	if ( isset( $_GET['rc_retry'] ) ) {
		$retry_token = sanitize_text_field( wp_unslash( $_GET['rc_retry'] ) );
		$stashed     = get_transient( 'rc_contact_retry_' . $retry_token );

		if ( is_array( $stashed ) ) {
			$sticky = wp_parse_args( $stashed, $sticky );
			delete_transient( 'rc_contact_retry_' . $retry_token ); // one-time use
		}
	}
	?>
	<form method="post" class="contact-form" action="">
		<?php wp_nonce_field( 'rankcraft_contact_submit', 'rankcraft_contact_nonce' ); ?>

		<!-- Honeypot field, hidden from real visitors via CSS -->
		<div class="rc-hp-field" aria-hidden="true">
			<label for="rc_website">Website</label>
			<input type="text" name="rc_website" id="rc_website" tabindex="-1" autocomplete="off">
		</div>

		<div class="form-row">
			<label for="rc_name">Name</label>
			<input type="text" name="rc_name" id="rc_name" value="<?php echo esc_attr( $sticky['name'] ); ?>" required>
		</div>

		<div class="form-row">
			<label for="rc_email">Email</label>
			<input type="email" name="rc_email" id="rc_email" value="<?php echo esc_attr( $sticky['email'] ); ?>" required>
		</div>

		<div class="form-row">
			<label for="rc_message">Message</label>
			<textarea name="rc_message" id="rc_message" rows="5" required><?php echo esc_textarea( $sticky['message'] ); ?></textarea>
		</div>

		<?php rankcraft_turnstile_field(); ?>

		<button type="submit" class="btn btn-primary">Send message</button>
	</form>
	<?php
}
