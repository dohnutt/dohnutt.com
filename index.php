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
                  <div <?php post_class('row entries__entry align-items-center'); ?>>

                    <div class="col-12 col-md-8 entry__details">

                      <h2 class="entry__title h3">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h2>

                      <div class="entry__excerpt">
                        <?php the_excerpt(); ?>
                      </div>
                      <?php

                      if ( 'post' == get_post_type() ) :

                        ?>
                        <div class="entry__meta">
                          <span class="entry__meta__item entry__date">
                            <?php echo get_the_date(); ?>
                          </span>
                          <?php

                          if ( 'eric' !== get_the_author_meta('user_login') ) : ?>
                            <span class="entry__meta__item entry__author">Author: <?php the_author_posts_link(); ?></span><?php
                          endif;

                          ?>
                          <span class="entry__meta__item entry__categories">
                            <?php echo get_the_category_list(', '); ?>
                          </span>
                        </div>
                        <?php

                      endif;

                      ?>
                    </div>

                    <div class="col-12 col-md-4 entry__image">
                      <?php

                      if ( has_post_thumbnail() ) :
                        echo '<a href="' . get_permalink() . '">';
                        the_post_thumbnail('medium', array('class' => 'entry__img img-fluid rounded'));
                        echo '</a>';
                      endif;

                      ?>
                    </div>

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
