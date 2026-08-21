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
 * The lead status pipeline: value => label/color, in pipeline order.
 * Used everywhere a status needs to be listed, validated, or rendered.
 */
function rankcraft_lead_statuses() {
	return array(
		'new'                  => array( 'label' => __( 'New', 'rankcraft-web' ), 'color' => '#2563EB' ),
		'contacted'            => array( 'label' => __( 'Contacted', 'rankcraft-web' ), 'color' => '#B45309' ),
		'proposal_sent'        => array( 'label' => __( 'Proposal Sent', 'rankcraft-web' ), 'color' => '#7C3AED' ),
		'client'               => array( 'label' => __( 'Client', 'rankcraft-web' ), 'color' => '#15803D' ),
		'case_study_published' => array( 'label' => __( 'Case Study Published', 'rankcraft-web' ), 'color' => '#0F766E' ),
	);
}

/**
 * Admin list table: replace the default columns with the fields that
 * actually matter for a lead (name, status, email, audited URL, mobile
 * performance score, date).
 */
function rankcraft_leads_admin_columns( $columns ) {
	return array(
		'cb'                    => $columns['cb'],
		'title'                 => __( 'Name', 'rankcraft-web' ),
		'rc_status'             => __( 'Status', 'rankcraft-web' ),
		'rc_email'              => __( 'Email', 'rankcraft-web' ),
		'rc_audited_url'        => __( 'Audited URL', 'rankcraft-web' ),
		'rc_mobile_performance' => __( 'Mobile Performance', 'rankcraft-web' ),
		'date'                  => $columns['date'],
	);
}
add_filter( 'manage_rc_lead_posts_columns', 'rankcraft_leads_admin_columns' );

function rankcraft_leads_admin_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'rc_status':
			$statuses = rankcraft_lead_statuses();
			$status   = get_post_meta( $post_id, '_rc_lead_status', true );
			if ( ! isset( $statuses[ $status ] ) ) {
				$status = 'new';
			}
			$color = $statuses[ $status ]['color'];

			printf(
				'<span class="rc-lead-status-badge" style="color:%1$s; background:%1$s1a; border-color:%1$s55;">%2$s</span>',
				esc_attr( $color ),
				esc_html( $statuses[ $status ]['label'] )
			);
			// Hidden holder so Quick Edit's JS can read the current value per row.
			printf( '<div class="hidden" id="rc_lead_status_inline_%1$d">%2$s</div>', (int) $post_id, esc_html( $status ) );
			break;

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
 * Status badge styling. Simple inline <style>, only printed on the Leads
 * list screen, no build step or separate stylesheet needed for this.
 */
function rankcraft_leads_admin_styles() {
	$screen = get_current_screen();
	if ( ! $screen || 'rc_lead' !== $screen->post_type || 'edit-rc_lead' !== $screen->id ) {
		return;
	}
	?>
	<style>
		.rc-lead-status-badge {
			display: inline-block;
			padding: 2px 10px;
			border: 1px solid;
			border-radius: 999px;
			font-size: 12px;
			font-weight: 600;
			line-height: 1.8;
			white-space: nowrap;
		}
	</style>
	<?php
}
add_action( 'admin_head-edit.php', 'rankcraft_leads_admin_styles' );

/**
 * Quick Edit: render the Status dropdown. WordPress calls this once per
 * custom column on the list screen; we only care about our own.
 */
function rankcraft_lead_quick_edit_box( $column_name, $post_type ) {
	if ( 'rc_status' !== $column_name || 'rc_lead' !== $post_type ) {
		return;
	}
	?>
	<fieldset class="inline-edit-col-right inline-edit-rc-lead">
		<div class="inline-edit-col">
			<label>
				<span class="title"><?php esc_html_e( 'Status', 'rankcraft-web' ); ?></span>
				<select name="rc_lead_status">
					<?php foreach ( rankcraft_lead_statuses() as $value => $meta ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $meta['label'] ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
	</fieldset>
	<?php
}
add_action( 'quick_edit_custom_box', 'rankcraft_lead_quick_edit_box', 10, 2 );

/**
 * Quick Edit ships with no idea our Status column exists, so its JS
 * doesn't know to populate the dropdown. This wraps WordPress's own
 * inlineEditPost.edit() to fill it in from the hidden per-row value.
 */
function rankcraft_leads_quick_edit_script( $hook ) {
	if ( 'edit.php' !== $hook ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || 'rc_lead' !== $screen->post_type ) {
		return;
	}

	wp_add_inline_script( 'inline-edit-post', "
		jQuery(function($){
			var rcWpInlineEdit = inlineEditPost.edit;
			inlineEditPost.edit = function(id) {
				rcWpInlineEdit.apply(this, arguments);
				var postId = 0;
				if (typeof id === 'object') {
					postId = parseInt(this.getId(id), 10);
				}
				if (postId > 0) {
					var status = $('#rc_lead_status_inline_' + postId).text();
					$('select[name=\"rc_lead_status\"]').val(status);
				}
			};
		});
	" );
}
add_action( 'admin_enqueue_scripts', 'rankcraft_leads_quick_edit_script' );

/**
 * Save the status from Quick Edit. WordPress's own inline-save handler
 * has already checked the nonce and the user's edit capability for this
 * post by the time save_post_{post_type} fires.
 */
function rankcraft_save_lead_quick_edit( $post_id ) {
	if ( ! isset( $_POST['rc_lead_status'] ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$statuses = rankcraft_lead_statuses();
	$status   = sanitize_key( wp_unslash( $_POST['rc_lead_status'] ) );

	if ( ! isset( $statuses[ $status ] ) ) {
		return;
	}

	update_post_meta( $post_id, '_rc_lead_status', $status );
}
add_action( 'save_post_rc_lead', 'rankcraft_save_lead_quick_edit' );

/**
 * Status filter links above the list table ("All | New | Contacted | ..."),
 * same idea as the built-in All / Published / Draft views.
 */
function rankcraft_lead_status_views( $views ) {
	$statuses = rankcraft_lead_statuses();
	$current  = isset( $_GET['rc_lead_status'] ) ? sanitize_key( wp_unslash( $_GET['rc_lead_status'] ) ) : '';
	$base_url = admin_url( 'edit.php?post_type=rc_lead' );

	$total       = (int) wp_count_posts( 'rc_lead' )->publish;
	$new_views   = array();
	$new_views['all'] = sprintf(
		'<a href="%1$s"%2$s>%3$s <span class="count">(%4$d)</span></a>',
		esc_url( $base_url ),
		( '' === $current ) ? ' class="current"' : '',
		esc_html__( 'All', 'rankcraft-web' ),
		$total
	);

	foreach ( $statuses as $value => $meta ) {
		$count_query = new WP_Query( array(
			'post_type'      => 'rc_lead',
			'post_status'    => 'publish',
			'meta_key'       => '_rc_lead_status',
			'meta_value'     => $value,
			'posts_per_page' => 1,
			'fields'         => 'ids',
		) );

		$new_views[ $value ] = sprintf(
			'<a href="%1$s"%2$s>%3$s <span class="count">(%4$d)</span></a>',
			esc_url( add_query_arg( 'rc_lead_status', $value, $base_url ) ),
			( $current === $value ) ? ' class="current"' : '',
			esc_html( $meta['label'] ),
			(int) $count_query->found_posts
		);
	}

	return $new_views;
}
add_filter( 'views_edit-rc_lead', 'rankcraft_lead_status_views' );

/**
 * Apply the status filter to the list table query when one of the views
 * links above is active.
 */
function rankcraft_lead_status_filter_query( $query ) {
	global $pagenow;

	if ( ! is_admin() || 'edit.php' !== $pagenow || ! $query->is_main_query() ) {
		return;
	}
	if ( 'rc_lead' !== $query->get( 'post_type' ) ) {
		return;
	}
	if ( empty( $_GET['rc_lead_status'] ) ) {
		return;
	}

	$status   = sanitize_key( wp_unslash( $_GET['rc_lead_status'] ) );
	$statuses = rankcraft_lead_statuses();
	if ( ! isset( $statuses[ $status ] ) ) {
		return;
	}

	$query->set( 'meta_key', '_rc_lead_status' );
	$query->set( 'meta_value', $status );
}
add_action( 'pre_get_posts', 'rankcraft_lead_status_filter_query' );

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
	update_post_meta( $post_id, '_rc_lead_status', 'new' );

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
