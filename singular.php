<?php
get_header(); ?>

    <main class="wrap" id="content">
      <div class="container">

        <div class="row">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post(); ?>

              <div class="col-sm-12">
                <div class="entry-image">
                  <?php
                  if ( has_post_thumbnail() ) :
                    the_post_thumbnail( 'featured', array('class'=>'img-responsive'));
                  endif; ?>
                </div>
                <div class="entry-content">
                  <?php the_content(); ?>
                </div>
              </div>
            <?php
            endwhile;
          endif; ?>
          <aside class="sidebar col-sm-3 col-md-2 col-md-offset-1">
            <?php get_sidebar(); ?>
          </aside>
        </div>

      </div>
    </main>

<?php
get_footer(); ?>
