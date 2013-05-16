<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'video_metabox' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function video_metabox( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_';

	$meta_boxes[] = array(
		'id'         => 'video_metabox',
		'title'      => 'Video Post Settings',
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'YouTube Code',
				'desc' => 'Enter YouTube embed code',
				'id'   => $prefix . 'video_youtube',
				'type' => 'textarea_code',
			),
			array(
				'name' => 'Vimeo Code',
				'desc' => 'Enter Vimeo embed code',
				'id'   => $prefix . 'video_vimeo',
				'type' => 'textarea_code',
			),
		),
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {


	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once get_stylesheet_directory() . '/lib/metabox/init.php';

}