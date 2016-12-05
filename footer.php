<footer class="wrap">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-7">
        <?php
        wp_nav_menu( array(
          'theme_location' => 'footer',
          'depth' => 1,
          'menu_class' => 'nav nav-inline',
        ) );
        ?>
      </div>
      <div class="col-sm-5 text-sm-right">
        &copy; <?php echo date('Y'); ?> Eric Moss.
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
