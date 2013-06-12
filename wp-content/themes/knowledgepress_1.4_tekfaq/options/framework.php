<?php
/*
Description: A framework for building theme options.
Credit: Options Framework by Devin Price http://www.wptheming.com
License: GPLv2
Version: 1.3
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little extension, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'guerillaframework_rolescheck' );

function guerillaframework_rolescheck () {
	if ( current_user_can( 'edit_theme_options' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action( 'admin_menu', 'guerillaframework_add_page');
		add_action( 'admin_init', 'guerillaframework_init' );
		add_action( 'admin_init', 'guerillaframework_mlu_init' );
		add_action( 'wp_before_admin_bar_render', 'guerillaframework_adminbar' );
	}
}

/* Loads the file for option sanitization */

add_action('init', 'guerillaframework_load_sanitization' );

function guerillaframework_load_sanitization() {
	require_once dirname( __FILE__ ) . '/sanitize.php';
}

/* 
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function guerillaframework_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/interface.php';
	require_once dirname( __FILE__ ) . '/medialibrary-uploader.php';
	
	// Loads the options array from the theme
	if ( $optionsfile = locate_template( array('options.php') ) ) {
		require_once($optionsfile);
	}
	else if (file_exists( dirname( __FILE__ ) . '/options.php' ) ) {
		require_once dirname( __FILE__ ) . '/options.php';
	}
	
	$guerillaframework_settings = get_option('guerillaframework' );
	
	// Updates the unique option id in the database if it has changed
	guerillaframework_option_name();
	
	// Gets the unique id, returning a default if it isn't defined
	if ( isset($guerillaframework_settings['id']) ) {
		$option_name = $guerillaframework_settings['id'];
	}
	else {
		$option_name = 'guerillaframework';
	}
	
	// If the option has no saved data, load the defaults
	if ( ! get_option($option_name) ) {
		guerillaframework_setdefaults();
	}
	
	// Registers the settings fields and callback
	register_setting( 'guerillaframework', $option_name, 'guerillaframework_validate' );
	
	// Change the capability required to save the 'guerillaframework' options group.
	add_filter( 'option_page_capability_guerillaframework', 'guerillaframework_page_capability' );
}

/**
 * Ensures that a user with the 'edit_theme_options' capability can actually set the options
 * See: http://core.trac.wordpress.org/ticket/14365
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */

function guerillaframework_page_capability( $capability ) {
	return 'edit_theme_options';
}

/* 
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function guerillaframework_setdefaults() {
	
	$guerillaframework_settings = get_option('guerillaframework');

	// Gets the unique option id
	$option_name = $guerillaframework_settings['id'];
	
	/* 
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.  
	 *
	 */
	
	if ( isset($guerillaframework_settings['knownoptions']) ) {
		$knownoptions =  $guerillaframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$guerillaframework_settings['knownoptions'] = $knownoptions;
			update_option('guerillaframework', $guerillaframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$guerillaframework_settings['knownoptions'] = $newoptionname;
		update_option('guerillaframework', $guerillaframework_settings);
	}
	
	// Gets the default options data from the array in options.php
	$options = guerillaframework_options();
	
	// If the options haven't been added to the database yet, they are added now
	$values = gt_get_default_values();
	
	if ( isset($values) ) {
		add_option( $option_name, $values ); // Add option with default settings
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if ( !function_exists( 'guerillaframework_add_page' ) ) {

	function guerillaframework_add_page() {
		$gf_page = add_theme_page(__('Theme Options', 'guerilla'), __('Theme Options', 'guerilla'), 'edit_theme_options', 'options-framework','guerillaframework_page');
		
		// Load the required CSS and javscript
		add_action('admin_enqueue_scripts', 'guerillaframework_load_scripts');
		add_action( 'admin_print_styles-' . $gf_page, 'guerillaframework_load_styles' );
	}
	
}

/* Loads the CSS */

function guerillaframework_load_styles() {
	wp_enqueue_style('guerillaframework', GUERILLA_FRAMEWORK_DIRECTORY.'css/framework.css', array( 'farbtastic' ));
}	

/* Loads the javascript */

function guerillaframework_load_scripts($hook) {

	if ( 'appearance_page_options-framework' != $hook )
        return;
	
	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('options-custom', GUERILLA_FRAMEWORK_DIRECTORY.'js/options-custom.js', array('jquery', 'farbtastic'));

	// Inline scripts from interface.php
	add_action('admin_head', 'gt_admin_head');
}

function gt_admin_head() {

	// Hook to add custom scripts
	do_action( 'guerillaframework_custom_scripts' );
}

/* 
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom guerillaframework_fields.  See interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'guerillaframework_page' ) ) {
	function guerillaframework_page() {
		settings_errors();
?>

	<div id="guerillaframework-wrap" class="wrap">
    <?php screen_icon( 'themes' ); ?>
    <h2 class="nav-tab-wrapper">
        <?php echo guerillaframework_tabs(); ?>
    </h2>

    <div id="guerillaframework-metabox">
	    <div id="guerillaframework">
			<form action="options.php" method="post">
			<?php settings_fields('guerillaframework'); ?>
			<?php guerillaframework_fields(); /* Settings */ ?>
			<div id="guerillaframework-submit">
				<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', 'guerillaframework' ); ?>" />
				<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Reset Defaults', 'guerillaframework' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', 'guerilla' ) ); ?>' );" />
				<div class="clear"></div>
			</div>
			</form>
		</div> <!-- / #container -->
	</div>
	<?php do_action('guerillaframework_after'); ?>
	</div> <!-- / .wrap -->
	
<?php
	}
}

/**
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset'] to restore default options
 */
function guerillaframework_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */

	if ( isset( $_POST['reset'] ) ) {
		add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'guerilla' ), 'updated fade' );
		return gt_get_default_values();
	} else {
	
	/*
	 * Update Settings
	 *
	 * This used to check for $_POST['update'], but has been updated
	 * to be compatible with the theme customizer introduced in WordPress 3.4
	 */

		$clean = array();
		$options = guerillaframework_options();
		foreach ( $options as $option ) {

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( ! isset( $option['type'] ) ) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

			// Set checkbox to false if it wasn't sent in the $_POST
			if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = false;
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = false;
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if ( has_filter( 'gt_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'gt_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', 'guerilla' ), 'updated fade' );
		return $clean;
	}

}

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */
 
function gt_get_default_values() {
	$output = array();
	$config = guerillaframework_options();
	foreach ( (array) $config as $option ) {
		if ( ! isset( $option['id'] ) ) {
			continue;
		}
		if ( ! isset( $option['std'] ) ) {
			continue;
		}
		if ( ! isset( $option['type'] ) ) {
			continue;
		}
		if ( has_filter( 'gt_sanitize_' . $option['type'] ) ) {
			$output[$option['id']] = apply_filters( 'gt_sanitize_' . $option['type'], $option['std'], $option );
		}
	}
	return $output;
}

/**
 * Add Theme Options menu item to Admin Bar.
 */

function guerillaframework_adminbar() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
			'parent' => 'appearance',
			'id' => 'gt_theme_options',
			'title' => __( 'Theme Options', 'guerilla' ),
			'href' => admin_url( 'themes.php?page=options-framework' )
		));
}

if ( ! function_exists( 'gt_get_option' ) ) {

	/**
	 * Get Option.
	 *
	 * Helper function to return the theme option value.
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */
	 
	function gt_get_option( $name, $default = false ) {
		$config = get_option( 'guerillaframework' );

		if ( ! isset( $config['id'] ) ) {
			return $default;
		}

		$options = get_option( $config['id'] );

		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}

		return $default;
	}
}