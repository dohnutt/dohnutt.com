<?php
/*
* Theme Setup
* `inc/theme-setup.php`
*
* Add and remove foundational functionality for the theme.
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Register scripts and styles.
if ( ! function_exists( 'doh_theme_assets' ) ) {
	add_action( 'init', 'doh_theme_assets' );
	function doh_theme_assets() {
		$ver = doh_is_dev() ? time() : DOH_THEME_VER;
		$fonts_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap';
		// edit font stack: https://fonts.google.com/share?selection.family=Inter:wght@600%7CSpace%20Mono:ital,wght@0,400;0,700;1,400;1,700

		// Include WPTT webfont loader
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

		/*
		 * CSS
		 */
		wp_register_style( 'doh-style',       get_theme_file_uri( '/app.min.css' ), array(), $ver );
		wp_register_style( 'doh-fonts',       wptt_get_webfont_url( $fonts_url ), array(), $ver );

		/*
		 * JavaScript
		 */
		wp_register_script( 'doh-head-script', '' );
		wp_register_script( 'doh-script',    get_theme_file_uri( 'js/app.min.js' ), array(), $ver, true );

	}
}


// Enqueue scripts and styles.
if ( ! function_exists( 'doh_theme_enqueue' ) ) {
	add_action( 'wp_enqueue_scripts', 'doh_theme_enqueue' );
	function doh_theme_enqueue() {
		wp_enqueue_style( 'doh-style' );
		wp_enqueue_style( 'doh-fonts' );

		wp_enqueue_script( 'doh-script' );
		wp_add_inline_script( 'jquery', '$ = jQuery.noConflict(false);' );
	}
}


// Add theme supports and nav menus.
if ( ! function_exists( 'doh_theme_support' ) ) {
	add_action( 'after_setup_theme', 'doh_theme_support' );
	function doh_theme_support() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'automatic-feed-links' );
		//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
		add_theme_support( 'yoast-seo-breadcrumbs' );

		//add_image_size( 'tiny', 100, 100, true );
		//add_image_size( 'gallery', 480, 480, true );
		//add_image_size( 'feature', 800, 600, true );
		add_image_size( 'medium-landscape', 600, 400, true );
		add_image_size( 'opengraph', 1200, 630, true );

		register_nav_menus( array(
			'primary' => __('Primary Menu', 'doh'),
			'footer' => __('Footer Menu', 'doh'),
		) );
		
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
if ( ! function_exists( 'doh_sidebars' ) ) {
	add_action( 'widgets_init', 'doh_sidebars' );
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

	}
}


// Add the_excerpt() functionality to Pages post type.
add_action( 'init', 'doh_add_page_excerpt' );
function doh_add_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}


// Add custom classes to the body element
add_filter( 'body_class', 'doh_body_classes' );
function doh_body_classes( $classes ) {
	if ( is_home() || is_search() ) {
		$classes[] = 'archive';
	}

	return $classes;
}

// Add custom attrs to the body element
add_filter( 'body_class', 'doh_body_attrs' );
function doh_body_attrs( $classes ) {
	$scheme = $_COOKIE['doh_scheme'] ?? 'pink-light';
	echo 'data-scheme="' . $scheme . '"'; // hack-ish as hell

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


// Filter out "Archives: " from get_the_archive_title() function.
add_filter( 'get_the_archive_title', 'doh_trim_archive_title' );
function doh_trim_archive_title( $title ) {
	return str_replace( 'Archives:', '', $title );
}


// Wrap other prefixes from get_the_archive_title() function
add_filter( 'get_the_archive_title', 'doh_trim_alt_archive_title' );
function doh_trim_alt_archive_title( $title ) {

	$title_words = explode(': ', $title);
	if ( count( $title_words ) > 1 ) {
		$title_words[0] = '<span class="title-prefix">' . $title_words[0] . '</span>';
		return implode( ' ', $title_words );

	} else {
		return $title;
	}

}


// Modify excerpt length
add_filter( 'excerpt_length', 'doh_excerpt_length' );
function doh_excerpt_length( $length ) {
	return 20;
}


// Remove the brackets around the excerpt's trailing ellipsis
add_filter( 'get_the_excerpt', 'doh_trim_excerpt' );
function doh_trim_excerpt( $text ) {
	return str_replace(' [&hellip;]', '&hellip;', $text);
}


// Filter the gallery shortcode so that, even if it links to the attachment page, it will link to the media file.
if ( ! function_exists( 'doh_gallery_default_type_set_link' ) ) {
	add_filter( 'media_view_settings', 'doh_gallery_default_type_set_link' );
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


// Change the feed cache lifetime
add_filter( 'wp_feed_cache_transient_lifetime' , 'doh_feed_cache_lifetime' );
function doh_feed_cache_lifetime( $lifetime ) {
	return 3600; // 1 hour
}