<?php
/*
 * DohTheme Branding
 * `inc/branding.php`
 *
 * Add style to WordPress to be Doh-branded.
 *
 */

if ( ! defined('ABSPATH') ) {
	exit;
}


// Modify login screen to be Doh-branded.
if ( ! function_exists('dohtheme_login_styles') || ! function_exists('dohtheme_login_scripts') ) {

  add_action('login_enqueue_scripts', 'dohtheme_login_scripts');
  function dohtheme_login_scripts() {
    wp_enqueue_style( 'dohtheme-login-fonts', '//fonts.googleapis.com/css?family=Space+Mono&display=swap' );
    wp_enqueue_style( 'dohtheme-login-style', get_doh_assets_dir_uri() . '/css/login-style.css', array('login', 'dohtheme-login-fonts') );
  }

}


// Change "href" attribute on logo to link to Eric's website.
if ( ! function_exists('dohtheme_login_custom_link') ) {
  add_filter('login_headerurl', 'dohtheme_login_custom_link');
  function dohtheme_login_custom_link() {
    return 'https://ericmoss.ca';
  }
}


// Change "title" attribute on logo to be branded properly.
if ( ! function_exists('dohtheme_change_title_on_logo') ) {
  add_filter('login_headertext', 'dohtheme_change_title_on_logo');
  function dohtheme_change_title_on_logo() {
    return __('Eric Moss', 'dohtheme');
  }
}
