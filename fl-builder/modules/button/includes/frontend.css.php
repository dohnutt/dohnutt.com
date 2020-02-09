<?php

// Alignment
FLBuilderCSS::responsive_rule( array(
	'settings'     => $settings,
	'setting_name' => 'align',
	'selector'     => ".fl-node-$id .fl-bs-button-wrap",
	'prop'         => 'text-align',
) );

// Padding
FLBuilderCSS::dimension_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'padding',
	'selector'     => ".fl-builder-content .fl-node-$id a.fl-bs-button",
	'unit'         => 'px',
	'props'        => array(
		'padding-top'    => 'padding_top',
		'padding-right'  => 'padding_right',
		'padding-bottom' => 'padding_bottom',
		'padding-left'   => 'padding_left',
	),
) );

// Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'typography',
	'selector'     => ".fl-builder-content .fl-node-$id a.fl-bs-button, .fl-builder-content .fl-node-$id a.fl-bs-button:visited",
) );

// Default background hover color
if ( ! empty( $settings->bg_color ) && empty( $settings->bg_hover_color ) ) {
	$settings->bg_hover_color = $settings->bg_color;
}

// Default background color for gradient styles.
if ( empty( $settings->bg_color ) && 'gradient' === $settings->style ) {
	$settings->bg_color = 'a3a3a3';
}

// Background Gradient
if ( ! empty( $settings->bg_color ) ) {
	$bg_grad_start = FLBuilderColor::adjust_brightness( $settings->bg_color, 30, 'lighten' );
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$bg_hover_grad_start = FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 30, 'lighten' );
}

// Border - Default
FLBuilderCSS::rule( array(
	'selector' => ".fl-builder-content .fl-node-$id a.fl-bs-button, .fl-builder-content .fl-node-$id a.fl-bs-button:visited",
	'enabled'  => ! empty( $settings->bg_color ),
	'props'    => array(
		'border' => '1px solid ' . FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_color, 12, 'darken' ) ),
	),
) );

// Border - Hover Default
FLBuilderCSS::rule( array(
	'selector' => ".fl-builder-content .fl-node-$id a.fl-bs-button:hover, .fl-builder-content .fl-node-$id a.fl-bs-button:focus",
	'enabled'  => ! empty( $settings->bg_hover_color ),
	'props'    => array(
		'border' => '1px solid ' . FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 12, 'darken' ) ),
	),
) );

// Border - Settings
FLBuilderCSS::border_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'border',
	'selector'     => ".fl-builder-content .fl-node-$id a.fl-bs-button, .fl-builder-content .fl-node-$id a.fl-bs-button:visited",
) );

// Border - Hover Settings
if ( ! empty( $settings->border_hover_color ) && is_array( $settings->border ) ) {
	$settings->border['color'] = $settings->border_hover_color;
}

FLBuilderCSS::border_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'border',
	'selector'     => ".fl-builder-content .fl-node-$id a.fl-bs-button:hover, .fl-builder-content .fl-node-$id a.fl-bs-button:focus",
) );

?>

<?php if ( 'custom' == $settings->width || ! empty( $settings->bg_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-bs-button,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-bs-button:hover,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-bs-button:visited {

	<?php if ( 'custom' == $settings->width ) : ?>
	width: <?php echo $settings->custom_width . $settings->custom_width_unit; ?>;
	<?php endif; ?>

}
<?php endif; ?>

<?php if ( empty( $settings->text ) ) : ?>
	<?php if ( 'after' == $settings->icon_position ) : ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .fl-bs-button i.fl-bs-button-icon-after {
		margin-left: 0;
	}
	<?php endif; ?>
	<?php if ( 'before' == $settings->icon_position ) : ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .fl-bs-button i.fl-bs-button-icon-before {
		margin-right: 0;
	}
	<?php endif; ?>
<?php endif; ?>

<?php

// Click action - lightbox
if ( isset( $settings->click_action ) && 'lightbox' == $settings->click_action ) :
	if ( 'html' == $settings->lightbox_content_type ) :
		?>
	.fl-node-<?php echo $id; ?>.fl-bs-button-lightbox-content {
		background: #fff none repeat scroll 0 0;
		margin: 20px auto;
		max-width: 600px;
		padding: 20px;
		position: relative;
		width: auto;
	}
	.fl-node-<?php echo $id; ?>.fl-bs-button-lightbox-content .mfp-close,
	.fl-node-<?php echo $id; ?>.fl-bs-button-lightbox-content .mfp-close:hover {
		top: -10px;
		right: -10px;
	}
	<?php endif; ?>

	<?php if ( 'video' == $settings->lightbox_content_type ) : ?>
	.fl-bs-button-lightbox-wrap .mfp-content {
		background: #fff;
	}
	.fl-bs-button-lightbox-wrap .mfp-iframe-scaler iframe {
		left: 2%;
		height: 94%;
		top: 3%;
		width: 96%;
	}
	.mfp-wrap.fl-bs-button-lightbox-wrap .mfp-close,
	.mfp-wrap.fl-bs-button-lightbox-wrap .mfp-close:hover {
		color: #333;
		right: -4px;
		top: -10px;
	}
	<?php endif; ?>

<?php endif; ?>
