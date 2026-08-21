<?php
/**
 * RankCraft Business System - Leads
 *
 * First piece of the RankCraft Business System: a lightweight lead
 * capture store for the standalone audit tool (rankcraft-audit). Leads
 * are stored as a private custom post type and created through a public
 * REST endpoint, no plugin dependency.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `rc_lead` post type: admin-only, not publicly queryable,
 * not exposed through the default WordPress REST post routes (we expose
 * our own narrow endpoint below instead).
 */
function rankcraft_register_leads_post_type() {
	$labels = array(
		'name'          => __( 'Leads', 'rankcraft-web' ),
		'singular_name' => __( 'Lead', 'rankcraft-web' ),
		'all_items'     => __( 'Leads', 'rankcraft-web' ),
		'edit_item'     => __( 'View Lead', 'rankcraft-web' ),
		'view_item'     => __( 'View Lead', 'rankcraft-web' ),
		'search_items'  => __( 'Search Leads', 'rankcraft-web' ),
		'not_found'     => __( 'No leads yet.', 'rankcraft-web' ),
	);

	register_post_type( 'rc_lead', array(
		'labels'              => $labels,
		'public'              => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => false,
		'has_archive'         => false,
		'rewrite'             => false,
		'query_var'           => false,
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-groups',
		'supports'            => array( 'title' ),
	) );
}
add_action( 'init', 'rankcraft_register_leads_post_type' );

/**
 * Admin list table: replace the default columns with the fields that
 * actually matter for a lead (name, email, audited URL, mobile
 * performance score, date).
 */
function rankcraft_leads_admin_columns( $columns ) {
	return array(
		'cb'                    => $columns['cb'],
		'title'                 => __( 'Name', 'rankcraft-web' ),
		'rc_email'              => __( 'Email', 'rankcraft-web' ),
		'rc_audited_url'        => __( 'Audited URL', 'rankcraft-web' ),
		'rc_mobile_performance' => __( 'Mobile Performance', 'rankcraft-web' ),
		'date'                  => $columns['date'],
	);
}
add_filter( 'manage_rc_lead_posts_columns', 'rankcraft_leads_admin_columns' );

function rankcraft_leads_admin_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'rc_email':
			echo esc_html( get_post_meta( $post_id, '_rc_email', true ) );
			break;

		case 'rc_audited_url':
			$url = get_post_meta( $post_id, '_rc_audited_url', true );
			if ( $url ) {
				printf(
					'<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
					esc_url( $url ),
					esc_html( $url )
				);
			}
			break;

		case 'rc_mobile_performance':
			echo esc_html( get_post_meta( $post_id, '_rc_mobile_performance', true ) );
			break;
	}
}
add_action( 'manage_rc_lead_posts_custom_column', 'rankcraft_leads_admin_column_content', 10, 2 );

/**
 * Public REST endpoint the audit tool posts new leads to.
 */
function rankcraft_register_leads_rest_route() {
	register_rest_route( 'rankcraft/v1', '/leads', array(
		'methods'             => 'POST',
		'callback'            => 'rankcraft_handle_leads_submission',
		'permission_callback' => '__return_true',
	) );
}
add_action( 'rest_api_init', 'rankcraft_register_leads_rest_route' );

/**
 * Pull a 0-100 integer score out of a scores sub-object, defaulting to 0
 * for anything missing or malformed rather than rejecting the request.
 */
function rankcraft_extract_scores( $data ) {
	$fields = array(
		'performance'   => 'performance',
		'accessibility' => 'accessibility',
		'bestPractices' => 'best_practices',
		'seo'           => 'seo',
	);

	$scores = array();
	foreach ( $fields as $input_key => $meta_key ) {
		$value             = isset( $data[ $input_key ] ) ? (int) $data[ $input_key ] : 0;
		$scores[ $meta_key ] = max( 0, min( 100, $value ) );
	}

	return $scores;
}

/**
 * Very lightweight IP-based rate limit: 5 submissions per IP per hour.
 * Not meant to stop a determined attacker, just casual/accidental abuse.
 */
function rankcraft_leads_rate_limited() {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'rc_leads_rl_' . md5( $ip );

	$count = (int) get_transient( $key );
	if ( $count >= 5 ) {
		return true;
	}

	set_transient( $key, $count + 1, HOUR_IN_SECONDS );
	return false;
}

function rankcraft_handle_leads_submission( WP_REST_Request $request ) {
	$params = $request->get_json_params();

	if ( ! is_array( $params ) ) {
		$params = array();
	}

	// Honeypot: a hidden field real callers never send. Bots that blindly
	// fill every field will trip it. Same pattern as inc/contact-form.php.
	if ( ! empty( $params['website'] ) ) {
		return new WP_REST_Response( array( 'success' => true ), 201 );
	}

	if ( rankcraft_leads_rate_limited() ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Too many requests. Please try again later.',
		), 429 );
	}

	$name  = isset( $params['name'] ) ? sanitize_text_field( trim( $params['name'] ) ) : '';
	$email = isset( $params['email'] ) ? sanitize_email( trim( $params['email'] ) ) : '';
	$url   = isset( $params['url'] ) ? esc_url_raw( trim( $params['url'] ) ) : '';

	if ( empty( $name ) || empty( $url ) || ! is_email( $email ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'A valid name, email, and URL are required.',
		), 400 );
	}

	$mobile  = rankcraft_extract_scores( isset( $params['mobile'] ) && is_array( $params['mobile'] ) ? $params['mobile'] : array() );
	$desktop = rankcraft_extract_scores( isset( $params['desktop'] ) && is_array( $params['desktop'] ) ? $params['desktop'] : array() );

	$post_id = wp_insert_post( array(
		'post_type'   => 'rc_lead',
		'post_title'  => $name,
		'post_status' => 'publish',
	), true );

	if ( is_wp_error( $post_id ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Could not save the lead.',
		), 500 );
	}

	update_post_meta( $post_id, '_rc_email', $email );
	update_post_meta( $post_id, '_rc_audited_url', $url );

	foreach ( $mobile as $meta_key => $value ) {
		update_post_meta( $post_id, '_rc_mobile_' . $meta_key, $value );
	}
	foreach ( $desktop as $meta_key => $value ) {
		update_post_meta( $post_id, '_rc_desktop_' . $meta_key, $value );
	}

	return new WP_REST_Response( array(
		'success' => true,
		'id'      => $post_id,
	), 201 );
}
