<?php

class PressApps_Shortcode_Generator {

    function __construct() {
   
        add_action( 'admin_init', array( &$this, 'init' ) );
        add_action( 'wp_ajax_gp_check_url_action', array( &$this, 'ajax_action_check_url' ) );

        // Shortcode testing functionality.
        //if ( ! function_exists( 'add_shortcode' ) ) return;
        //add_shortcode( 'testing',     array( &$this, 'shortcode_testing' ) );
    } 


    function init() {
        global $pagenow;

        if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing') == 'true' && ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) )  {

            // Add the tinyMCE buttons and plugins.
            add_filter( 'mce_buttons'           , array( &$this, 'filter_mce_buttons' ) );
            add_filter( 'mce_external_plugins'  , array( &$this, 'filter_mce_external_plugins' ) );

            // Register the colourpicker JavaScript.
            wp_register_script( 'gpcolourpicker', plugins_url('js/colorpicker.js',__FILE__), array( 'jquery' ), '3.6', true ); // Loaded into the footer.
            wp_enqueue_script( 'gpcolourpicker' );

            // Register the colourpicker CSS.
            wp_register_style( 'gpcolourpicker', plugins_url('css/colorpicker.css',__FILE__));
            wp_enqueue_style( 'gpcolourpicker' );

            // Register the custom CSS styles.
            wp_register_style( 'gpshortcode-generator', plugins_url('css/shortcode-generator.css',__FILE__));
            wp_enqueue_style( 'gpshortcode-generator' );

        } 

    } 

    function filter_mce_buttons( $buttons ) {

        array_push( $buttons, '|', 'gpthemes_shortcodes_button' );
        return $buttons;
		
    } 
    
    function filter_mce_external_plugins( $plugins ) {
		
        $plugins['GPShortcodes'] = plugins_url('js/shortcode-generator/editor_plugin.js',__FILE__);
        
        return $plugins;
        
    }
	

    function framework_url() {

        return trailingslashit(plugins_url('',__FILE__));

    } 
    
    function ajax_action_check_url() {

	$hadError = true;

	$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';

	if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
			
		$file_headers = @get_headers( $url );
		$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
		$hadError     = false;
	}

	echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';

	die();
    } 


} 


global $pressapps_shortcode_generator;
$pressapps_shortcode_generator = new PressApps_Shortcode_Generator();    