<?php

/**
 * @class FLButtonModule
 */
class FLButtonModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Button', 'fl-builder' ),
			'description'     => __( 'A simple call to action button.', 'fl-builder' ),
			'category'        => __( 'Basic', 'fl-builder' ),
			'partial_refresh' => true,
			'icon'            => 'button.svg',
		));
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 2.2
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		// Handle old responsive button align.
		if ( isset( $settings->mobile_align ) ) {
			$settings->align_responsive = $settings->mobile_align;
			unset( $settings->mobile_align );
		}

		// Handle old font size setting.
		if ( isset( $settings->font_size ) ) {
			$settings->typography                = array();
			$settings->typography['font_size']   = array(
				'length' => $settings->font_size,
				'unit'   => isset( $settings->font_size_unit ) ? $settings->font_size_unit : 'px',
			);
			$settings->typography['line_height'] = array(
				'length' => $settings->font_size,
				'unit'   => isset( $settings->font_size_unit ) ? $settings->font_size_unit : 'px',
			);
			unset( $settings->font_size );
			unset( $settings->font_size_unit );
		}

		// Handle old padding setting.
		if ( isset( $settings->padding ) && is_numeric( $settings->padding ) ) {
			$settings->padding_top    = $settings->padding;
			$settings->padding_bottom = $settings->padding;
			$settings->padding_left   = $settings->padding * 2;
			$settings->padding_right  = $settings->padding * 2;
			unset( $settings->padding );
		}

		// Handle old gradient style setting.
		if ( isset( $settings->three_d ) && $settings->three_d ) {
			$settings->style = 'gradient';
		}

		// Handle old border settings.
		if ( ! empty( $settings->bg_color ) && ( ! isset( $settings->border ) || empty( $settings->border ) ) ) {
			$settings->border = array();

			// Border style, color, and width
			if ( isset( $settings->border_size ) && isset( $settings->style ) && 'transparent' === $settings->style ) {
				$settings->border['style'] = 'solid';
				$settings->border['color'] = FLBuilderColor::adjust_brightness( $settings->bg_color, 12, 'darken' );
				$settings->border['width'] = array(
					'top'    => $settings->border_size,
					'right'  => $settings->border_size,
					'bottom' => $settings->border_size,
					'left'   => $settings->border_size,
				);
				unset( $settings->border_size );
				if ( ! empty( $settings->bg_hover_color ) ) {
					$settings->border_hover_color = FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 12, 'darken' );
				}
			}

			// Border radius
			if ( isset( $settings->border_radius ) ) {
				$settings->border['radius'] = array(
					'top_left'     => $settings->border_radius,
					'top_right'    => $settings->border_radius,
					'bottom_left'  => $settings->border_radius,
					'bottom_right' => $settings->border_radius,
				);
				unset( $settings->border_radius );
			}
		}

		// Handle old transparent background style.
		if ( isset( $settings->style ) && 'transparent' === $settings->style ) {
			$settings->style = 'flat';
			$helper->handle_opacity_inputs( $settings, 'bg_opacity', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_opacity', 'bg_hover_color' );
		}

		// Return the filtered settings.
		return $settings;
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		if ( $this->settings && 'lightbox' == $this->settings->click_action ) {
			$this->add_js( 'jquery-magnificpopup' );
			$this->add_css( 'font-awesome-5' );
			$this->add_css( 'jquery-magnificpopup' );
		}
	}

	/**
	 * @method update
	 */
	public function update( $settings ) {
		// Remove the old three_d setting.
		if ( isset( $settings->three_d ) ) {
			unset( $settings->three_d );
		}

		return $settings;
	}

	/**
	 * @method get_classname
	 */
	public function get_classname() {
		$classname = 'fl-bs-button-wrap';

		if ( ! empty( $this->settings->width ) ) {
			$classname .= ' fl-bs-button-width-' . $this->settings->width;
		}
		if ( ! empty( $this->settings->align ) ) {
			$classname .= ' fl-bs-button-' . $this->settings->align;
		}
		if ( ! empty( $this->settings->icon ) ) {
			$classname .= ' fl-bs-button-has-icon';
		}

		return $classname;
	}

  /**
   * @method get_bs_classname
   */
  public function get_bs_classname() {
    $classname = 'fl-bs-button';
    $classname .= ' btn';

    if ( ! empty( $this->settings->button_type ) ) {
      $classname .= ' btn-' . $this->settings->button_type;
    }

    if ( ! empty( $this->settings->width ) && 'full' === $this->settings->width ) {
      $classname .= ' btn-block';
    }

    return $classname;
  }

	/**
	 * Returns button link rel based on settings
	 * @since 1.10.9
	 */
	public function get_rel() {
		$rel = array();
		if ( '_blank' == $this->settings->link_target ) {
			$rel[] = 'noopener';
		}
		if ( isset( $this->settings->link_nofollow ) && 'yes' == $this->settings->link_nofollow ) {
			$rel[] = 'nofollow';
		}
		$rel = implode( ' ', $rel );
		if ( $rel ) {
			$rel = ' rel="' . $rel . '" ';
		}
		return $rel;
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLButtonModule', array(
	'general' => array(
		'title'    => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general'  => array(
				'title'  => '',
				'fields' => array(
					'text'           => array(
						'type'        => 'text',
						'label'       => __( 'Text', 'fl-builder' ),
						'default'     => __( 'Click Here', 'fl-builder' ),
						'preview'     => array(
							'type'     => 'text',
							'selector' => '.fl-bs-button-text',
						),
						'connections' => array( 'string' ),
					),
          'button_type'  => array(
						'type'    => 'select',
						'label'   => __( 'Type', 'fl-builder' ),
						'default' => 'primary',
						'options' => array(
							'primary' => __( 'Primary', 'fl-builder' ),
							'secondary'  => __( 'Secondary', 'fl-builder' ),
              'success'  => __( 'Success', 'fl-builder' ),
              'warning'  => __( 'Warning', 'fl-builder' ),
              'danger'  => __( 'Danger', 'fl-builder' ),
              'info'  => __( 'Info', 'fl-builder' ),
              'light' => __( 'Light', 'fl-builder' ),
              'dark' => __( 'Dark', 'fl-builder' ),
              'outline-primary' => __( 'Outline Primary', 'fl-builder' ),
							'outline-secondary'  => __( 'Outline Secondary', 'fl-builder' ),
              'outline-success'  => __( 'Outline Success', 'fl-builder' ),
              'outline-warning'  => __( 'Outline Warning', 'fl-builder' ),
              'outline-danger'  => __( 'Outline Danger', 'fl-builder' ),
              'outline-info'  => __( 'Outline Info', 'fl-builder' ),
              'outline-light'  => __( 'Outline Light', 'fl-builder' ),
              'outline-dark'  => __( 'Outline Dark', 'fl-builder' ),
              'link'  => __( 'Link', 'fl-builder' ),
						),
						'preview' => array(
							'type' => 'attribute',
              'attribute' => 'class',
              'selector' => 'a.btn',
						),
					),
					'icon'           => array(
						'type'        => 'icon',
						'label'       => __( 'Icon', 'fl-builder' ),
						'show_remove' => true,
						'show'        => array(
							'fields' => array( 'icon_position', 'icon_animation' ),
						),
						'preview'     => array(
							'type' => 'none',
						),
					),
					'icon_position'  => array(
						'type'    => 'select',
						'label'   => __( 'Icon Position', 'fl-builder' ),
						'default' => 'before',
						'options' => array(
							'before' => __( 'Before Text', 'fl-builder' ),
							'after'  => __( 'After Text', 'fl-builder' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'icon_animation' => array(
						'type'    => 'select',
						'label'   => __( 'Icon Visibility', 'fl-builder' ),
						'default' => 'disable',
						'options' => array(
							'disable' => __( 'Always Visible', 'fl-builder' ),
							'enable'  => __( 'Fade In On Hover', 'fl-builder' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'click_action'   => array(
						'type'    => 'select',
						'label'   => __( 'Click Action', 'fl-builder' ),
						'default' => 'link',
						'options' => array(
							'link'     => __( 'Link', 'fl-builder' ),
							'lightbox' => __( 'Lightbox', 'fl-builder' ),
						),
						'toggle'  => array(
							'link'     => array(
								'fields' => array( 'link' ),
							),
							'lightbox' => array(
								'sections' => array( 'lightbox' ),
							),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'link'           => array(
						'type'          => 'link',
						'label'         => __( 'Link', 'fl-builder' ),
						'placeholder'   => __( 'http://www.example.com', 'fl-builder' ),
						'show_target'   => true,
						'show_nofollow' => true,
						'preview'       => array(
							'type' => 'none',
						),
						'connections'   => array( 'url' ),
					),
				),
			),
			'lightbox' => array(
				'title'  => __( 'Lightbox Content', 'fl-builder' ),
				'fields' => array(
					'lightbox_content_type' => array(
						'type'    => 'select',
						'label'   => __( 'Content Type', 'fl-builder' ),
						'default' => 'html',
						'options' => array(
							'html'  => __( 'HTML', 'fl-builder' ),
							'video' => __( 'Video', 'fl-builder' ),
						),
						'preview' => array(
							'type' => 'none',
						),
						'toggle'  => array(
							'html'  => array(
								'fields' => array( 'lightbox_content_html' ),
							),
							'video' => array(
								'fields' => array( 'lightbox_video_link' ),
							),
						),
					),
					'lightbox_content_html' => array(
						'type'        => 'code',
						'editor'      => 'html',
						'label'       => '',
						'rows'        => '19',
						'preview'     => array(
							'type' => 'none',
						),
						'connections' => array( 'string' ),
					),
					'lightbox_video_link'   => array(
						'type'        => 'text',
						'label'       => __( 'Video Link', 'fl-builder' ),
						'placeholder' => 'https://vimeo.com/122546221',
						'preview'     => array(
							'type' => 'none',
						),
						'connections' => array( 'custom_field' ),
					),
				),
			),
		),
	),
	'style'   => array(
		'title'    => __( 'Style', 'fl-builder' ),
		'sections' => array(
			'style'  => array(
				'title'  => '',
				'fields' => array(
					'width'        => array(
						'type'    => 'select',
						'label'   => __( 'Width', 'fl-builder' ),
						'default' => 'auto',
						'options' => array(
							'auto'   => _x( 'Auto', 'Width.', 'fl-builder' ),
							'full'   => __( 'Full Width', 'fl-builder' ),
							'custom' => __( 'Custom', 'fl-builder' ),
						),
						'toggle'  => array(
							'auto'   => array(
								'fields' => array( 'align' ),
							),
							'full'   => array(),
							'custom' => array(
								'fields' => array( 'align', 'custom_width' ),
							),
						),
					),
					'custom_width' => array(
						'type'    => 'unit',
						'label'   => __( 'Custom Width', 'fl-builder' ),
						'default' => '200',
						'slider'  => array(
							'px' => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
						),
						'units'   => array(
							'px',
              'em',
							'vw',
							'%',
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => 'a.fl-bs-button',
							'property' => 'width',
						),
					),
					'align'        => array(
						'type'       => 'align',
						'label'      => __( 'Align', 'fl-builder' ),
						'default'    => 'left',
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.fl-bs-button-wrap',
							'property' => 'text-align',
						),
					),
				),
			),
		),
	),
));
