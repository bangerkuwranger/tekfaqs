<?php

if ( !function_exists( 'guerillaframework_init' ) ) {

/*-----------------------------------------------------------------------------------*/
/* Guerilla Framework 
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Guerilla Framework is a parent theme or child theme */

if ( get_stylesheet_directory() == get_stylesheet_directory() ) {
	define('GUERILLA_FRAMEWORK_URL', get_stylesheet_directory() . '/options/');
	define('GUERILLA_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/options/');
} else {
	define('GUERILLA_FRAMEWORK_URL', get_stylesheet_directory() . '/options/');
	define('GUERILLA_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/options/');
}
require_once (get_stylesheet_directory() . '/options/framework.php');
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('guerillaframework_custom_scripts', 'guerillaframework_custom_scripts');

function guerillaframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#showhidden_gradient').click(function() {
  		jQuery('#section-top_nav_bottom_gradient_color').fadeToggle(400);
	});
	
	if (jQuery('#showhidden_gradient:checked').val() !== undefined) {
		jQuery('#section-top_nav_bottom_gradient_color').show();
	}
	
	jQuery('#showhidden_themes').click(function() {
			jQuery('#section-wpbs_theme').fadeToggle(400);
	});
	
	if (jQuery('#showhidden_themes:checked').val() !== undefined) {
		jQuery('#section-wpbs_theme').show();
	}

	jQuery('#showhidden_slideroptions').click(function() {
			jQuery('#section-slider_categories').fadeToggle(400);
			jQuery('#section-slider_options').fadeToggle(400);
	});
	
	if (jQuery('#showhidden_slideroptions:checked').val() !== undefined) {
		jQuery('#section-slider_categories').show();
		jQuery('#section-slider_options').show();
	} else {
		jQuery('#section-slider_categories').hide();
		jQuery('#section-slider_options').hide();
	}
	
	jQuery('#blog_hero').click(function() {
			jQuery('#section-blog_hero_content').fadeToggle(400);
	});
	
	if (jQuery('#blog_hero:checked').val() !== undefined) {
		jQuery('#section-blog_hero_content').show();
	} else {
		jQuery('#section-blog_hero_content').hide();
	}
	
	/**
	 * Initialize color picker
	 */
    jQuery('input:text.cmb_colorpicker').each(function (i) {
        jQuery(this).after('<div id="picker-' + i + '" style="z-index: 1000; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>');
        jQuery('#picker-' + i).hide().farbtastic(jQuery(this));
    })
    .focus(function() {
        jQuery(this).next().show();
    })
    .blur(function() {
        jQuery(this).next().hide();
    });
	
	
});
</script>

<?php
}

/* 
 * Turns off the default options panel from Twenty Eleven
 */
 
add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}
