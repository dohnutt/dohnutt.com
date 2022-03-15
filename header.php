<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js dark-mode">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <?php do_action('doh_body_open'); ?>

    <a href="#content" class="a11y-skip js-a11y-skip" tabindex="0">Skip to content (Press enter)</a>

    <?php

    do_action('doh_before_header');
    do_action('doh_header');
    do_action('doh_after_header');

    ?>
