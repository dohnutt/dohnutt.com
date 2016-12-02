<?php
get_header(); ?>

    <main class="wrap" id="content">

      <div class="container-fluid ">
        <div class="row">
          <div class="col-sm-7">
            <?php
            if ( have_posts() ) :
              while ( have_posts() ) :
                the_post();
                the_content();
              endwhile;
            endif; ?>
          </div>
        </div>
      </div>

    </main>

    <section class="areas wrap">

      <div class="container-fluid">
        <div class="row">

          <a href="#" class="col-xs-6 col-md-4 area">
            Portfolio
          </a>
          <a href="#" class="col-xs-6 col-md-4 area">
            About
          </a>
          <a href="#" class="col-xs-6 col-md-4 area">
            Twitter
          </a>
          <a href="#" class="col-xs-6 col-md-4 area">
            Portfolio
          </a>
          <a href="#" class="col-xs-6 col-md-4 area">
            Portfolio
          </a>
          <a href="#" class="col-xs-6 col-md-4 area">
            Portfolio
          </a>

        </div>
      </div>

    </section>

<?php
get_footer(); ?>
