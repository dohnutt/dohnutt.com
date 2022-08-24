<?php
get_header(); ?>

<main class="pg-main">

	<?php do_action('doh_main_open'); ?>

	<div class="container-fluid main__container">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

			<?php do_action('doh_before_content'); ?>

			<div class="entry__content">

				<?php the_content(); ?>

			</div>

			<?php do_action('doh_after_content'); ?>

		<?php endwhile; ?>

	</div>
	
	<?php do_action('doh_main_close'); ?>

</main>

<?php
get_footer();