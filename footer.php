<footer class="wrap">
  <div class="container-fluid">

    <div class="row">
      <div class="col-xs-12">
        <?php
        wp_nav_menu( array(
          'menu' => 2,
          'depth' => 1,
          'menu_class' => 'nav nav-inline',
        ) );
        ?>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        &copy; <?php echo date('Y'); ?> Eric Moss.
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
