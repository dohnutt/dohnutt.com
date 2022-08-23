<?php
get_header(); ?>

<main class="<?php echo doh_main_class('pg-main'); ?>">

	<?php do_action('doh_main_open'); ?>

	<div class="container-fluid main__container">

		<?php do_action('doh_before_content'); ?>

		<div class="entry__content">

			<h1><?php _e('Uh.', 'doh-theme'); ?></h1>
			<p><?php _e("Nothin' to see here.", "doh-theme"); ?><p>

		</div>

		<?php do_action('doh_after_content'); ?>

	</div>

	<?php do_action('doh_main_close'); ?>

</main>

<?php
get_footer();
