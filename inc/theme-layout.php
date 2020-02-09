<?php
/*
 * Theme Layout
 * `inc/theme-layout.php`
 *
 * Set up default theme layouts.
 *
 */

if ( ! defined('ABSPATH') ) exit;


add_filter( 'get_custom_logo', 'doh_get_custom_logo' );
function doh_get_custom_logo() {

  $html = '';
  $custom_logo_id = get_theme_mod( 'custom_logo' );

  if ( $custom_logo_id ) {
    $custom_logo_attr = array(
      'class' => 'navbar-brand__logo custom-logo',
      'itemprop' => 'logo',
    );

    $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
    if ( empty( $image_alt ) ) {
        $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
    }

    $html = sprintf(
      '<a href="%1$s" class="navbar-brand custom-logo-link" rel="home" itemprop="url">%2$s</a>',
      esc_url( home_url('/') ),
      wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr)
    );
  } elseif ( is_customize_preview() ) {
    $html = sprintf(
      '<a href="%1$s" class="custom-logo-link" style="display:none;"><img class="custom-logo"/></a>',
      esc_url( home_url( '/' ) )
    );
  }

  return $html;
}


if ( ! function_exists('doh_header_brand') ) {
  function doh_header_brand() {

    $brand = '<a class="navbar-brand" href="' . esc_url( home_url('/') ) . '" rel="home">' . get_bloginfo('name', 'display') . '</a>';

    if ( function_exists('the_custom_logo') ) {
      if ( has_custom_logo() ) {
        $brand = get_custom_logo();
      }
    }

    echo $brand;

  }
}



// Default header layout. Can be overridden with Beaver Themer.
add_action('doh_header', 'doh_default_header');
function doh_default_header() {
  echo get_template_part('parts/navbar');
}


function doh_page_title() {

  if ( is_front_page() )
    return;

  if ( is_home() ) {
    $title = '<h1 class="pg-title">' . get_the_title( get_option('page_for_posts') ) . '</h1>';

  } elseif ( is_archive() ) {
    $title = '<h1 class="pg-title">' . get_the_archive_title() . '</h1>';

  } elseif ( is_search() ) {
    $title = '<h1 class="pg-title"><span class="title-prefix">' . __('Search:', 'doh')  . ' </span>' . get_search_query() . '</h1>';

  } else {
    $title = '<h1 class="pg-title">' . get_the_title() . '</h1>';

  }

  return apply_filters('doh_page_title', $title);

}


// Displays the featured image for single templates
function doh_featured_image() {

  if ( has_post_thumbnail() ) :

    ?>
    <figure class="entry__image">
      <?php

      the_post_thumbnail('large', array(
        'class' => 'img-fluid entry__image__img'
      ));

      if ( ! doh_is_content_empty( get_post(get_post_thumbnail_id())->post_excerpt ) ) :
        echo '<figcaption class="entry__image__caption wp-caption-text">';
        echo get_post( get_post_thumbnail_id() )->post_excerpt;
        echo '</figcaption>';
      endif;

      ?>
    </figure>
    <?php

  endif;

}


// Display breadcrumbs before the page title
//add_action('doh_before_title', 'doh_yoast_breadcrumbs');
function doh_yoast_breadcrumbs() {

  if ( function_exists('yoast_breadcrumb') )
    yoast_breadcrumb('<p class="breadcrumbs">','</p>');

}


add_action('doh_main_open', 'doh_default_hero');
function doh_default_hero() {
  echo get_template_part('parts/hero');
}


// Default footer layout. Can be overridden with Beaver Themer.
add_action('doh_footer', 'doh_default_footer');
function doh_default_footer() {
  echo get_template_part('parts/footer');
}



// Display the post's featured image
add_action('doh_before_content', 'doh_entry_image');
function doh_entry_image() {
  doh_featured_image();
}


// Display the post's meta info before the content
add_action('doh_before_content', 'doh_post_meta');
function doh_post_meta() {

  if ( 'post' !== get_post_type() )
    return;

  ?>
  <div class="entry__meta mb-3">
    <span class="entry__meta__item entry__date">
      <?php echo get_the_date(); ?>
    </span>
    <?php

    if ( 'eric' !== get_the_author_meta('user_login') ) : ?>
      <span class="entry__meta__item entry__author">Author: <?php the_author_posts_link(); ?></span>
      <?php
    endif;

    ?>
    <span class="entry__meta__item entry__categories">
      <?php echo get_the_category_list(', '); ?>
    </span>
  </div>
  <?php
}



// Display a widget area after the post content
add_action('doh_after_content', 'doh_entry_footer');
function doh_entry_footer() {

  ?>
  <div class="entry__footer">
    <?php

    if ( is_active_sidebar( 'after-post-widgets' ) )
      dynamic_sidebar( 'after-post-widgets' );

    ?>
  </div>
  <?php
}
