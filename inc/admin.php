<?php
/*
 * Admin
 * @package eric
 */


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
add_action('login_enqueue_scripts', 'dohnutt_login_styles');


function dohnutt_login_custom_link() {
  return 'http://ericmoss.ca';
}
add_filter('login_headerurl','dohnutt_login_custom_link');


function dohnutt_login_title_on_logo() {
  return 'Website designed by Eric Moss';
}
add_filter('login_headertitle', 'dohnutt_login_title_on_logo');
