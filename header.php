<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <header class="wrap">
      <a href="#content" class="sr-only sr-only-focusable">Skip to content</a>

      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">&#9776;</button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
              <img src="http://ericmoss.ca/wp-content/themes/ericmoss/img/logo.svg" alt="EM Monogram logo" title="Eric Moss" class="logo">
            </a>
          </div>
          <div class="collapse navbar-toggleable-sm pull-md-right" id="primaryNav">

            <?php
            wp_nav_menu( array(
              'menu'                => 2,
              'theme_location'      => 'primary',
              'depth'               => 2,
              'menu_class'          => 'nav navbar-nav',
              'container'           => '',
              'fallback_cb'         => 'Dohnutt_Walker_Nav_Menu::fallback',
              'walker'              => new Dohnutt_Walker_Nav_Menu(),
            ) ); ?>
          </div>
        </div>
      </nav>

      <div class="hero">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <?php
              if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p class="breadcrumbs">','</p>');
              }

              if ( is_front_page() ) :
                echo '<h1 class="entry-title" tabindex="0">Hello. I\'m Eric.</h1>';
              elseif ( is_archive() || is_home() ) :
                the_archive_title('<h1 class="entry-title" tabindex="0">','</h1>');
              elseif ( is_search() ) :
                echo '<h1 class="entry-title" tabindex="0"><em>Search:</em> ' . get_search_query() . '</h1>';
              else :
                the_title('<h1 class="entry-title" tabindex="0">','</h1>');
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>

    </header>
