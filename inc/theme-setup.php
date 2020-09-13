<?php
/*
 * Theme Setup
 * `inc/theme-setup.php`
 *
 * Add and remove foundational functionality for the theme.
 *
 */

if ( ! defined('ABSPATH') ) exit;


// Register scripts and styles.
if ( ! function_exists('doh_theme_assets' ) ) {

  add_action('init', 'doh_theme_assets');
  function doh_theme_assets() {
    /*
     * CSS
     */
    $ver = doh_is_dev() ? filemtime(get_doh_stylesheet_path()) : CLIENT_THEME_VER;
    $font = get_option('doh_random_font');
    wp_register_style( 'doh-style',       get_doh_stylesheet_uri(), array(), $ver );
    wp_register_style( 'doh-style-dark',  get_doh_assets_dir_uri() . '/css/dark.css', array('doh-style'), $ver );
    wp_register_style( 'doh-style-light', get_doh_assets_dir_uri() . '/css/light.css', array('doh-style'), $ver );
    wp_register_style( 'doh-fonts',       '//fonts.googleapis.com/css?display=swap&family=' . $font['title'] . ':' . $font['weights'], array(), time() );

    /*
     * JavaScript
     */
    $ver = doh_is_dev() ? filemtime(get_doh_assets_dir() . '/js/app.min.js') : CLIENT_THEME_VER;
    wp_register_script( 'doh-script',    get_doh_assets_dir_uri() . '/js/app.min.js', array('jquery'), $ver, true );
    wp_register_script( 'doh-font-awesome', '//kit.fontawesome.com/8ad0c03176.js', array(), null, true );

  }

}


// Get and store a random font value
if ( ! function_exists('doh_save_random_font' ) ) {

  add_action('after_setup_theme', 'doh_save_random_font');
  function doh_save_random_font() {
    $fonts = include( get_stylesheet_directory() . '/inc/google-fonts.php' );
    $key = array_rand($fonts);

    $enable = false;

    if ( $enable )
      update_option('doh_random_font', $fonts[$key]);
    else
      update_option('doh_random_font', $fonts['Space Mono']);
  }

}


add_action( 'wp_enqueue_scripts', 'doh_jquery_add_inline' );
function doh_jquery_add_inline() {
    wp_add_inline_script( 'jquery', '$ = jQuery.noConflict(false);' );
    wp_add_inline_style( 'doh-fonts', 'body { font-family: "' . get_option('doh_random_font')['title'] . '", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; }' );
}


if ( ! function_exists('doh_script_loader_tag') ) {

  add_filter( 'script_loader_tag', 'doh_script_loader_tag', 10, 2 );
  function doh_script_loader_tag( $html, $handle ) {
    if ( 'doh-font-awesome' === $handle ) {
      return str_replace( "8ad0c03176.js'", "8ad0c03176.js' crossorigin='anonymous'", $html );
    }
    return $html;
  }

}


// Enqueue scripts and styles.
if ( ! function_exists('doh_theme_enqueue') ) {

  add_action('wp_enqueue_scripts', 'doh_theme_enqueue');
  function doh_theme_enqueue() {
    wp_enqueue_style('doh-style');
    wp_enqueue_style('doh-style-light');
    wp_enqueue_style('doh-style-dark');
    wp_enqueue_script('doh-font-awesome');
    wp_enqueue_style('doh-fonts');
    wp_enqueue_script('doh-script');
  }

}



// Disable all emoji libraries from WordPress
add_action( 'init', 'doh_disable_emojis' );
function disable_emojis() {
  
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

  add_filter( 'tiny_mce_plugins', 'doh_disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'doh_disable_emojis_remove_dns_prefetch', 10, 2 );
}

// Filter funcion to remove the emoji plugin from TinyMCE.
function doh_disable_emojis_tinymce($plugins) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else return array();
}

// Removing emoji CDN hostname from DNS prefetching hints
function doh_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    // This filter is documented in wp-includes/formatting.php
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
  return $urls;
}



// Add theme supports and nav menus.
if ( !function_exists('doh_theme_support') ) {
  add_action('after_setup_theme', 'doh_theme_support');
  function doh_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
    add_theme_support( 'automatic-feed-links' );
    //add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
    add_theme_support( 'yoast-seo-breadcrumbs' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', array(
      'height' => 120,
      'width' => 400,
      'flex-height' => true,
      'flex-width' => false,
    ) );

    //add_image_size( 'tiny', 100, 100, true );
    //add_image_size( 'gallery', 480, 480, true );
    //add_image_size( 'feature', 800, 600, true );
    add_image_size( 'medium-landscape', 600, 400, true );
    add_image_size( 'opengraph', 1200, 630, true );

    register_nav_menus( array(
      'primary' => __('Primary Menu', 'doh'),
      'footer' => __('Footer Menu', 'doh'),
    ) );

  	//add_filter( 'use_default_gallery_style', '__return_false' );
  }
}

// Set up some defaults on theme switch
add_action( 'switch_theme', 'doh_enforce_image_size_options' );
function doh_enforce_image_size_options() {

  // Set image sizes to be larger than default
  update_option( 'thumbnail_size_w', 300 );
  update_option( 'thumbnail_size_h', 300 );
  update_option( 'thumbnail_crop', 1 );
  update_option( 'medium_size_w', 640 );
  update_option( 'medium_size_h', 640 );
  update_option( 'large_size_w', 1280 );
  update_option( 'large_size_h', 1280 );

  // Set default image link location to 'None'
  update_option('image_default_link_type', 'none');
}


// Register sidebars.
if ( ! function_exists('doh_sidebars') ) {
  add_action('widgets_init', 'doh_sidebars');
  function doh_sidebars() {

    register_sidebar(array(
      'name' => __('Default Sidebar', 'doh'),
      'id' => 'default-sidebar',
      'description' => __('Main sidebar area.', 'doh'),
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
      'before_widget' => '<div class="widget %1$s %2$s">',
      'after_widget' => '</div>'
    ));

    register_sidebar(array(
      'name' => __('After Post', 'doh'),
      'id' => 'after-post-widgets',
      'description' => __('Widget area displayed after the post content.', 'doh'),
      'before_title' => '<h5 class="widget-title">',
      'after_title' => '</h5>',
      'before_widget' => '<div class="widget entry__footer__widget %2$s" id="%1$s">',
      'after_widget' => '</div>'
    ));

  }
}


// Unregister unnecessary widgets.
add_action('widgets_init', 'doh_unregister_widgets', 11);
function doh_unregister_widgets() {
  //unregister_widget('WP_Widget_Pages');
  //unregister_widget('WP_Widget_Calendar');
  //unregister_widget('WP_Widget_Archives');
  //unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  //unregister_widget('WP_Widget_Search');
  //unregister_widget('WP_Widget_Text');
  //unregister_widget('WP_Widget_Categories');
  //unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  //unregister_widget('WP_Widget_Tag_Cloud');
  //unregister_widget('WP_Nav_Menu_Widget');
}


// Remove unnecessary menu items from admin dashboard.
add_action('admin_menu', 'doh_remove_menus');
function doh_remove_menus() {
  //remove_menu_page( 'index.php' );
  //remove_menu_page( 'edit.php' );
  //remove_menu_page( 'upload.php' );
  //remove_menu_page( 'edit.php?post_type=page' );
  remove_menu_page( 'edit-comments.php' );
  //remove_menu_page( 'themes.php' );
  //remove_menu_page( 'plugins.php' );
  //remove_menu_page( 'users.php' );
  //remove_menu_page( 'tools.php' );
  //remove_menu_page( 'options-general.php' );
}


// Remove unnecessary menu items from the admin bar.
add_action('wp_before_admin_bar_render', 'doh_admin_bar_render');
function doh_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}


// Change default page template title to 'Right Sidebar'
add_filter('default_page_template_title', 'doh_default_template_title');
function doh_default_template_title() {
  return __('Right Sidebar (Default)', 'doh');
}


// Hide WordPress update nag to all but admins
add_action('admin_head', 'doh_hide_update_nag_if_not_admin', 1);
function doh_hide_update_nag_if_not_admin() {
  if ( ! current_user_can('update_core') )
    remove_action( 'admin_notices', 'update_nag', 3 );
}


// Add the_excerpt() functionality to Pages post type.
add_action('init', 'doh_add_page_excerpt');
function doh_add_page_excerpt() {
  add_post_type_support( 'page', 'excerpt' );
}


// Adds custom classes to the body class
add_filter( 'body_class', 'doh_body_classes' );
function doh_body_classes( $classes ) {
  if ( is_home() || is_search() ) {
    $classes[] = 'archive';
  }

  return $classes;
}


add_filter( 'nav_menu_link_attributes', 'doh_nav_menu_link_atts', 10, 3 );
function doh_nav_menu_link_atts( $atts, $item, $args ) {

  if ( ! isset($atts['class']) )
    $atts['class'] = '';

  if ( $args->theme_location === 'footer' ) {

  } else {
    $atts['class'] .= ' menu-item-link';

  }

  return $atts;
}



add_filter( 'nav_menu_css_class', 'doh_nav_menu_class' , 10, 4 );
function doh_nav_menu_class( $classes, $item, $args ) {

  if ( 'footer' === $args->theme_location ) {
      $classes[] = 'list-inline-item';
  }

  return $classes;
}




// Change font size in tag cloud widget.
add_filter( 'widget_tag_cloud_args', 'doh_widget_tag_cloud_font_size');
function doh_widget_tag_cloud_font_size( array $args ) {
  $args['smallest'] = '0.8';
  $args['largest'] = '1.2';
  $args['unit'] = 'em';

  return $args;
}


// Filter oembeds so that they are responsive.
add_filter('oembed_dataparse', 'doh_embed_filter', 0, 3 );
function doh_embed_filter( $output, $data, $url ) {
	return '<div class="embed-responsive embed-responsive-16by9">' . $output . '</div>';
}


// Filter out "Archives: " from get_the_archive_title() function.
add_filter( 'get_the_archive_title', 'doh_trim_archive_title', 10, 2 );
function doh_trim_archive_title($title, $id = null) {
  return str_replace('Archives:', '', $title);
}


// Wrap other prefixes from get_the_archive_title() function
add_filter( 'get_the_archive_title', 'doh_trim_alt_archive_title', 10, 2 );
function doh_trim_alt_archive_title($title, $id = null) {

  $title_words = explode(': ', $title);
  if ( count($title_words) > 1 ) {
    $title_words[0] = '<span class="title-prefix">' . $title_words[0] . '</span>';
    return implode(' ', $title_words);

  } else {
    return $title;
  }

}


// Modify excerpt length
add_filter('excerpt_length', 'doh_excerpt_length');
function doh_excerpt_length($length) {
  return 20;
}


// Remove the brackets around the excerpt's trailing ellipsis
add_filter('get_the_excerpt', 'doh_trim_excerpt');
function doh_trim_excerpt($text) {
  return str_replace(' [&hellip;]', '&hellip;', $text);
}


// Filter the gallery shortcode so that, even if it links to the attachment page, it will link to the media file.
if ( ! function_exists('doh_gallery_default_type_set_link') ) {
  add_filter( 'media_view_settings', 'doh_gallery_default_type_set_link');
  function doh_gallery_default_type_set_link( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
  }
}


// Allow SVG uploads.
add_filter( 'upload_mimes', 'doh_upload_mime_types' );
function doh_upload_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}


// Always show Kitchen Sink in WYSIWYG Editor
add_filter( 'tiny_mce_before_init', 'doh_unhide_kitchensink' );
function doh_unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}


// Set brand colours. Also be sure to set in `src/scss/variables.scss`
function doh_get_colours( $include_hash = false ) {

  $hash = ( $include_hash ) ? '#' : '';

  $colours = array(

    // Default bootstrap variables
    'primary'   =>  $hash . '007bff', // #007bff
    'secondary' =>  $hash . '6c757d', // #6c757d

    // Add custom colours here
    // ...

    // Bootstrap state variables
    'success'   =>  $hash . '28a745', // #28a745
    'info'      =>  $hash . '17a2b8', // #17a2b8
    'warning'   =>  $hash . 'ffc107', // #ffc107
    'danger'    =>  $hash . 'dc3545', // #dc3545

  );

  return apply_filters( 'doh_brand_colours', $colours );
}
