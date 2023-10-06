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



/*
 * Yoast SEO
 */
if ( defined('WPSEO_VERSION') ) {

	// Move Yoast metabox to bottom
	add_filter( 'wpseo_metabox_prio', 'doh_wpseo_metabox_priority');
	function doh_wpseo_metabox_priority() {
		return 'low';
	}

	// Load custom opengraph
	add_action( 'wpseo_add_opengraph_images', 'doh_wpseo_add_images' );
	function doh_wpseo_add_images( $object ) {
		$schemes = array('pink-light', 'pink-dark', 'teal-light', 'teal-dark');
		$scheme = array_rand( $schemes );
		$image = get_theme_file_uri( 'img/opengraph-' . $schemes[$scheme] . '.png' );
		
		$object->add_image( $image );
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