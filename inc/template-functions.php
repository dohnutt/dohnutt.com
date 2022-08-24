<?php
/*
 * Template Functions
 * `inc/template-functions.php`
 *
 * Utility functions for use throughout the theme.
 *
 */

if ( ! defined('ABSPATH') ) {
	exit;
}



// Helper function to check if a string really is empty.
function doh_is_content_empty( $str ) {
	return trim( str_replace( '&nbsp;', '', strip_tags($str) ) ) == '';
}



/*
 * Shortcodes
 */


// Shortcode that displays the current year.
if ( ! shortcode_exists('copyright_year') ) {
	add_shortcode('copyright_year', 'doh_copyright_year_shortcode');
	function doh_copyright_year_shortcode() {
		return date_i18n('Y');
	}
}


if ( ! shortcode_exists('age') ) {
	add_shortcode('age', 'doh_age_shortcode');
	function doh_age_shortcode() {
		$start = '1992-07-13 ' . wp_timezone_string();
		return date_diff(date_create($start), current_datetime())->y;
	}
}
