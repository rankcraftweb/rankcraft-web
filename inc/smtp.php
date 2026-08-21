<?php
/**
 * SMTP configuration for outgoing mail (contact form notifications, etc).
 *
 * Routes wp_mail() through Hostinger's SMTP server instead of PHP's mail(),
 * which greatly improves deliverability. Reads credentials from wp-config.php
 * constants so nothing sensitive lives in the theme/repo:
 *
 *     define( 'RANKCRAFT_SMTP_USER', 'hello@rankcraftweb.com' );
 *     define( 'RANKCRAFT_SMTP_PASS', 'your-mailbox-password' );
 *
 * If those constants aren't defined (e.g. on local dev), this file does
 * nothing and wp_mail() falls back to its default behavior.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rankcraft_configure_smtp( $phpmailer ) {
	if ( ! defined( 'RANKCRAFT_SMTP_USER' ) || ! defined( 'RANKCRAFT_SMTP_PASS' ) ) {
		return;
	}

	$phpmailer->isSMTP();
	$phpmailer->Host       = 'smtp.hostinger.com';
	$phpmailer->Port       = 465;
	$phpmailer->SMTPSecure = 'ssl';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Username   = RANKCRAFT_SMTP_USER;
	$phpmailer->Password   = RANKCRAFT_SMTP_PASS;
	$phpmailer->From       = RANKCRAFT_SMTP_USER;
	$phpmailer->FromName   = get_bloginfo( 'name' );
}
add_action( 'phpmailer_init', 'rankcraft_configure_smtp' );
