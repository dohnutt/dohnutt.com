<?php
get_header(); ?>

    <main class="wrap" id="content">
      <div class="container-fluid">

        <div class="row">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post(); ?>

              <div class="col-sm-12">
                <div class="entry-image">
                  <?php
                  if ( has_post_thumbnail() ) :
                    //the_post_thumbnail( 'featured', array('class'=>'img-fluid'));
                  endif; ?>
                </div>
                <div class="entry-content">
                  <?php the_content(); ?>
                </div>
              </div>
            <?php
            endwhile;
          endif; ?>
        </div>

      </div>
    </main>

<?php
get_footer(); ?>
