<footer class="pg-footer">
  <div class="container-fluid">

    <div class="row my-3">
      <div class="col-12 col-lg-4 mb-3 mb-lg-0">
        <?php
        wp_nav_menu( array(
          'theme_location' => 'footer',
          'depth' => 1,
          'container' => false,
          'menu_class' => 'menu--footer list-inline mb-0',

        ) );
        ?>
      </div>
      <div class="col-12 col-lg-6">
        <p class="small m-0">&copy; <?php echo date('Y'); ?> <a href="https://twitter.com/dohnutt">@dohnutt</a></p>
      </div>
    </div>

  </div>
</footer>
