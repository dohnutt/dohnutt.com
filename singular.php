<?php
get_header(); ?>

    <main class="wrap" id="content">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post(); ?>

          <article class="entry-container">

            <?php
            echo get_template_part('parts/hero');

            if ( has_post_thumbnail() ) :
              //echo '<figure class="entry-image">'; the_post_thumbnail( 'large', array('class'=>'img-fluid')); echo '</figure>';
            endif; ?>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </article>
        <?php
        endwhile;
      endif; ?>
    </main>

<?php
get_footer(); ?>
