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
			'name' => __( 'Projects', 'doh-theme' ),
			'singular_name' => __( 'Project', 'doh-theme' ),
			'menu_name' => __( 'Projects', 'doh-theme' ),
			'archives' => __( 'Projects', 'doh-theme' ),
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


add_action( 'init', 'doh_register_taxonomies' );
function doh_register_taxonomies() {

	/*
	* 'collaborator' post type
	*/
	$args = [
		'label' => __( 'Collaborators', 'doh-theme' ),
		'labels' => [
		'name' => __( 'Collaborators', 'doh-theme' ),
		'singular_name' => __( 'Collaborator', 'doh-theme' ),
		'menu_name' => __( 'Collaborators', 'doh-theme' ),
		'all_items' => __( 'All Collaborators', 'doh-theme' ),
		'edit_item' => __( 'Edit Collaborator', 'doh-theme' ),
		'view_item' => __( 'View Collaborator', 'doh-theme' ),
		'update_item' => __( 'Update Collaborator name', 'doh-theme' ),
		'add_new_item' => __( 'Add new Collaborator', 'doh-theme' ),
		'new_item_name' => __( 'New Collaborator name', 'doh-theme' ),
		'parent_item' => __( 'Parent Collaborator', 'doh-theme' ),
		'parent_item_colon' => __( 'Parent Collaborator:', 'doh-theme' ),
		'search_items' => __( 'Search Collaborators', 'doh-theme' ),
		'popular_items' => __( 'Popular Collaborators', 'doh-theme' ),
		'separate_items_with_commas' => __( 'Separate Collaborators with commas', 'doh-theme' ),
		'add_or_remove_items' => __( 'Add or remove Collaborators', 'doh-theme' ),
		'choose_from_most_used' => __( 'Choose from the most used Collaborators', 'doh-theme' ),
		'not_found' => __( 'No Collaborators found', 'doh-theme' ),
		'no_terms' => __( 'No Collaborators', 'doh-theme' ),
		'items_list_navigation' => __( 'Collaborators list navigation', 'doh-theme' ),
		'items_list' => __( 'Collaborators list', 'doh-theme' ),
		],
		'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => [ 'slug' => 'collaborator', 'with_front' => true, ],
		'show_admin_column' => true,
		'show_in_rest' => false,
		'rest_base' => 'collaborator',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit' => true,
		'meta_box_cb' => false,
	];
	register_taxonomy( 'collaborator', [ 'portfolio' ], $args );
}