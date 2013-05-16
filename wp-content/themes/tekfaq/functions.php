<?php
add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
	
	// ** Backend **
	
	// Remove Metaboxes
	add_action( 'genesis_theme_settings_metaboxes', 'be_remove_metaboxes' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'TekFAQs' );
define( 'CHILD_THEME_URL', 'http://www.chadacarino.com/' );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'sample_viewport_meta_tag' );
function sample_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for custom header
add_theme_support( 'genesis-custom-header', array(
	'width' => 1152,
	'height' => 120
) );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Options panel
require_once('options/panel.php');

/*-----------------------------------------------------------------------------------*/
/* Load Theme */
/*-----------------------------------------------------------------------------------*/

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/config.php');          // Configuration and constants
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/template-tags.php');   // Template tags
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/post-types.php');      // Custom post types
require_once locate_template('/lib/options-functions.php');
require_once locate_template('/lib/metaboxes.php');       // Custom metaboxes
require_once locate_template('/lib/custom.php');          // Custom functions

/*-----------------------------------------------------------------------------------*/
/* Load Framework */
/*-----------------------------------------------------------------------------------*/

require_once ( get_stylesheet_directory() . '/framework/framework-functions.php' );

function roots_setup() {

  // Make theme available for translation
  load_theme_textdomain('guerilla', get_stylesheet_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'guerilla'),
   // 'footer_navigation' => __('Footer Navigation', 'guerilla'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  add_image_size('image_870x490', 870, 490, true); 
  // add_image_size('image_870x870', 870, 870, true); 

  add_image_size('image_1170x659', 1170, 659, true); 

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  add_theme_support('post-formats', array('image', 'video' ));
  
  add_theme_support( 'automatic-feed-links' );

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('assets/css/editor-style.css');

}

add_action('after_setup_theme', 'roots_setup');

// comment_form();
/*
add_filter( 'the_excerpt', 'remove_code_shortcode' );
function remove_code_shortcode( $excerpt ) {
  return preg_replace ('/\[code[^\]]*\](.*)\[\/code\]/', '$1', $excerpt);
}
*/
}