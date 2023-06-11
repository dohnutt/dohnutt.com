<?php
/*
* Admin functions
* `inc/admin-functions.php`
*
* Enhancements and adjustments to the WP-Admin
*
*/

if ( ! defined('ABSPATH') ) {
    exit;
}


// Load fonts in editor
if ( ! function_exists('doh_add_editor_scripts') ) {
    add_action( 'enqueue_block_editor_assets', 'doh_add_editor_scripts' );
    function doh_add_editor_scripts() {
        $ver = doh_is_dev() ? time() : DOH_THEME_VER;

        wp_enqueue_style(
            'doh-editor',
            get_theme_file_uri('style-editor.css'),
            array(),
            $ver
        );

        wp_enqueue_style( 'doh-fonts' );

    }
}


/**
 * Override WP gallery so that,
 * even if it links to the attachment page, it will link to the media file.
 */
if ( ! function_exists('doh_gallery_default_type_set_link') ) {
    add_filter( 'media_view_settings', 'doh_gallery_default_type_set_link');
    function doh_gallery_default_type_set_link( $settings ) {
        $settings['galleryDefaults']['link'] = 'file';
        return $settings;
    }
}


/**
 * Allow SVG uploads
 */
if ( ! function_exists('doh_upload_mime_types') ) {
    add_filter( 'upload_mimes', 'doh_upload_mime_types' );
    function doh_upload_mime_types( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}


/**
 * Hide protected posts from public loop
 */
if ( ! function_exists('doh_hide_protected_posts') ) {
    add_filter( 'posts_where', 'doh_hide_protected_posts' );
    function doh_hide_protected_posts( $where ) {
        if ( !is_single() && !current_user_can('edit_private_posts') && !is_admin() ) {
            $where .= " AND post_password = ''";
        }

        return $where;
    }
}


/**
 * Disable fullscreen gutenberg
 */
if ( ! function_exists('doh_disable_editor_default_fullscreen') ) {
    add_action( 'enqueue_block_editor_assets', 'doh_disable_editor_default_fullscreen' );
    function doh_disable_editor_default_fullscreen() {
        if ( ! is_admin() ) {
            return;
        }

        $script = "window.onload = function() {
            const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' );
            if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); }
        }";

        wp_add_inline_script( 'wp-blocks', $script );
    }
}