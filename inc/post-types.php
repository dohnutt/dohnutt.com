<?php
/*
 * Post types
 * `inc/post-types.php`
 *
 * Configure and initialize post types.
 *
 */

function doh_register_post_types() {

  /*
   * 'portfolio' post type
   */
  $args = [
    'label' => __( 'Projects', 'doh' ),
    'labels' => [
      'name' => __( 'Projects', 'doh' ),
      'singular_name' => __( 'Project', 'doh' ),
      'menu_name' => __( 'Projects', 'doh' ),
      'archives' => __( 'Projects', 'doh' ),
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

add_action( 'init', 'doh_register_post_types' );



function doh_register_taxonomies() {

  /*
   * 'collaborator' post type
   */
  $args = [
    'label' => __( 'Collaborators', 'doh' ),
    'labels' => [
      'name' => __( 'Collaborators', 'doh' ),
      'singular_name' => __( 'Collaborator', 'doh' ),
      'menu_name' => __( 'Collaborators', 'doh' ),
      'all_items' => __( 'All Collaborators', 'doh' ),
      'edit_item' => __( 'Edit Collaborator', 'doh' ),
      'view_item' => __( 'View Collaborator', 'doh' ),
      'update_item' => __( 'Update Collaborator name', 'doh' ),
      'add_new_item' => __( 'Add new Collaborator', 'doh' ),
      'new_item_name' => __( 'New Collaborator name', 'doh' ),
      'parent_item' => __( 'Parent Collaborator', 'doh' ),
      'parent_item_colon' => __( 'Parent Collaborator:', 'doh' ),
      'search_items' => __( 'Search Collaborators', 'doh' ),
      'popular_items' => __( 'Popular Collaborators', 'doh' ),
      'separate_items_with_commas' => __( 'Separate Collaborators with commas', 'doh' ),
      'add_or_remove_items' => __( 'Add or remove Collaborators', 'doh' ),
      'choose_from_most_used' => __( 'Choose from the most used Collaborators', 'doh' ),
      'not_found' => __( 'No Collaborators found', 'doh' ),
      'no_terms' => __( 'No Collaborators', 'doh' ),
      'items_list_navigation' => __( 'Collaborators list navigation', 'doh' ),
      'items_list' => __( 'Collaborators list', 'doh' ),
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
add_action( 'init', 'doh_register_taxonomies' );
