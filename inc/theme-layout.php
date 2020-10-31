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



// Default header layout.
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
        'class' => 'img-fluid entry__image__img rounded'
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


// Display 'Year' for projects
add_action('doh_after_title', 'doh_project_meta');
function doh_project_meta() {
  if ( ! is_singular('portfolio') )
    return;

  global $post;

  ?>
  <div class="entry__preheader">
    <?php

    if ( isset($post->post_excerpt) && ! empty($post->post_excerpt) ) :
      echo '<p class="entry__lead lead">' . $post->post_excerpt . '</p>';
    endif;

    ?>
    <div class="entry__meta">
      <span class="meta__item"><a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="text-muted">&larr; All projects</a></span><?php
      if ( $year = get_field('year') ) : ?>
        <span class="meta__item"><?php echo $year; ?></span><?php
      endif; ?>
    </div>
  </div>
  <?php
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


// Default footer layout.
add_action('doh_footer', 'doh_default_footer');
function doh_default_footer() {
  echo get_template_part('parts/footer');
}


// Default footer layout.
add_action('doh_main_close', 'doh_footer_cta', 15);
function doh_footer_cta() {

  if ( is_page(array('contact','jesus')) || is_404() )
    return;

  ?>
  <a href="/contact" class="footer__cta align-items-center">
    <div class="col-12">
      <span class="d-block d-md-inline-block h5 mb-0">Want to work together?</span>
      <span class="cta__btn btn btn-primary py-3 mt-3 mt-md-n1">Let's talk</span>
    </div>
  </a>
  <?php
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
    <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished" class="meta__item entry__date">
      <?php echo get_the_date(); ?>
    </time>
    <span class="meta__item entry__author"><?php the_author_posts_link(); ?></span>
    <span class="meta__item entry__categories">
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



// Displays recent/pinned projects on the homepage
add_action('doh_main_close', 'doh_homepage_projects');
function doh_homepage_projects() {

  if ( ! is_front_page() )
    return;

  $q = new WP_Query([
    'post_type' => 'portfolio',
    'status' => 'publish',
    'posts_per_page' => 3,
  ]);

  if ( ! $q->have_posts() )
    return;

  ?>
  <div class="container mb-5">
    <hr />
    <div class="d-flex mb-4 align-items-center">
      <h2><em>Work</em></h2>
      <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="ml-auto px-3 text-muted">All projects &rarr;</a>
    </div>
    <div class="row entries">
      <?php
      while ( $q->have_posts() ) :
        $q->the_post();

        ?>
        <div <?php post_class('col-12 col-lg-4 mb-5 d-flex'); ?>>

          <a href="<?php the_permalink(); ?>" class="card d-flex flex-column w-100">
            <div class="card-img px-3 pt-3 pb-2">
              <?php

              if (has_post_thumbnail()) :
                the_post_thumbnail('medium-landscape', array('class' => 'entry__img img-fluid rounded'));
              endif;

              ?>
            </div>

            <div class="px-4 pb-5 pt-3 entry__details">
              <h3 class="entry__title font-size-inherit mb-0">
                <?php the_title(); ?>
              </h3>
            </div>
          </a>

        </div>
        <?php

      endwhile;
      ?>
    </div>
  </div>
  <?php

}
