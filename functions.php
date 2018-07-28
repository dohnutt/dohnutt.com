<?php

require_once 'inc/admin.php';
require_once 'inc/nav-walker.php';

function remove_bootstrap_shortcodes() {
  print_r($shortcodes);
  echo 'hey';
}
//add_action('add_shortcodes', 'remove_bootstrap_shortcodes');

// Remove unnecessary menu items from the admin bar.
function cavera_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}

// Unregister unnecessary widgets.
function dohnutt_unregister_widgets() {
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  //unregister_widget('WP_Widget_Archives');
  //unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  //unregister_widget('WP_Widget_Search');
  //unregister_widget('WP_Widget_Text');
  //unregister_widget('WP_Widget_Categories');
  //unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  //unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'dohnutt_unregister_widgets', 11);

// Remove unnecessary menu items from admin dashboard.
function dohnutt_remove_menus() {
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
add_action('admin_menu', 'dohnutt_remove_menus');

// Change default page template title to 'Left Sidebar'
function dohnutt_default_template_title() {
  return __('Page with Sidebar (Default)', 'dohnutt');
}
add_filter('default_page_template_title', 'dohnutt_default_template_title');

// Hide archived posts from 'All Posts' screen.
add_filter( 'aps_status_arg_public', '__return_false' );
add_filter( 'aps_status_arg_private', '__return_false' );
add_filter( 'aps_status_arg_show_in_admin_all_list', '__return_false' );

// Add editor style
function dohnutt_editor_style() {
  add_editor_style ( get_template_directory_uri() . '/editor-style.css' );
}
add_action('admin_init', 'dohnutt_editor_style');

// Add the_excerpt() functionality to Pages post type.
function dohnutt_add_page_excerpt() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action('init', 'dohnutt_add_page_excerpt');

// Adds custom classes to the body class
function dohnutt_body_classes( $classes ) {
  if ( is_home() || is_search() ) :
    $classes[] = 'archive';
  endif;
  return $classes;
}
add_filter( 'body_class', 'dohnutt_body_classes' );

// Handy function to check if a page is a parent or a child.
function is_tree($post_id) {
	global $post;
	if ( is_page() && ($post->post_parent==$post_id || is_page($post_id) ) ) :
    return true;
	else :
    return false;
  endif;
}

// Filter oembeds so that they are responsive.
function dohnutt_embed_oembed_html( $cache, $url, $attr, $post_ID ) {
  $classes = array();
  $classes_all = array('oembed');

  if ( false !== strpos( $url, 'vimeo.com' ) || false !== strpos( $url, 'youtube.com' )  )
    $classes[] = 'embed-responsive embed-responsive-16by9';

  if ( false !== strpos( $url, 'instagram.com' ) )
    $classes[] = 'embed-instagram';


  $classes = array_merge( $classes, $classes_all );
  return '<figure class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</figure>';
}
add_filter( 'embed_oembed_html', 'dohnutt_embed_oembed_html', 99, 4 );


// Filter out other prefixes
function cavera_trim_archive_title($title, $id = null) {
  $title = str_replace('Archives:', '', $title);
  $title_words = explode(' ', $title);
  if (count($title_words) > 1) :
    $title_words[0] = '<span class="title-prefix">' . $title_words[0] . '</span>';
    return implode(' ', $title_words);
  else :
    return $title;
  endif;
}
add_filter( 'get_the_archive_title', 'cavera_trim_archive_title', 10, 2 );

// Modify excerpt length and remove the ellpisis.
function dohnutt_excerpt_length($length) {
  return 17;
}
add_filter('excerpt_length', 'dohnutt_excerpt_length');
function dohnutt_trim_excerpt($text) {
	return str_replace(' [&hellip;]', '...', $text);
}
add_filter('get_the_excerpt', 'dohnutt_trim_excerpt');

// Register scripts and styles.
if(!function_exists('dohnutt_theme_assets')) {
  function dohnutt_theme_assets() {
    wp_register_script('jquery-js',       '//ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', '', '2.2.2', true);
    wp_register_script('theme-js',        get_template_directory_uri() . '/js/script.min.js', '', '1.0', true);
    //wp_register_script('modernizr',     get_template_directory_uri() . '/js/modernizr.js');

    wp_register_style('theme-css',        get_stylesheet_uri());
    wp_register_style('font-awesome',     '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_register_style('fonts',            '//fonts.googleapis.com/css?family=Oswald:300,400,700|Space+Mono:400,400i,700,700i');
  }
  add_action('init', 'dohnutt_theme_assets');
}

// Enqueue scripts and styles.
if(!function_exists('dohnutt_theme_enqueue')) {
  function dohnutt_theme_enqueue() {
    wp_enqueue_style('theme-css');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('fonts');

    wp_enqueue_script('jquery-js');
    wp_enqueue_script('theme-js');
    //wp_enqueue_script('modernizr');
  }
  add_action('wp_enqueue_scripts', 'dohnutt_theme_enqueue');
}

// Add theme supports and nav menus.
if(!function_exists('dohnutt_theme_support')) {
  function dohnutt_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'quote', 'status', 'video' ) );

    add_image_size( 'loop', 960, 400, true );
    add_image_size( 'opengraph', 1200, 630, true );
    add_image_size( 'hero', 1920, 1440, false );

    register_nav_menus( array(
      'primary' => 'Primary Menu',
      'footer' => 'Footer Menu',
    ) );

  	add_filter( 'use_default_gallery_style', '__return_false' );
  }
  add_action('after_setup_theme', 'dohnutt_theme_support');
}

function dohnutt_wpseo_image_size( $string ) {
  return 'opengraph';
}
add_filter( 'wpseo_opengraph_image_size', 'dohnutt_wpseo_image_size', 10, 1 );

// Add some custom CSS to ACF metaboxes.
function dohnutt_acf_admin_head() {
	?>
	<style type="text/css">
    @media (min-width: 600px) {
  		.acf-fields > .acf-field-half {
        width: 50%;
        float: left;
        clear: none;
      }
      .acf-fields > .acf-field-third {
        width: 33.3333333333333332%;
        float: left;
        clear: none;
      }
    }
	</style>
	<?php
}
//add_action('acf/input/admin_head', 'dohnutt_acf_admin_head');

// Runs all ACF field values through wp_kses_post()
function dohnutt_kses_post( $value ) {
	if( is_array($value) ) {
		return array_map('dohnutt_kses_post', $value);
	}
	return wp_kses_post( $value );
}
add_filter('acf/update_value', 'dohnutt_kses_post', 10, 1);


add_filter( 'caldera_forms_phone_js_options', function($options) {
	//Use ISO_3166-1_alpha-2 formatted country code
	$options[ 'initialCountry' ] = 'CA';
	return $options;
});



// Register sidebars.
if(!function_exists('dohnutt_sidebars')) {
  function dohnutt_sidebars() {
    register_sidebar(array(
      'name' => __('Default Sidebar', 'dohnutt'),
      'id' => 'default-sidebar',
      'description' => __('Main sidebar area.', 'dohnutt'),
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
      'before_widget' => '<div class="widget %1$s %2$s">',
      'after_widget' => '</div>'
    ));
  }
  add_action('widgets_init', 'dohnutt_sidebars');
}
