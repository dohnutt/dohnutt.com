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


/**
 * Prettify print_r() output
 */
if ( ! function_exists('pretty_print_r') ) {
    function pretty_print_r( $data, $echo = true ) {
        if ( $echo ) {
            echo '<pre style="font-size:12px;">';
            print_r($data);
            echo '</pre>';

        } else {
            ob_start();
            echo '<pre style="font-size:12px;">';
            print_r($data);
            echo '</pre>';

            return ob_get_clean();
        }
    }
}


/**
 * wp_die() + pretty_print_r()
 */
if ( ! function_exists('pp') ) {
	function pp( $data ) {
		return wp_die( pretty_print_r($data, false) );
	}
}


/**
 * wp_die() + var_dump()
 */
if ( ! function_exists('dd') ) {
    function dd( $data ) {
        ob_start();
        echo '<pre style="font-size:12px;">';
        var_dump($data);
        echo '</pre>';

        return wp_die( ob_get_clean() );
    }
}


/**
 * Check if the current site is a dev environment
 */
function doh_is_dev() {

	// Skip ahead if wp_get_environment_type() is set
	if ( function_exists('wp_get_environment_type') ) {
		if ( 'production' !== wp_get_environment_type() ) {
			return true;
		}
	}

	// Ensure HTTP_HOST is always set
	if ( defined('WP_CLI') && WP_CLI && !isset($_SERVER['HTTP_HOST'])) {
		$_SERVER['HTTP_HOST'] = '';
	}

	$env = array();
	$env[] = preg_match( '/.local/', $_SERVER['HTTP_HOST'] );
	$env[] = preg_match( '/.dev/', $_SERVER['HTTP_HOST'] );
	$env[] = preg_match( '/.test/', $_SERVER['HTTP_HOST'] );
	$env[] = preg_match( '/.dohnutt.com/', $_SERVER['HTTP_HOST'] );
	$env[] = preg_match( '/dev./', $_SERVER['HTTP_HOST'] );

	if ( in_array(1, $env) ) {
		return true;
	}

	return false;
}