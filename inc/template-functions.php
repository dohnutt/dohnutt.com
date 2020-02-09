<?php
/*
 * Template Functions
 * `inc/template-functions.php`
 *
 * Utility functions for use throughout the theme.
 *
 */

if ( ! defined('ABSPATH') ) exit;



/*
 * Theme-related directories & paths
 */

// Assets directory path
if ( ! function_exists('get_doh_assets_dir') ) {
  function get_doh_assets_dir() {
    return get_stylesheet_directory() . '/assets';
  }
}

// Assets directory URI
if ( ! function_exists('get_doh_assets_dir_uri') ) {
  function get_doh_assets_dir_uri() {
    return get_stylesheet_directory_uri() . '/assets';
  }
}

// Main theme stylesheet URI
if ( ! function_exists('get_doh_stylesheet_uri') ) {
  function get_doh_stylesheet_uri() {
    return get_stylesheet_directory_uri() . '/assets/css/app.min.css';
  }
}

// Main theme stylesheet path
if ( ! function_exists('get_doh_stylesheet_path') ) {
  function get_doh_stylesheet_path() {
    return get_stylesheet_directory() . '/assets/css/app.min.css';
  }
}



// Prettify `print_r` output
if ( ! function_exists('pretty_print_r') ) {
  function pretty_print_r( $data, $echo = true ) {
    $echo =  ( isset($echo) ) ? $echo : true;

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


// Prettify `var_dump` output
if ( ! function_exists('pretty_var_dump') ) {
  function pretty_var_dump( $data, $echo = true ) {
    $echo =  ( isset($echo) ) ? $echo : true;

    if ( $echo ) {
      echo '<pre style="font-size:12px;">';
      var_dump($data);
      echo '</pre>';

    } else {
      ob_start();
      echo '<pre style="font-size:12px;">';
      var_dump($data);
      echo '</pre>';

      return ob_get_clean();

    }
  }
}



// Check if the current site is a dev site
function doh_is_dev() {
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


// Check if Beaver Builder is active
function doh_is_bb_active() {
  if (
    is_plugin_active('beaver-builder-lite-version/fl-builder.php') ||
    is_plugin_active('bbs/fl-builder.php') ||
    is_plugin_active('beaver-builder/fl-builder.php') ||
    is_plugin_active('bb-plugin/fl-builder.php') ||
    class_exists('FLBuilder')
  ) {
    return true;
  }

  return false;
}


// Check if Beaver Builder is enabled on the current post
function doh_is_bb_enabled() {
  if ( class_exists('FLBuilderModel') && doh_is_bb_active() ) {
    if ( FLBuilderModel::is_builder_enabled() ) {
      return true;
    }
  }

  return false;
}


// Generate a string of classes to use on the `<main>` element
if ( ! function_exists('doh_main_class') ) {
  function doh_main_class( $class = '' ) {
    $class = isset($class) ? $class : '';
    $class .= ' ' . (doh_is_bb_enabled() ? 'main--builder' : 'main--default');

    return $class;
  }
}


// Gets the related page ID for archives.
function doh_get_the_ID() {
  if ( is_home() ) :
    return get_option('page_for_posts');
  else :
    return get_the_ID();
  endif;
}


// Gets page content no matter where you are. Currently used to check for shortcode in footer.php
function doh_get_the_content() {
  if ( is_singular() ) :
    $content = get_post_field( 'post_content', doh_get_the_ID() );
    if ( ! doh_is_content_empty($content) ) :
      return $content;
    else :
      return false;
    endif;
  else :
    return false;
  endif;
}


// Helper function to check if content is empty.
function doh_is_content_empty( $str ) {
  return trim( str_replace( '&nbsp;','',strip_tags($str) ) ) == '';
}


// Helper function to check if a page is a parent or a child.
function doh_is_tree($post_id) {
	global $post;
	if ( is_page() && ($post->post_parent==$post_id || is_page($post_id) ) )
    return true;

  return false;
}



/*
 * Shortcodes
 */


// Shortcode that displays the current year.
add_shortcode('copyright_year', 'doh_copyright_year_shortcode');
function doh_copyright_year_shortcode() {
  return date('Y');
}


// Shortcode that displays the search form.
add_shortcode('search_form', 'get_search_form');


// Shortcode that displays the website sitemap.
add_shortcode('sitemap', 'doh_sitemap_shortcode');
function doh_sitemap_shortcode($atts) {
  $output = '';
  $ignore_post_types = array('attachment', 'tribe-ea-record');
  $post_types = get_post_types(array('public' => 1), 'objects');

  foreach ( $post_types as $post_type ) {
    if ( ! in_array($post_type->name, $ignore_post_types) ) {
      if ( is_post_type_hierarchical($post_type->name) ) {
        $args = array(
          'post_type' => $post_type->name,
          'post_status' => 'publish',
          'echo' => false,
          'title_li' => '',
        );
        $output .= '<h2 class="sitemap__title">' . $post_type->labels->name.'</h2>';
        $output .= wp_list_pages($args);

      } else {
        $args = array(
          'post_type' => $post_type->name,
          'post_status' => 'publish',
          'echo' => false,
          'title_li' => '',
        );
        $posts = get_posts($args);
        if ( $posts ) {
          $output .= '<h2 class="sitemap__title">' . $post_type->labels->name.'</h2>';
          $output .=  '<ul class="sitemap__list">';
          foreach($posts as $post) {
            $output .=  '<li><a href="' . get_permalink($post->ID) . '">'.$post->post_title.'</a></li>';
          }
          $output .=  '</ul>';
        }

      }
    }
  }
  return $output;
}



if ( ! shortcode_exists('age') ) {
  add_shortcode('age', 'doh_age_shortcode');
  function doh_age_shortcode() {
    return date_diff(date_create('1992-07-13 ' . wp_timezone_string()), current_datetime())->y;


  }
}
