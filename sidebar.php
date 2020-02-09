<?php
/*
 * The sidebar containing the default widget area
 */

if ( ! is_active_sidebar( 'default-sidebar' ) )
	return;

dynamic_sidebar( 'default-sidebar' ); ?>
