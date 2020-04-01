<header class="pg-header wrap">

  <?php do_action('doh_before_nav'); ?>

  <nav class="pg-navbar navbar navbar-expand-lg">

    <a class="navbar-brand" href="<?php echo home_url(); ?>">
      <?php include get_doh_assets_dir() . '/img/logo.svg'; ?>
      <span class="sr-only">Eric Moss (@dohnutt)</span>
    </a>

    <button type="button" class="navbar-toggler collapsed ml-auto" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbar" class="collapse navbar-collapse">

      <div class="navbar__dropdown">
        <?php
        wp_nav_menu( array(
          'theme_location'      => 'primary',
          'depth'               => 2,
          'menu_class'          => 'navbar-nav navbar-nav--primary menu--primary',
          'container'           => false,
          'fallback_cb'         => 'Doh_Nav_Walker::fallback',
          'walker'              => new Doh_Nav_Walker(),
        ) );

        ?>
        <hr class="d-lg-none" />
        <div class="scheme ml-3 ml-lg-auto mr-lg-5 navbar-text align-items-center">
          <label for="scheme-toggle" role="status" class="scheme__status js-scheme-status">🌙</label>
          <div class="toggle scheme__toggle">
            <input class="toggle__input js-scheme-toggle" id="scheme-toggle" type="checkbox" value="dark" checked autocomplete="off">
            <label class="toggle__switch" for="scheme-toggle"></label>
          </div>
        </div>
      </div>

    </div>

  </nav>

  <?php do_action('doh_after_nav'); ?>

</header>
