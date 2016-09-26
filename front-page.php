<?php
get_header(); ?>

    <main class="wrap">

      <div class="container">
        <div class="row">
          <div class="col-sm-7">

            <?php the_content(); ?>
          </div>
        </div>
      </div>

      <?php
      $args = array (
      	'post_type' => 'any',
        'posts_per_page' => 10
      );
      $query = new WP_Query( $args );

      if ( !$query->have_posts() ) : ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="heading">Recent Entries</h2>
            <p>This displays entries from posts, pages, or any other post types.</p>
            <ul class="list-posts">
              <?php
              while ( $query->have_posts() ) :
            		$query->the_post();

                echo '<li><a href="'. get_permalink() .'">'. get_the_title() .'</a></li>';
            	endwhile; ?>
            </ul>
          </div>
        </div>
      </div>
      <?php
      endif;
      wp_reset_postdata(); ?>

    </main>

<?php
get_footer(); ?>
