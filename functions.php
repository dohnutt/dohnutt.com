<?php
require_once('dohnutt_nav_walker.php');

/*
 * Add an Eric-branded login screen.
 */
 function dohnutt_login_styles() {
   ?>
   <style type="text/css">
     .login #login h1 a {
       background-image: url('http://ericmoss.ca/wp-content/themes/ericmoss/img/logo.svg');
 			background-size: 100% 100%;
 			background-position: left top;
       width: 120px;
       height: 120px;
 			margin: 0 10px;
 			padding-bottom: 0;
       display: block;
     }
 		body.login {
       background-color: #3e3e3e;
       font-family: 'Helvetica', Arial, sans-serif;
     }
 		.login #backtoblog, .login #nav { margin: 8px 0;}
 		.login #nav a { font-style: italic; }
 		.login #backtoblog a { color:#ffffff; }
 		.login #nav a, .login #backtoblog a {
 			color: #bbb !important;
 			transition: color 0.5s ease;
 		}
 		.login #nav a:hover, .login #backtoblog a:hover,
 		.login #nav a:focus, .login #backtoblog a:focus { color:#00b39d !important; }
 		.login form {
 			box-shadow: 0px 0px 0px #000 !important;
 			background-color: transparent !important;
 			margin-top: 0 !important;
 		}
 		.login label { color: #bbb !important; }
     .login form .input, .login input[type=text] {
 			background: #222;
     	border-radius: 2px;
 			-webkit-border-radius: 2px;
 			-moz-border-radius: 2px;
 			transition: all 0.5s ease;
 			border: 0px;
 			min-height: 4rem;
 			padding: 1rem;
 			-webkit-appearance: none;
       -moz-appearance: none;
       appearance: none;
 			-webkit-box-shadow: 0 0 0 1000px white inset;
       -moz-box-shadow: 0 0 0 1000px white inset;
       box-shadow: 0 0 0 1000px white inset;
     }
 		input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill { -webkit-box-shadow: 0 0 0 1000px #222 inset; }
     input[type=checkbox]:checked:before { color: #00b39d !important; }

     input[type=text]:focus, input[type=search]:focus, input[type=radio]:focus, input[type=tel]:focus, input[type=time]:focus, input[type=url]:focus, input[type=week]:focus, input[type=password]:focus, input[type=checkbox]:focus, input[type=color]:focus, input[type=date]:focus, input[type=datetime]:focus, input[type=datetime-local]:focus, input[type=email]:focus, input[type=month]:focus, input[type=number]:focus, select:focus, textarea:focus {
       border-color: #00b39d !important;
     }
     .wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
         background: #00b39d !important;
         box-shadow: none;
     }
     .login form .forgetmenot {
       float: none !important;
     }
     #login form p.submit {
       margin-top: 16px !important;
     }
     .wp-core-ui .button-group.button-large .button, .wp-core-ui .button.button-large {
         background: #00b39d !important;
         border:0px;
 				font-size: 14px;
 				height: auto !important;
 				padding: 0.5em 1em 0.6em !important;
         box-shadow: none;
 				text-shadow: none;
 				color: #222 !important;
 				transition: color 0.5s ease, background 0.5s ease;
         display: block;
         float: none;
         width: 100%;
         clear: both;
     }
 		.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover,
 		.wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
 			background: #009a87 !important;
 			color: #fff !important;
 		}
   </style>
   <?php
 }

 function dohnutt_login_custom_link() {
 	return 'http://ericmoss.ca';
 }
 add_filter('login_headerurl','dohnutt_login_custom_link');

 function dohnutt_login_title_on_logo() {
 	return 'Website designed by Eric Moss';
 }
 add_filter('login_headertitle', 'dohnutt_login_title_on_logo');

function remove_bootstrap_shortcodes() {
  print_r($shortcodes);
  echo 'hey';
}
add_action('add_shortcodes', 'remove_bootstrap_shortcodes');

// Remove unnecessary menu items from the admin bar.
function cavera_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}

// Unregister unnecessary widgets.
function dohnutt_unregister_widgets() {
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  //unregister_widget('WP_Widget_Archives');
  //unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  //unregister_widget('WP_Widget_Search');
  //unregister_widget('WP_Widget_Text');
  //unregister_widget('WP_Widget_Categories');
  //unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  //unregister_widget('WP_Nav_Menu_Widget');
}

// Remove unnecessary menu items from admin dashboard.
function dohnutt_remove_menus() {
  //remove_menu_page( 'index.php' );
  //remove_menu_page( 'edit.php' );
  //remove_menu_page( 'upload.php' );
  //remove_menu_page( 'edit.php?post_type=page' );
  remove_menu_page( 'edit-comments.php' );
  //remove_menu_page( 'themes.php' );
  //remove_menu_page( 'plugins.php' );
  //remove_menu_page( 'users.php' );
  //remove_menu_page( 'tools.php' );
  //remove_menu_page( 'options-general.php' );
}

// Change default page template title to 'Left Sidebar'
function dohnutt_default_template_title() {
  return __('Page with Sidebar (Default)', 'dohnutt');
}
add_filter('default_page_template_title', 'dohnutt_default_template_title');

// Hide archived posts from 'All Posts' screen.
add_filter( 'aps_status_arg_public', '__return_false' );
add_filter( 'aps_status_arg_private', '__return_false' );
add_filter( 'aps_status_arg_show_in_admin_all_list', '__return_false' );

// Add editor style
function dohnutt_editor_style() {
  add_editor_style ( get_template_directory_uri() . '/editor-style.css' );
}

// Add the_excerpt() functionality to Pages post type.
function dohnutt_add_page_excerpt() {
  add_post_type_support( 'page', 'excerpt' );
}

// Adds custom classes to the body class
function dohnutt_body_classes( $classes ) {
  if ( is_home() || is_search() ) :
    $classes[] = 'archive';
  endif;
  return $classes;
}
add_filter( 'body_class', 'dohnutt_body_classes' );

// Handy function to check if a page is a parent or a child.
function is_tree($post_id) {
	global $post;
	if ( is_page() && ($post->post_parent==$post_id || is_page($post_id) ) ) :
    return true;
	else :
    return false;
  endif;
}

// Filter oembeds so that they are responsive.
function dohnutt_embed_oembed_html( $cache, $url, $attr, $post_ID ) {
  $classes = array();
  $classes_all = array('oembed');
  if ( false !== strpos( $url, 'vimeo.com' ) || false !== strpos( $url, 'youtube.com' )  ) {
    $classes[] = 'embed-responsive embed-responsive-16by9';
  }
  $classes = array_merge( $classes, $classes_all );
  return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
}
add_filter( 'embed_oembed_html', 'dohnutt_embed_oembed_html', 99, 4 );


// Filter out other prefixes
function cavera_trim_archive_title($title, $id = null) {
  $title = str_replace('Archives:', '', $title);
  $title_words = explode(' ', $title);
  if (count($title_words) > 1) :
    $title_words[0] = '<span class="title-prefix">' . $title_words[0] . '</span>';
    return implode(' ', $title_words);
  else :
    return $title;
  endif;
}
add_filter( 'get_the_archive_title', 'cavera_trim_archive_title', 10, 2 );

// Modify excerpt length and remove the ellpisis.
function dohnutt_excerpt_length($length) {
  return 17;
}
add_filter('excerpt_length', 'dohnutt_excerpt_length');
function dohnutt_trim_excerpt($text) {
	return str_replace(' [&hellip;]', '...', $text);
}
add_filter('get_the_excerpt', 'dohnutt_trim_excerpt');

// Register scripts and styles.
if(!function_exists('dohnutt_theme_assets')) {
  function dohnutt_theme_assets() {
    wp_register_script('jquery-js',       '//ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', '', '2.2.2', true);
    wp_register_script('theme-js',        get_template_directory_uri() . '/js/script.min.js', '', '1.0', true);
    //wp_register_script('modernizr',     get_template_directory_uri() . '/js/modernizr.js');

    wp_register_style('theme-css',        get_stylesheet_uri());
    wp_register_style('font-awesome',     '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_register_style('fonts',            '//fonts.googleapis.com/css?family=Oswald:300,400,700|Space+Mono:400,400i,700,700i');
  }
}

// Enqueue scripts and styles.
if(!function_exists('dohnutt_theme_enqueue')) {
  function dohnutt_theme_enqueue() {
    wp_enqueue_style('theme-css');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('fonts');

    wp_enqueue_script('jquery-js');
    wp_enqueue_script('theme-js');
    //wp_enqueue_script('modernizr');
  }
}

// Add theme supports and nav menus.
if(!function_exists('dohnutt_theme_support')) {
  function dohnutt_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'quote', 'status', 'video' ) );

    add_image_size( 'loop', 960, 400, true );
    add_image_size( 'opengraph', 1200, 630, true );
    add_image_size( 'hero', 1920, 1440, false );

    register_nav_menus( array(
      'primary' => 'Primary Menu',
      'footer' => 'Footer Menu',
    ) );

  	add_filter( 'use_default_gallery_style', '__return_false' );
  }
}

function dohnutt_wpseo_image_size( $string ) {
  return 'opengraph';
}
add_filter( 'wpseo_opengraph_image_size', 'dohnutt_wpseo_image_size', 10, 1 );

// Add some custom CSS to ACF metaboxes.
function dohnutt_acf_admin_head() {
	?>
	<style type="text/css">
    @media (min-width: 600px) {
  		.acf-fields > .acf-field-half {
        width: 50%;
        float: left;
        clear: none;
      }
      .acf-fields > .acf-field-third {
        width: 33.3333333333333332%;
        float: left;
        clear: none;
      }
    }
	</style>
	<?php
}

// Runs all ACF field values through wp_kses_post()
function dohnutt_kses_post( $value ) {
	if( is_array($value) ) {
		return array_map('dohnutt_kses_post', $value);
	}
	return wp_kses_post( $value );
}
add_filter('acf/update_value', 'dohnutt_kses_post', 10, 1);

// Register sidebars.
if(!function_exists('dohnutt_sidebars')) {
  function dohnutt_sidebars() {
    register_sidebar(array(
      'name' => __('Default Sidebar', 'dohnutt'),
      'id' => 'default-sidebar',
      'description' => __('Main sidebar area.', 'dohnutt'),
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
      'before_widget' => '<div class="widget %1$s %2$s">',
      'after_widget' => '</div>'
    ));
  }
}

// Initialize all functions.
if(!function_exists('dohnutt_functions_init')) {
  function dohnutt_functions_init() {
    add_action('init', 'dohnutt_theme_assets');
    add_action('init', 'dohnutt_add_page_excerpt');
    add_action('after_setup_theme', 'dohnutt_theme_support');
    add_action('wp_enqueue_scripts', 'dohnutt_theme_enqueue');
    add_action('widgets_init', 'dohnutt_unregister_widgets', 11);
    add_action('widgets_init', 'dohnutt_sidebars');
    add_action('login_enqueue_scripts', 'dohnutt_login_styles');
    add_action('admin_init', 'dohnutt_editor_style');
    add_action('admin_menu', 'dohnutt_remove_menus');
    //add_action('acf/input/admin_head', 'dohnutt_acf_admin_head');
  }
}
dohnutt_functions_init();
