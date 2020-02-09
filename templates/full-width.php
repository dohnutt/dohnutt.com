<?php
/*
 * Template Name: Full-Width
 */
get_header(); ?>

    <main class="<?php echo doh_main_class('pg-main'); ?>">

      <?php
      do_action('doh_main_open');

      if ( have_posts() ) :

        if ( doh_is_bb_enabled() ) :

          while ( have_posts() ) :
        		the_post();

            the_content();

        	endwhile;

        else :

          ?>
          <div class="container">
            <div class="row">
              <div class="entry__main col-12">
                <?php

                while ( have_posts() ) :
                  the_post();

                  do_action('doh_before_content');

                  ?>
                  <div class="entry__content">
                    <?php

                    the_content();

                    ?>
                  </div>
                  <?php

                  do_action('doh_after_content');

                endwhile;

                ?>
              </div>
            </div>
          </div>
          <?php

        endif;

      endif;

      do_action('doh_main_close'); ?>

    </main>

<?php
get_footer(); ?>
