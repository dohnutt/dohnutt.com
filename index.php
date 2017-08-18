<?php
get_header(); ?>

    <main class="wrap" id="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xs-12">
            <div class="entries">
              <?php
              if ( have_posts() ) :
                $i = 0;
                while ( have_posts() ) :
              		the_post();

                  $col_image_classes = '';
                  $col_content_classes = '';
                  if ( ($i % 2) !== 0 ) :
                    $col_image_classes = 'push-md-5';
                    $col_content_classes = 'pull-md-7';
                  endif; ?>
                  <article <?php post_class('row entry'); ?>>
                    <div class="col-md-7 <?php echo $col_image_classes; ?> entry-image">
                      <?php
                      if ( has_post_thumbnail() ) :
                        echo '<a href="' . get_the_permalink() . '">';
                        the_post_thumbnail('loop', array(
                          'class' => 'img-fluid',
                        ));
                        echo '</a>';
                      else: ?>
                        <a href="<?php the_permalink(); ?>" class="entry-image-placeholder"></a>
                      <?php
                      endif; ?>
                    </div>
                    <div class="col-md-5 <?php echo $col_content_classes; ?> entry-details">
                      <a href="<?php the_permalink(); ?>">
                        <h3 class="entry-title"><?php the_title(); ?></h3>
                      </a>
                      <?php
                      if ( 'post' == get_post_type() ) : ?>
                        <ul class="entry-meta">
                          <li class="entry-date"><?php echo get_the_date(); ?></li>
                          <li class="entry-author">Author: <?php the_author_posts_link(); ?></li>
                          <?php
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
                  </article>
                <?php
                $i++;
              	endwhile; ?>
                <div class="pagination-container">
                  <?php
                  the_posts_pagination(); ?>
                </div>
                <?php
              else :
                echo '<div class="alert alert-warning">Oops! No posts were found.</div>';
              endif;
              wp_reset_postdata(); ?>
            </div>
          </div>
        </div>

      </div>
    </main>

<?php
get_footer(); ?>
