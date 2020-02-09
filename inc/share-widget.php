<?php
if ( ! defined('ABSPATH') ) exit;

class Doh_Share_Widget extends WP_Widget {

  public function __construct() {

    parent::__construct(
      'share_widget',
      __('Share', 'doh'),
      array(
        'classname' => 'widget_share',
        'description' => __('Social media share buttons.', 'doh'),
      )
    );


  }

  public function widget($args, $instance) {

    echo $args['before_widget'];

    echo $args['before_title'];
    echo ( ! empty( $instance['title'] ) ) ? apply_filters( 'widget_title', $instance['title'] ) : __('Share this', 'doh');
    echo $args['after_title'];

    $items = array(
      array(
        'label' => __('Facebook', 'doh'),
        'slug' => 'facebook',
        'fa_icon' => 'fab fa-facebook',
        'sharer_url' => 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink(),
      ),
      array(
        'label' => __('Twitter', 'doh'),
        'slug' => 'twitter',
        'fa_icon' => 'fab fa-twitter',
        'sharer_url' => 'https://twitter.com/intent/tweet?url=' . get_permalink() . '&amp;text=' . get_the_title(),
      ),
      array(
        'label' => __('LinkedIn', 'doh'),
        'slug' => 'linkedin',
        'fa_icon' => 'fab fa-linkedin',
        'sharer_url' => 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_permalink() . '&amp;title=' . get_the_title(),
      ),
      array(
        'label' => __('Email', 'doh'),
        'slug' => 'email',
        'fa_icon' => 'fas fa-envelope',
        'sharer_url' => 'mailto:?subject=I wanted you to see this site&amp;body=Check out this site ' . get_permalink(),
      ),
    );

    $items = apply_filters('doh_share_widget_items', $items);

    if ( $items ) :

      ?>
      <ul class="list--share list-unstyled"><?php
      foreach ( $items as $item ) : ?>
        <li class="share__item share__item--<?php echo $item['slug']; ?>">
          <a href="<?php echo $item['sharer_url']; ?>" target="_blank" class="share__link">
            <i class="share__icon <?php echo $item['fa_icon']; ?> mr-2" aria-labelledby="<?php echo $item['slug']; ?>ShareLabel"></i><span class="share__label" id="<?php echo $item['slug']; ?>ShareLabel" class="share-label"><?php echo $item['label']; ?></span>
          </a>
        </li><?php
      endforeach; ?>
      </ul>
      <?php

    endif;

    echo $args['after_widget'];
  }

  public function form( $instance ) {
    ?>
    <p class="fl-field-control-wrapper">
    	<label for="<?php echo $this->get_field_name( 'title' ); ?>">Title:</label>
      <input class="widefat" id="<?php echo $this->get_field_name( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>">
    </p><?php
  }

  function update($new_instance, $old_instance) {
    $instance = array();
		$instance['title'] = ( !empty($new_instance['title']) ) ? sanitize_text_field( $new_instance['title'] ) : '';

    return $instance;
  }
}

// Register and load the widget
function Doh_Load_Share_Widget() {
    register_widget( 'Doh_Share_Widget' );
}
add_action( 'widgets_init', 'Doh_Load_Share_Widget' );
