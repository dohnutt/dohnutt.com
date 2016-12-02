<?php
get_header(); ?>

    <main class="wrap" id="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xs-12">
            <div class="entries">
              <?php
              if ( have_posts() ) :
                while ( have_posts() ) :
              		the_post(); ?>
                  <div <?php post_class('row entry'); ?>>
                    <div class="col-md-8 entry-image">
                      <?php
                      if ( has_post_thumbnail() ) :
                        echo '<a href="'.get_the_permalink().'">';
                        the_post_thumbnail('large', array(
                          'class' => 'img-fluid',
                        ));
                        echo '</a>';
                      else: ?>
                      <a href="<?php the_permalink(); ?>" class="img-placeholder"></a>
                      <?php
                      endif; ?>
                    </div>
                    <div class="col-md-4 entry-details">
                      <a href="<?php the_permalink(); ?>">
                        <h3 class="entry-title"><?php the_title(); ?></h3>
                      </a>
                      <?php
                      if ( 'post' == get_post_type() ) : ?>
                        <ul class="entry-meta">
                          <li class="entry-date"><?php echo get_the_date(); ?></li>
                          <?php
                          if ( ! get_the_author_meta('user_login') == 'cavera' ) : ?>
                            <li class="entry-author">Author: <?php the_author_posts_link(); ?></li>
                          <?php
                          endif;

                          $category_list = array();
                          if ( has_category() ) :
                            echo '<li class="entry-categories">Category: ';
                            foreach ( get_the_category() as $category) :
                              $category_list[] = '<a href="'. get_category_link( $category->term_id ) .'">' . $category->cat_name . '</a>';
                            endforeach;
                            echo implode(', ', $category_list);
                            echo '</li>';
                          endif;?>
                        </ul>
                      <?php
                      endif; ?>
                      <p class="entry-excerpt">
                        <?php echo get_the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="more-link">Keep reading <i class="fa fa-angle-right"></i></a>
                      </p>
                    </div>
                  </div>
                <?php
              	endwhile;
                ?>
                <div class="pagination-container">
                  <?php
                  echo paginate_links( array(
                    'prev_text' => 'Prev',
                    'next_text' => 'Next',
                    'type' => 'list',
                    'show_all' => true,
                  ) ); ?>
                </div>
                <?php
              else :
                echo '<div class="alert alert-warning">Oops! No posts were found.</div>';
              endif;
              wp_reset_postdata(); ?>
            </div>
          </div>

          <aside class="sidebar col-sm-3 col-md-2 col-md-offset-1">
            <?php get_sidebar(); ?>
          </aside>
        </div>

      </div>
    </main>

<?php
get_footer(); ?>
