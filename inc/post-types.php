<?php
/*
 * Post types
 * `inc/post-types.php`
 *
 * Configure and initialize post types.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'init', 'doh_register_post_types' );
function doh_register_post_types() {

	/*
	* 'portfolio' post type
	*/
	$args = [
		'label' => __( 'Projects', 'doh-theme' ),
		'labels' => [
			'name' => __( 'Work', 'doh-theme' ),
			'singular_name' => __( 'Project', 'doh-theme' ),
			'menu_name' => __( 'Work', 'doh-theme' ),
			'archives' => __( 'Work', 'doh-theme' ),
		],
		'description' => '',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => true,
		'rest_base' => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'delete_with_user' => false,
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => [ 'slug' => 'portfolio', 'with_front' => true ],
		'query_var' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => [ 'title', 'editor', 'thumbnail', 'excerpt', 'post-formats' ],
	];

	register_post_type( 'portfolio', $args );
}