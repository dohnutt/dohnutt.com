<footer class="pg-footer wrap">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-6">
        <?php
        $nav = wp_nav_menu(array(
          'theme_location' => 'footer',
          'depth' => 1,
          'menu_class' => 'list-inline mb-0',
          'echo' => false,
        ));
        $nav = str_replace('<li class="', '<li class="list-inline-item ', $nav);
        echo $nav;
        ?>
      </div>
      <div class="col-sm-6 text-sm-right">
        &copy; <?php echo date('Y'); ?> Eric Moss. <a href="https://madeinthesoo.ca/">Made with ❤ in the Soo</a>
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
