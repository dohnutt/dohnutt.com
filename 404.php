<?php
get_header(); ?>

    <main class="<?php echo doh_main_class('pg-main'); ?>">

      <?php
      do_action('doh_main_open');

      ?>
      <div class="container-fluid main__container">

        <div class="row">

          <div class="entry__main col-12">
            <?php

            do_action('doh_before_content');

            ?>
            <div class="entry__content">
              <h1>Uh.</h1>
              <p>Nothin' to see here.<p>
            </div>
            <?php

            do_action('doh_after_content');

            ?>
          </div>

        </div>

      </div>
      <?php

      do_action('doh_main_close'); ?>

    </main>

<?php
get_footer(); ?>
