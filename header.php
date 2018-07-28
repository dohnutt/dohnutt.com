<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php include_once('img/font-awesome.svg'); ?>

        <header class="pg-header wrap">
            <a href="#content" class="skip">Skip to content</a>

            <nav class="pg-navbar navbar navbar-default navbar-expand-md">
                <a class="navbar-brand" href="<?php echo site_url(); ?>/">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="EM Monogram" title="Eric Moss (@dohnutt)" class="logo">
                </a>
                <button class="navbar-toggler hidden-md-up collapsed" type="button" data-toggle="collapse" data-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    &#9776;
                </button>

                <div class="collapse navbar-collapse" id="primaryNav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'      => 'primary',
                        'depth'               => 1,
                        'menu_class'          => 'navbar-nav',
                        'container'           => false,
                        'fallback_cb'         => 'Dohnutt_Walker_Nav_Menu::fallback',
                        'walker'              => new Dohnutt_Walker_Nav_Menu(),
                    )); ?>
                </div>
            </nav>

        </header>
