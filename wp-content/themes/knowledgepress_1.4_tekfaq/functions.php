<?php
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

require_once ( get_template_directory() . '/framework/framework-functions.php' );

function roots_setup() {

  // Make theme available for translation
  load_theme_textdomain('guerilla', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'guerilla'),
   // 'footer_navigation' => __('Footer Navigation', 'guerilla'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
	add_image_size('image_254x400', 254, 400, true); 
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

// Register Custom Taxonomy
function create_device_taxonomy()  {
	$labels = array(
		'name'                       => _x( 'Devices', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Device', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Device', 'text_domain' ),
		'all_items'                  => __( 'All Devices', 'text_domain' ),
		'parent_item'                => __( 'Parent Device', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Device:', 'text_domain' ),
		'new_item_name'              => __( 'New Device Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Device', 'text_domain' ),
		'edit_item'                  => __( 'Edit Device', 'text_domain' ),
		'update_item'                => __( 'Update Device', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate devices with commas', 'text_domain' ),
		'search_items'               => __( 'Search devices', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove devices', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from previously used devices', 'text_domain' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);

	register_taxonomy( 'device', 'post', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_device_taxonomy', 0 );


// Register Custom Taxonomy
function create_os_taxonomy()  {
	$labels = array(
		'name'                       => _x( 'Operating Systems', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Operating System', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Operating System', 'text_domain' ),
		'all_items'                  => __( 'All Operating Systems', 'text_domain' ),
		'parent_item'                => __( 'Parent OS', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent OS:', 'text_domain' ),
		'new_item_name'              => __( 'New OS Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New OS', 'text_domain' ),
		'edit_item'                  => __( 'Edit OS', 'text_domain' ),
		'update_item'                => __( 'Update OS', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate operating systems with commas', 'text_domain' ),
		'search_items'               => __( 'Search operating systems', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove OSes', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from previously used OSes', 'text_domain' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);

	register_taxonomy( 'os', 'post', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_os_taxonomy', 0 );



// comment_form();
/*
add_filter( 'the_excerpt', 'remove_code_shortcode' );
function remove_code_shortcode( $excerpt ) {
  return preg_replace ('/\[code[^\]]*\](.*)\[\/code\]/', '$1', $excerpt);
}
*/
