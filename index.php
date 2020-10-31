<?php
get_header(); ?>

    <main class="<?php echo doh_main_class('pg-main'); ?>">

      <?php do_action('doh_main_open'); ?>

      <div class="container main__container">
        <div class="row">

          <div class="entry__main col-12">
            <div class="entries my-5">
              <?php

              do_action('doh_before_loop');

              if ( have_posts() ) :

                while ( have_posts() ) :
              		the_post();

                  ?>
                  <div <?php post_class('entries__entry align-items-center'); ?>>
                    <a href="<?php the_permalink(); ?>" class="card row">

                      <div class="col-12 col-md-8 entry__details p-5 pr-md-3 d-md-flex flex-md-column p-5 pr-md-3 justify-md-content-center">

                        <h2 class="entry__title h3">
                          <?php the_title(); ?>
                        </h2>

                        <div class="entry__excerpt">
                          <?php the_excerpt(); ?>
                        </div>
                        <?php

                        if ('post' == get_post_type()) :

                          ?>
                          <div class="entry__meta">
                            <span class="entry__meta__item entry__date">
                              <?php echo get_the_date(); ?>
                            </span>

                            <span class="entry__meta__item entry__categories">
                              <?php //echo get_the_category_list(', '); ?>
                            </span>
                          </div>
                          <?php

                        endif;

                        ?>
                      </div>

                      <div class="col-12 col-md-4 entry__image d-flex">
                        <div class="d-flex align-items-center py-3">
                          <?php

                          if (has_post_thumbnail()) :
                            the_post_thumbnail('medium', array('class' => 'entry__img img-fluid rounded'));
                          endif;

                          ?>
                        </div>
                      </div>

                    </a>
                  </div>
                  <?php

              	endwhile;
                the_posts_pagination();

              else :

                ?>
                <div class="empty text-muted">
                  Uh, nothin' to see here.
                </div>
                <?php

              endif;
              wp_reset_postdata();

              do_action('doh_before_loop');

              ?>
            </div>
          </div>

        </div>
      </div>

      <?php do_action('doh_main_close'); ?>

    </main>

<?php
get_footer(); ?>
