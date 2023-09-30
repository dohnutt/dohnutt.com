<?php
/*
 * Template Functions
 * `inc/template-functions.php`
 *
 * Utility functions for use throughout the theme.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Shortcode that displays the current year.
if ( ! shortcode_exists( 'copyright_year' ) ) {

	add_shortcode( 'copyright_year', 'doh_copyright_year_shortcode' );
	function doh_copyright_year_shortcode() {
		return date_i18n( 'Y' );
	}

}


if ( ! shortcode_exists( 'age' ) ) {

	add_shortcode( 'age', 'doh_age_shortcode' );
	function doh_age_shortcode() {
		return date_diff(
			date_create( '1992-07-13 ' . wp_timezone_string() ),
			current_datetime()
		)->y;
	}

}
