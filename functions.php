<?php
if ( ! defined('ABSPATH') ) exit;


define( 'DOH_THEME_VER', '1.0.0' );
define( 'CLIENT_THEME_VER', '1.2.1' );



/*
 * Initialize theme...
 */
if ( ! function_exists('doh_theme_init') ) {

  function doh_theme_init() {

    /*
     * Set up / modify theme defaults.
     */
    require_once('inc/post-types.php');
    require_once('inc/theme-setup.php');

    /*
     * Set up theme layouts
     */
    require_once('inc/theme-layout.php');
    require_once('inc/nav-walker.php');
    require_once('inc/share-widget.php');

    /*
     * Override and extend plugin functionality.
     */
    require_once('inc/plugin-functions.php');

    /*
     * Useful template functions.
     */
    require_once('inc/template-functions.php');

    /*
     * Add branding.
     */
    require_once('inc/branding.php');

  }
  doh_theme_init();

}


/*
 * Let other plugins know this theme is using Doh Theme.
 */
function doh_theme_is_active() {
  return true;
}
