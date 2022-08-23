<?php
/*
 * Cleanup
 * `inc/cleanup.php`
 *
 * Get rid of shit we don't need
 *
 */


 
/*
 * Disable emojis
 */

// Disable all emoji libraries from WordPress
add_action( 'init', 'doh_disable_emojis' );
function doh_disable_emojis() {
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

// Remove the emoji plugin from TinyMCE.
function doh_disable_emojis_tinymce($plugins) {
  if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
      return array();
  }
}

// Remove emoji CDN hostname from DNS prefetching hints
function doh_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        // This filter is documented in wp-includes/formatting.php
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}



/*
 * Disable widgets
 */

// Unregister unnecessary widgets.
add_action('widgets_init', 'doh_unregister_widgets', 11);
function doh_unregister_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    //unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
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



/*
 * Clean up WP-Admin
 */

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


// Hide WordPress update nag to all but admins
add_action('admin_head', 'doh_hide_update_nag_if_not_admin', 1);
function doh_hide_update_nag_if_not_admin() {
  if ( ! current_user_can('update_core') )
    remove_action( 'admin_notices', 'update_nag', 3 );
}
