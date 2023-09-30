<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package doh-theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The theme version.
 *
 * @since 1.0.0
 */
define( 'DOH_THEME_VER', wp_get_theme()->get( 'Version' ) );



/*
 * Initialize theme...
 */
if ( ! function_exists( 'doh_theme_init' ) ) {

	function doh_theme_init() {

		/*
         * Helper functions
         */
		require_once( 'inc/helper-functions.php' );

		/*
		 * Set up / modify theme defaults.
		 */
		require_once( 'inc/post-types.php' );
		require_once( 'inc/taxonomies.php' );
		require_once( 'inc/theme-setup.php' );
		require_once( 'inc/admin-functions.php' );

		/*
		 * Override and extend plugin functionality.
		 */
		require_once( 'inc/plugin-functions.php' );

		/*
		 * Useful template functions.
		 */
		require_once( 'inc/template-functions.php' );

		/*
         * Hide and remove unnecessary functionality
         */
		require_once( 'inc/cleanup.php' );

	}

	doh_theme_init();

}