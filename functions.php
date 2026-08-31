<?php
/**
 * RankCraft Web Theme Functions
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RANKCRAFT_VERSION', '1.21.3' );
define( 'RANKCRAFT_DIR', get_template_directory() );
define( 'RANKCRAFT_URI', get_template_directory_uri() );
define( 'RANKCRAFT_GA4_ID', 'G-S1816MHVM3' );

/**
 * Theme setup: register support for core features.
 */
function rankcraft_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'rankcraft-web' ),
		'footer'  => __( 'Footer Menu', 'rankcraft-web' ),
	) );
}
add_action( 'after_setup_theme', 'rankcraft_setup' );

/**
 * Enqueue theme styles and scripts.
 */
function rankcraft_enqueue_assets() {
	wp_enqueue_style( 'rankcraft-main', RANKCRAFT_URI . '/assets/css/main.css', array(), RANKCRAFT_VERSION );
	wp_enqueue_script( 'rankcraft-main', RANKCRAFT_URI . '/assets/js/main.js', array(), RANKCRAFT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'rankcraft_enqueue_assets' );

/**
 * Basic hardening headers. HSTS is defense-in-depth (HTTP already
 * redirects to HTTPS), and hiding the PHP version stops it from being
 * handed out for free in every response.
 */
function rankcraft_security_headers() {
	header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains' );
	header_remove( 'X-Powered-By' );
}
add_action( 'send_headers', 'rankcraft_security_headers' );

/**
 * Redirect legacy URLs that are still indexed but no longer resolve
 * to a page (replaced by /performance-audits/ and /portfolio/).
 * /services/ used to redirect here too, but now has a real page.
 *
 * The batch below (packages, areas-we-serve, the two city-specific
 * service pages, seo-optimization, refund-policy) turned up 404 in a
 * GSC audit - a past site restructure dropped these pages without
 * redirects, several of which had real impressions and page-2/3
 * rankings for local-intent queries. Sending them to their closest
 * surviving equivalent recovers that link/ranking equity instead of
 * leaking it to a dead end.
 */
function rankcraft_legacy_redirects() {
	$path = untrailingslashit( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );

	$redirects = array(
		'/projects'                        => home_url( '/portfolio/' ),
		'/packages'                        => home_url( '/services/' ),
		'/areas-we-serve'                  => home_url( '/website-developer-silang-cavite/' ),
		'/web-design-seo-services-cavite'  => home_url( '/website-developer-silang-cavite/' ),
		'/web-design-seo-services-laguna'  => home_url( '/seo-and-local-search/' ),
		'/seo-optimization'                => home_url( '/seo-and-local-search/' ),
		'/refund-policy'                   => home_url( '/terms-of-service/' ),
	);

	if ( isset( $redirects[ $path ] ) ) {
		wp_safe_redirect( $redirects[ $path ], 301 );
		exit;
	}
}
add_action( 'template_redirect', 'rankcraft_legacy_redirects' );

/**
 * Register "Case Studies" custom post type.
 * Used for portfolio items like the Rossi Real Estate project.
 */
function rankcraft_register_case_studies() {
	$labels = array(
		'name'          => __( 'Case Studies', 'rankcraft-web' ),
		'singular_name' => __( 'Case Study', 'rankcraft-web' ),
		'add_new_item'  => __( 'Add New Case Study', 'rankcraft-web' ),
		'edit_item'     => __( 'Edit Case Study', 'rankcraft-web' ),
		'all_items'     => __( 'All Case Studies', 'rankcraft-web' ),
	);

	register_post_type( 'case_study', array(
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => true,
		'rewrite'      => array( 'slug' => 'portfolio' ),
		'menu_icon'    => 'dashicons-chart-line',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'rankcraft_register_case_studies' );

/**
 * The case_study archive lives at /portfolio/ and the nav calls it
 * "Portfolio", but the CPT's admin label ("Case Studies") is what
 * WordPress uses for the <title> tag by default. Override just the
 * document title so it matches both phrasings people search for.
 */
function rankcraft_case_study_archive_title( $title_parts ) {
	if ( is_post_type_archive( 'case_study' ) ) {
		$title_parts['title'] = 'Portfolio & Case Studies';
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'rankcraft_case_study_archive_title' );

/**
 * Every inner page renders as "{Topic} - RankCraft Web", but WordPress
 * inverts that on the front page to "{Site name} - {tagline}". That spends
 * the most valuable part of the title on the brand, and Search Console puts
 * the bare brand name around position 38 - it carries no pull yet, so
 * nothing is searching for it. Lead with the service here too, and keep the
 * name in the trailing half where it still builds recognition.
 *
 * On the front page the parts are 'title' + 'tagline'; elsewhere they're
 * 'title' + 'site', which is why this can't just reuse the filter above.
 */
function rankcraft_front_page_title( $title_parts ) {
	if ( is_front_page() ) {
		$title_parts['title']   = 'WordPress Development & Technical SEO';
		$title_parts['tagline'] = get_bloginfo( 'name' );
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'rankcraft_front_page_title' );

/**
 * "About" on its own spends the whole title tag on a word nobody
 * searches, and Search Console shows this page pulling only branded
 * queries. Name what the page is actually about so the tag carries
 * something, while keeping the site-wide "{Topic} - RankCraft Web" shape.
 */
function rankcraft_about_page_title( $title_parts ) {
	if ( is_page( 'about' ) ) {
		$title_parts['title'] = 'About Jan, WordPress Developer & Technical SEO';
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'rankcraft_about_page_title' );

/**
 * "Services" spends the tag on a nav label. The page carries the
 * pricing, and published prices are uncommon enough in this trade to
 * be worth naming: someone comparing quotes is searching for exactly
 * that. The nav label stays "Services", because only the tag needs to
 * say more.
 */
function rankcraft_services_page_title( $title_parts ) {
	if ( is_page( 'services' ) ) {
		$title_parts['title'] = 'Services and Pricing';
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'rankcraft_services_page_title' );

/**
 * Include additional theme files.
 */
require_once RANKCRAFT_DIR . '/inc/seo-meta.php';
require_once RANKCRAFT_DIR . '/inc/schema-markup.php';
require_once RANKCRAFT_DIR . '/inc/case-study-meta.php';
require_once RANKCRAFT_DIR . '/inc/contact-form.php';
require_once RANKCRAFT_DIR . '/inc/smtp.php';
require_once RANKCRAFT_DIR . '/inc/leads.php';
require_once RANKCRAFT_DIR . '/inc/indexation.php';
