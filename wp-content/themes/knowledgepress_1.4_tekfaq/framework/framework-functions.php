<?php
/*-----------------------------------------------------------------------------------*/
/*
/* Guerilla Themes Framework */
/*
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Load the required framework files */
/*-----------------------------------------------------------------------------------*/

$framework_path = get_template_directory() . '/framework/';

if ( gt_get_option('shortcodes_enable') ) {
	require_once ( $framework_path . 'shortcodes/framework-shortcodes.php' );						// Shortcodes
	require_once ( $framework_path . 'shortcodes/shortcode-generator/shortcode-generator.php' );	// Shortcode generator
}
