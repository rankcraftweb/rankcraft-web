<?php
/**
 * Cloudflare Turnstile
 *
 * Spam protection for the contact form. The honeypot in
 * inc/contact-form.php only catches bots that fill in every field they
 * find; it does nothing against one written against this specific form,
 * which is what a form with stable field names eventually attracts.
 *
 * Keys live in wp-config.php, not in this repo and not in the options
 * table:
 *
 *   define( 'RANKCRAFT_TURNSTILE_SITE_KEY', '0x4AAA...' );
 *   define( 'RANKCRAFT_TURNSTILE_SECRET_KEY', '0x4AAA...' );
 *
 * The site key is public - it is printed into the page - but the secret
 * key must never reach version control, so both are read from constants
 * to keep them in one place.
 *
 * With either constant missing every function here is a no-op and the
 * form behaves exactly as it did before. That is deliberate: the theme
 * deploys before the keys are entered, and a contact form that rejects
 * every submission because a constant is undefined is worse than no
 * Turnstile at all.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const RANKCRAFT_TURNSTILE_VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
const RANKCRAFT_TURNSTILE_API_URL    = 'https://challenges.cloudflare.com/turnstile/v0/api.js';

function rankcraft_turnstile_site_key() {
	return defined( 'RANKCRAFT_TURNSTILE_SITE_KEY' ) ? (string) RANKCRAFT_TURNSTILE_SITE_KEY : '';
}

function rankcraft_turnstile_secret_key() {
	return defined( 'RANKCRAFT_TURNSTILE_SECRET_KEY' ) ? (string) RANKCRAFT_TURNSTILE_SECRET_KEY : '';
}

/**
 * Both keys, or nothing. A site key on its own would render a widget
 * whose answer is never checked - the appearance of protection, which is
 * the one outcome worse than none.
 */
function rankcraft_turnstile_enabled() {
	return '' !== rankcraft_turnstile_site_key() && '' !== rankcraft_turnstile_secret_key();
}

/**
 * Print the widget and queue Cloudflare's script.
 *
 * Called from inside the form markup rather than from wp_enqueue_scripts,
 * so the script is requested only on a page that actually has a form on
 * it. Enqueueing this late still works: footer scripts are not printed
 * until wp_footer, long after the template body has run.
 */
function rankcraft_turnstile_field() {
	if ( ! rankcraft_turnstile_enabled() ) {
		return;
	}

	wp_enqueue_script(
		'cloudflare-turnstile',
		RANKCRAFT_TURNSTILE_API_URL,
		array(),
		null,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	?>
	<div class="form-row form-row-turnstile">
		<div class="cf-turnstile"
			data-sitekey="<?php echo esc_attr( rankcraft_turnstile_site_key() ); ?>"
			data-action="contact"
			data-theme="light"></div>
	</div>
	<?php
}

/**
 * Check a submitted token with Cloudflare.
 *
 * Returns true when the visitor should be let through. Two different
 * failures are treated differently on purpose:
 *
 * - A verdict of "not a human" from Cloudflare is a rejection.
 * - A network failure, a timeout, or a non-200 is NOT. If Cloudflare is
 *   unreachable the form is the only way a lead can reach this business,
 *   and silently dropping real enquiries for the length of someone
 *   else's outage costs more than the handful of spam that would get
 *   through in the same window. A bot has no way to know when that
 *   window is open.
 *
 * An empty token still fails closed - that is a request that skipped the
 * widget entirely, which is the case this exists to stop.
 */
function rankcraft_turnstile_verify( $token ) {
	if ( ! rankcraft_turnstile_enabled() ) {
		return true;
	}

	if ( '' === $token ) {
		return false;
	}

	// remoteip is deliberately not sent. Cloudflare validates it against
	// the address that solved the challenge, and REMOTE_ADDR on shared
	// hosting behind a proxy is not reliably that address - which would
	// turn a correct answer into a rejection.
	$response = wp_remote_post( RANKCRAFT_TURNSTILE_VERIFY_URL, array(
		'timeout' => 10,
		'body'    => array(
			'secret'   => rankcraft_turnstile_secret_key(),
			'response' => $token,
		),
	) );

	if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
		return true;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	return is_array( $body ) && ! empty( $body['success'] );
}
