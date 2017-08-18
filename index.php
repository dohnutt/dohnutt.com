<?php
get_header(); ?>

    <main class="wrap" id="content">

      <?php
      $args = array(
        'post_type' => 'page',
        'name' => 'portfolio',
      );
      $q = new WP_Query($args);
      if ( $q->have_posts() ) :
        while ( $q->have_posts() ) :
          $q->the_post(); ?>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        <?php
        endwhile;
        wp_reset_postdata();
      endif; ?>

      <div class="entries">
        <?php
        if ( have_posts() ) :
          $i = 0;
          while ( have_posts() ) :
        		the_post(); ?>
            <article <?php post_class('entry'); ?>>
              <div class="card">
                <div class="card-image">
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
<<<<<<< HEAD
                </div>
                <div class="card-body">
                  <a href="<?php the_permalink(); ?>">
                    <h3 class="entry-title"><?php the_title(); ?></h3>
                  </a>
                  <p class="entry-excerpt">
                    <?php echo get_the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="more-link">Keep reading <i class="fa fa-angle-right"></i></a>
                  </p>
                  <?php
                  if ( 'post' !== get_post_type() ) : ?>
                    <small class="entry-meta">
                      <span class="entry-date"><?php echo get_the_date(); ?></span>
                      <span class="entry-author"><?php the_author_posts_link(); ?></span>
=======
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
>>>>>>> origin/master
                      <?php
                      $category_list = array();
                      if ( has_category() ) :
                        echo '<span class="entry-categories">Category: ';
                        foreach ( get_the_category() as $category) :
                          $category_list[] = '<a href="'. get_category_link( $category->term_id ) .'">' . $category->cat_name . '</a>';
                        endforeach;
                        echo implode(', ', $category_list);
                        echo '</span>';
                      endif; ?>
                    </small>
                  <?php
                  endif; ?>
                </div>
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

    </main>

<?php
get_footer(); ?>
