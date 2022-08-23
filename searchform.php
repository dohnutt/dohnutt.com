<form role="search" method="get" id="searchForm" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<div class="form-group">
		<label for="s" class="searchform__label"><?php _ex( 'Search for:', 'doh' ); ?></label>
		<input type="text" value="<?php echo get_search_query(); ?>" placeholder="Search for..." name="s" id="s" class="searchform__field form-control" />
	</div>

	<button type="submit" id="searchSubmit" class="searchform__submit btn btn-secondary">
		<?php echo esc_attr_x( 'Search', 'doh' ); ?>
	</button>

</form>