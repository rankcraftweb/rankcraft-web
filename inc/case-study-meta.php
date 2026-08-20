<?php
/**
 * Case Study Meta Box
 *
 * Lightweight custom fields for case studies (client name, project URL,
 * and up to 4 key stats) without requiring the ACF plugin.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the meta box on the case_study edit screen.
 */
function rankcraft_add_case_study_meta_box() {
	add_meta_box(
		'rankcraft_case_study_details',
		__( 'Case Study Details', 'rankcraft-web' ),
		'rankcraft_render_case_study_meta_box',
		'case_study',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'rankcraft_add_case_study_meta_box' );

/**
 * Render the meta box fields.
 */
function rankcraft_render_case_study_meta_box( $post ) {
	wp_nonce_field( 'rankcraft_case_study_save', 'rankcraft_case_study_nonce' );

	$client_name = get_post_meta( $post->ID, '_rc_client_name', true );
	$project_url = get_post_meta( $post->ID, '_rc_project_url', true );

	echo '<p><label><strong>' . esc_html__( 'Client name', 'rankcraft-web' ) . '</strong></label><br>';
	echo '<input type="text" name="rc_client_name" value="' . esc_attr( $client_name ) . '" style="width:100%;" /></p>';

	echo '<p><label><strong>' . esc_html__( 'Project URL', 'rankcraft-web' ) . '</strong></label><br>';
	echo '<input type="text" name="rc_project_url" value="' . esc_attr( $project_url ) . '" style="width:100%;" placeholder="https://" /></p>';

	echo '<hr><p><strong>' . esc_html__( 'Key stats (shown as a stat row on the case study page)', 'rankcraft-web' ) . '</strong></p>';

	for ( $i = 1; $i <= 4; $i++ ) {
		$number = get_post_meta( $post->ID, '_rc_stat_' . $i . '_number', true );
		$label  = get_post_meta( $post->ID, '_rc_stat_' . $i . '_label', true );

		echo '<div style="display:flex; gap:12px; margin-bottom:8px;">';
		echo '<input type="text" name="rc_stat_' . $i . '_number" value="' . esc_attr( $number ) . '" placeholder="e.g. 99" style="width:100px;" />';
		echo '<input type="text" name="rc_stat_' . $i . '_label" value="' . esc_attr( $label ) . '" placeholder="e.g. Performance score" style="flex:1;" />';
		echo '</div>';
	}
}

/**
 * Save the meta box fields.
 */
function rankcraft_save_case_study_meta( $post_id ) {
	if ( ! isset( $_POST['rankcraft_case_study_nonce'] ) || ! wp_verify_nonce( $_POST['rankcraft_case_study_nonce'], 'rankcraft_case_study_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array( 'rc_client_name', 'rc_project_url' );
	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
		}
	}

	for ( $i = 1; $i <= 4; $i++ ) {
		$number_key = 'rc_stat_' . $i . '_number';
		$label_key  = 'rc_stat_' . $i . '_label';

		if ( isset( $_POST[ $number_key ] ) ) {
			update_post_meta( $post_id, '_' . $number_key, sanitize_text_field( $_POST[ $number_key ] ) );
		}
		if ( isset( $_POST[ $label_key ] ) ) {
			update_post_meta( $post_id, '_' . $label_key, sanitize_text_field( $_POST[ $label_key ] ) );
		}
	}
}
add_action( 'save_post_case_study', 'rankcraft_save_case_study_meta' );
