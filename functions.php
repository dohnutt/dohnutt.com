<?php

require_once 'inc/admin.php';
require_once 'inc/nav-walker.php';



//add_action('add_shortcodes', 'remove_bootstrap_shortcodes');
function remove_bootstrap_shortcodes() {
  print_r($shortcodes);
  echo 'hey';
}



// Remove unnecessary menu items from the admin bar.
add_action('wp_before_admin_bar_render', 'dohnutt_admin_bar_render');
function dohnutt_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}

// Unregister unnecessary widgets.
add_action('widgets_init', 'dohnutt_unregister_widgets', 11);
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


// Remove unnecessary menu items from admin dashboard.
add_action('admin_menu', 'dohnutt_remove_menus');
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



// Hide archived posts from 'All Posts' screen.
add_filter( 'aps_status_arg_public', '__return_false' );
add_filter( 'aps_status_arg_private', '__return_false' );
add_filter( 'aps_status_arg_show_in_admin_all_list', '__return_false' );



// Add editor style
add_action('admin_init', 'dohnutt_editor_style');
function dohnutt_editor_style() {
  add_editor_style( get_template_directory_uri() . '/editor-style.css' );
}



// Add the_excerpt() functionality to Pages post type.
add_action('init', 'dohnutt_add_page_excerpt');
function dohnutt_add_page_excerpt() {
  add_post_type_support( 'page', 'excerpt' );
}



// Adds custom classes to the body class
add_filter( 'body_class', 'dohnutt_body_classes' );
function dohnutt_body_classes( $classes ) {
    if ( is_home() || is_search() )
        $classes[] = 'archive';

  return $classes;
}



// Filter oembeds so that they are responsive.
add_filter( 'embed_oembed_html', 'dohnutt_embed_oembed_html', 99, 4 );
function dohnutt_embed_oembed_html( $cache, $url, $attr, $post_ID ) {
  $classes[] = 'oembed';

  if ( false !== strpos( $url, 'vimeo.com' ) || false !== strpos( $url, 'youtube.com' )  )
    $classes[] = 'embed-responsive embed-responsive-16by9';

  if ( false !== strpos( $url, 'instagram.com' ) )
    $classes[] = 'embed-instagram';

  return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
}



function get_the_right_title($id = null) {
    if ( $id === null ) {
        $id = get_the_id();
    }

    if ( is_post_type_archive() ) {
        $id = get_page_by_path(get_post_type());
        $title = get_the_title($id) ? get_the_title($id) : 'Portfolio';
        $title = get_field('title_alt', $id) ? get_field('title_alt', $id) : $title;

    } elseif ( is_home() ) {
        $id = get_option('page_for_posts');
        $title = get_the_title($id) ? get_the_title($id) : 'Thoughts';
        $title = get_field('title_alt', $id) ? get_field('title_alt', $id) : $title;

    } elseif ( is_archive() ) {
        $title = get_the_archive_title('','');

    } elseif ( is_search() ) {
        $title = '<span class="pg-title__prefix">Search:</span> ' . get_search_query();

    } else {
        $title = get_the_title($id);
        $title = get_field('title_alt', $id) ? get_field('title_alt', $id) : $title;
    }

    return $title;
}



// Filter out other prefixes
add_filter( 'get_the_archive_title', 'cavera_trim_archive_title', 10, 2 );
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



// Modify excerpt length and remove the ellpisis.
add_filter('excerpt_length', 'dohnutt_excerpt_length');
function dohnutt_excerpt_length($length) {
  return 17;
}

add_filter('get_the_excerpt', 'dohnutt_trim_excerpt');
function dohnutt_trim_excerpt($text) {
	return str_replace(' [&hellip;]', '&hellip;', $text);
}



// Register scripts and styles.
if ( ! function_exists('dohnutt_theme_assets') ) {
    add_action('init', 'dohnutt_theme_assets');
    function dohnutt_theme_assets() {
        wp_register_script('jquery-js',       '//ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', '', '2.2.2', true);
        wp_register_script('theme-js',        get_template_directory_uri() . '/js/script.min.js', '', '1.0', true);

        wp_register_style('theme-css',        get_stylesheet_uri());
        wp_register_style('font-awesome',     '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_register_style('fonts',            '//fonts.googleapis.com/css?family=Oswald:300,400,700|Space+Mono:400,400i,700,700i');
    }
}



// Enqueue scripts and styles.
if ( ! function_exists('dohnutt_theme_enqueue') ) {
    add_action('wp_enqueue_scripts', 'dohnutt_theme_enqueue');
    function dohnutt_theme_enqueue() {
        wp_enqueue_style('theme-css');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('fonts');

        wp_enqueue_script('jquery-js');
        wp_enqueue_script('theme-js');
    }
}



// Add theme supports and nav menus.
if ( ! function_exists('dohnutt_theme_support') ) {
    add_action('after_setup_theme', 'dohnutt_theme_support');
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
}



add_filter( 'wpseo_opengraph_image_size', 'dohnutt_wpseo_image_size', 10, 1 );
function dohnutt_wpseo_image_size( $string ) {
    return 'opengraph';
}



add_filter( 'caldera_forms_phone_js_options', 'dohnutt_caldera_phone_locale');
function dohnutt_caldera_phone_locale( $options ) {
	$options['initialCountry'] = 'CA';
	return $options;
}



// Register sidebars.
if ( ! function_exists('dohnutt_sidebars') ) {
    add_action('widgets_init', 'dohnutt_sidebars');
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

}
