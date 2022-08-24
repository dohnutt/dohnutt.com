<footer class="pg-footer">

	<?php do_action('doh_footer_open'); ?>

	<div class="container-fluid my-3">

		<p class="footer__copyright mb-3 mb-lg-0 d-inline-block">
			&copy; <?php echo date('Y'); ?> <a href="https://twitter.com/dohnutt">@dohnutt</a>
		</p>

		<?php
		wp_nav_menu( array(
			'theme_location' => 'footer',
			'depth' => 1,
			'container' => false,
			'menu_class' => 'footer__menu menu--footer list-inline mb-0 d-inline-block',
		) ); ?>

	</div>

	<?php do_action('doh_footer_close'); ?>

</footer>