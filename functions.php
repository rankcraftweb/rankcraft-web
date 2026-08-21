<?php
/**
 * RankCraft Web Theme Functions
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RANKCRAFT_VERSION', '1.0.0' );
define( 'RANKCRAFT_DIR', get_template_directory() );
define( 'RANKCRAFT_URI', get_template_directory_uri() );

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
	wp_enqueue_style( 'rankcraft-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap', array(), null );
	wp_enqueue_style( 'rankcraft-main', RANKCRAFT_URI . '/assets/css/main.css', array(), RANKCRAFT_VERSION );
	wp_enqueue_script( 'rankcraft-main', RANKCRAFT_URI . '/assets/js/main.js', array(), RANKCRAFT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'rankcraft_enqueue_assets' );

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
 * Include additional theme files.
 */
require_once RANKCRAFT_DIR . '/inc/schema-markup.php';
require_once RANKCRAFT_DIR . '/inc/case-study-meta.php';
require_once RANKCRAFT_DIR . '/inc/contact-form.php';
require_once RANKCRAFT_DIR . '/inc/smtp.php';
