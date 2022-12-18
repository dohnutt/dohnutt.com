<?php
/*
 * Plugin Extensions & Overrides
 * `inc/plugin-functions.php`
 *
 * Override functionality for consistently-used plugins.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( defined('WPFORMS_VERSION') ) {

	add_filter( 'wpforms_field_properties', 'doh_wpforms_field_properties', 10, 3 );
	function doh_wpforms_field_properties( $properties, $field, $form_data ) {

		foreach ( $properties['inputs'] as &$input) {

		if ( ! isset($input['class']) )
			continue;

		$input['class'][] = 'form-control';

		}

		return $properties;
	}

	add_filter( 'wpforms_field_properties_select', 'doh_wpforms_field_properties_select', 10, 3 );
	function doh_wpforms_field_properties_select( $properties, $field, $form_data ) {

		if ( ! isset($properties['input_container']['class']) )
		return $properties;

		$properties['input_container']['class'][] = 'form-control';

		return $properties;
	}

	add_filter( 'wpforms_field_properties_honeypot', 'doh_wpforms_field_properties_honeypot', 10, 3 );
	function doh_wpforms_field_properties_honeypot( $properties, $field, $form_data ) {
		$properties['input_container']['class'][] = 'form-control';

		return $properties;
	}

	add_filter( 'wpforms_frontend_form_data', 'doh_wpforms_button_classes' );
	function doh_wpforms_button_classes( $form_data ) {
		$form_data['settings']['submit_class'] .= ' btn btn-primary';
		return $form_data;
	}

}



/*
 * Yoast SEO
 */
if ( defined('WPSEO_VERSION') ) {

	// Move Yoast metabox to bottom
	add_filter( 'wpseo_metabox_prio', 'doh_wpseo_metabox_priority');
	function doh_wpseo_metabox_priority() {
		return 'low';
	}

}



/*
 * Archived Post Status
 */
if ( function_exists('aps_register_archive_post_status') ) {

	// Hide archived posts from the All Posts list in the Admin dashboard.
	add_filter( 'aps_status_arg_public', '__return_false' );
	add_filter( 'aps_status_arg_private', '__return_false' );
	add_filter( 'aps_status_arg_show_in_admin_all_list', '__return_false' );

}