<?php
/*
 * Plugin Extensions & Overrides
 * `inc/plugin-functions.php`
 *
 * Override functionality for consistently-used plugins.
 *
 */

if ( ! defined('ABSPATH') ) exit;


/*
 * Advanced Custom Fields
 */
if ( class_exists('acf') ) {

  // Add a theme options page provided by ACF.
  /*if( function_exists('acf_add_options_page') ) {
  	acf_add_options_page(array(
  		'page_title' 	=> 'Theme Options',
  		'menu_title'	=> 'Theme Options',
  		'menu_slug' 	=> 'theme-options',
  		'capability'	=> 'edit_others_posts',
  		'redirect'		=> false,
      'parent_slug' => 'themes.php'
  	));
  }*/

  // Add some custom CSS to ACF metaboxes.
  add_action('acf/input/admin_head', 'doh_acf_admin_head');
  function doh_acf_admin_head() {
  	?>
  	<style type="text/css">
      .acf-fields > .acf-field-hide {
        display: none;
      }
      @media (min-width: 600px) {
        .acf-fields > .acf-field-code textarea {
          background-color: #2b2b2b;
          color: #fff;
          font-family: Consolas,Monaco,monospace;
          font-size: 16px;
        }
      }
  	</style>
  	<?php
  }

  // Enqueue google maps for ACF
  if ( ! function_exists('doh_acf_gmap_key') ) {
    add_action('acf/init', 'doh_acf_gmap_key');
    function doh_acf_gmap_key() {
      // Default key for development sites
      $key = 'AIzaSyCcgMOxdxTd8VfIJ_74KWc0eEta6fV8m_s';
    	acf_update_setting(
        'google_api_key',
        apply_filters('doh_google_api_key', $key)
      );
    }
  }

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

  // Tell Yoast to use the "opengraph" image size.
  add_filter( 'wpseo_opengraph_image_size', 'doh_wpseo_image_size', 10, 1 );
  function doh_wpseo_image_size( $string ) {
    return 'opengraph';
  }

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



/*
 * WP Featherlight
 */
if ( function_exists('wp_featherlight') ) {

  // Dequeue WP Featherlight's CSS includes.
  add_filter('wp_featherlight_load_css', '__return_false');

}


/*
 * Beaver Themer
 */
if ( class_exists('FLThemeBuilderLayoutData') ) {

  // Add theme support for Beaver Themer
  add_action( 'after_setup_theme', 'doh_footer_support' );
  function doh_footer_support() {
    add_theme_support( 'fl-theme-builder-headers' );
    add_theme_support( 'fl-theme-builder-footers' );
    add_theme_support( 'fl-theme-builder-parts' );
  }

  // Render Footer themer layout
  add_action( 'wp', 'doh_header_footer_render' );
  function doh_header_footer_render() {

    if ( ! empty( FLThemeBuilderLayoutData::get_current_page_header_ids() ) ) {
      remove_action( 'doh_header', 'doh_do_header' );
      add_action( 'doh_header', 'FLThemeBuilderLayoutRenderer::render_header' );
    }

    if ( ! empty( FLThemeBuilderLayoutData::get_current_page_footer_ids() ) ) {
      remove_action( 'doh_footer', 'doh_do_footer' );
      add_action( 'doh_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
    }

  }

  // Declare Themer part locations
  add_filter( 'fl_theme_builder_part_hooks', 'doh_register_part_hooks' );
  function doh_register_part_hooks() {
    return array(
      array(
        'label' => 'Header',
        'hooks' => array(
          'doh_body_open' => 'Body Open',
          'doh_before_header' => 'Before Header',
          'doh_before_nav'    => 'Before Nav Bar',
          'doh_after_nav'     => 'After Nav Bar',
          'doh_after_header'  => 'After Header',
        ),
      ),
      array(
        'label' => 'Hero',
        'hooks' => array(
          'doh_before_hero' => 'Before Hero',
          'doh_before_title' => 'Before Page Title',
          'doh_after_title' => 'After Page Title',
          'doh_after_hero' => 'After Hero',
        ),
      ),
      array(
        'label' => 'Content',
        'hooks' => array(
          'doh_main_open'     => 'Main Open',
          'doh_before_content' => 'Before Content',
          'doh_after_content' => 'After Content',
          'doh_main_close'    => 'Main Close',
        ),
      ),
      array(
        'label' => 'Archive',
        'hooks' => array(
          'doh_before_loop' => 'Before Posts',
          'doh_after_loop' => 'After Posts',
        ),
      ),
      array(
        'label' => 'Footer',
        'hooks' => array(
          'doh_before_footer' => 'Before Footer',
          'doh_after_footer'  => 'After Footer',
          'doh_body_close'    => 'Body Close',
        ),
      )
    );
  }

}
