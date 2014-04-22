<?php
/**
 * Plugin Name: PressApps Shortcodes
 * Plugin URI: http://pressapps.co/plugins/
 * Description: Shotcode plugin for PressApps themes
 * Author: PressApps Team
 * Version: 1.0.0
 */

add_filter( 'widget_text', 'do_shortcode' );


define('PRESSAPPS_PLUGIN_DIR', dirname(__FILE__));

class PRESSAPPS_SHORTCODE{
    
    /**
     * Setup the Environment for the Plugin
     */
    function __construct() {
        
        include_once 'function.php';
        include_once 'shortcode-generator.php';
        
        load_plugin_textdomain('pressapps', false, basename(dirname(__FILE__)).'/language' );
        
    }
}

$pressapps_shortcode = new PRESSAPPS_SHORTCODE();


