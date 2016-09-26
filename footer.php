<footer class="wrap">
  <div class="container">

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
        &copy; <?php echo date('Y'); ?> CaveraKit.
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
