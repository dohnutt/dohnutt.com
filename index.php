<?php
get_header(); ?>

<main class="<?php echo doh_main_class('pg-main'); ?>">

	<?php do_action('doh_main_open'); ?>

	<div class="container main__container">

		<div class="entries my-5">

			<?php do_action('doh_before_loop'); ?>

			<?php
			if ( have_posts() ) : ?>
				
				<?php
				while ( have_posts() ) :
					the_post(); ?>

					<div <?php post_class('entries__entry align-items-center'); ?>>
						<a href="<?php the_permalink(); ?>" class="card row no-gutters">

							<div class="col-md-8 d-md-flex flex-md-column p-5 pr-md-3 justify-md-content-center">

								<h2 class="entry__title h3">
									<?php the_title(); ?>
								</h2>

								<div class="entry__excerpt">
									<?php the_excerpt(); ?>
								</div>
							</div>

							<div class="col-md-4 entry__image d-flex">
								<div class="d-flex align-items-center px-3 pt-md-3 pb-3">
									<?php
									if ( has_post_thumbnail() ) :
										the_post_thumbnail(
											'medium',
											array('class' => 'entry__img img-fluid rounded')
										);
									endif; ?>
								</div>
							</div>

						</a>
					</div>

				<?php
				endwhile; ?>

				<?php the_posts_pagination(); ?>

			<?php
			else : ?>

				<div class="empty text-muted">
					Uh, nothin' to see here.
				</div>

			<?php
			endif; ?>

			<?php wp_reset_postdata(); ?>

			<?php do_action('doh_before_loop'); ?>

		</div>
	</div>

	<?php do_action('doh_main_close'); ?>

</main>

<?php
get_footer(); ?>