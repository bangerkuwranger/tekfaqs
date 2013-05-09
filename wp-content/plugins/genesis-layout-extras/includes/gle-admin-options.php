<?php
/**
 * Plugin admin settings page.
 *
 * @package    Genesis Layout Extras
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2011-2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/genesis-layout-extras/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.0.0
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'admin_notices', 'ddw_genesis_layout_extras_notices' );
/**
 * Admin notices when successfully saving or resetting settings
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_notices() {

	/** Bail if not on page */
	if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] != 'gle-layout-extras' )
		return;

	/** Save & Reset messages */
	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] ) {
		echo '<div id="message" class="updated"><p><strong>' . __( 'ALL extra layout settings were reset to their Genesis default option.', 'genesis-layout-extras' ) . '</strong></p></div>';
	} elseif ( isset( $_REQUEST['settings-updated'] ) && $_REQUEST['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated"><p><strong>' . __( 'The extra layout settings have been saved successfully.', 'genesis-layout-extras' ) . '</strong></p></div>';
	}

}  // end of function ddw_genesis_layout_extras_notices


add_action( 'admin_menu', 'ddw_genesis_layout_extras_theme_settings_init', 15 );
/**
 * This is a necessary go-between to get our scripts and boxes loaded
 * on the theme settings page only, and not the rest of the admin
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_theme_settings_init() {

	/** Pagehook */
	global $_gle_settings_pagehook;

	/** Add "Layout Extras" submenu */
	$_gle_settings_pagehook = add_submenu_page( 'genesis', __('Genesis Layout Extras', 'genesis-layout-extras' ), __( 'Layout Extras', 'genesis-layout-extras' ), 'manage_options', 'gle-layout-extras', 'ddw_genesis_layout_extras_settings_admin');

	/** Load scripts and metaboxes */
	add_action( 'load-' . $_gle_settings_pagehook, 'ddw_genesis_layout_extras_theme_settings_scripts' );
	add_action( 'load-' . $_gle_settings_pagehook, 'ddw_genesis_layout_extras_theme_settings_boxes' );

	/** Load help tabs for WordPress 3.3 and higher */
	add_action( 'load-' . $_gle_settings_pagehook, 'ddw_genesis_layout_extras_help_tabs' );

}  // end of function ddw_genesis_layout_extras_theme_settings_init


/**
 * Loads scripts used in options page
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_theme_settings_scripts() {
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'wp-lists' );
	wp_enqueue_script( 'postbox' );

}  // end of function ddw_genesis_layout_extras_theme_settings_scripts


/**
 * Add meta boxes to options page
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_theme_settings_boxes() {

	/** Pagehook */
	global $_gle_settings_pagehook;

	$gle_meta_box_title = __( 'Genesis Layout Extras', 'genesis-layout-extras' ) . ': ';

	/** Add first meta box and its title */
	add_meta_box( 'genesis-layout-extras-box', $gle_meta_box_title . __( 'WordPress Defaults', 'genesis-layout-extras' ), 'ddw_genesis_layout_extras_box', $_gle_settings_pagehook, 'column1' );

	/** Add optional second meta box and its title */
	if ( post_type_exists( 'listing' )
		|| class_exists( 'bbPress' )
		|| post_type_exists( 'product' )
		|| post_type_exists( 'video' )
		|| post_type_exists( 'download' )
		|| post_type_exists( 'sc_event' )
	) {

		add_meta_box( 'genesis-layout-extras-box-cpts', $gle_meta_box_title . __( 'Custom Post Types by Plugins', 'genesis-layout-extras' ), 'ddw_genesis_layout_extras_box_cpts', $_gle_settings_pagehook, 'column1' );

		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-options-plugins.php' );

	}  // end-if plugin CPT check

	/**
	 * Add optional third meta box and its title
	 */

	$gle_theme_check = 'default';

	if ( post_type_exists( 'portfolio' )
		|| post_type_exists( 'products' )
		|| post_type_exists( 'photo' )
	) {

			/** For StudioPress */
		if ( function_exists( 'minimum_portfolio_post_type' ) || function_exists( 'executive_portfolio_post_type' ) ) {

			require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-options-studiopress.php' );

			$gle_theme_check = 'ddw_genesis_layout_extras_box_studiopress';

		}
			/** For Themedy brand */
		elseif ( function_exists( 'themedy_load_styles' ) ) {

			require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-options-themedy.php' );

			$gle_theme_check = 'ddw_genesis_layout_extras_box_themedy';

		}
			/** For ZigZagPress brand zigzagpress_portfolio_layout */
		elseif ( function_exists( 'zp_footer_menu' )
				|| function_exists( 'project_showcase' )
				|| function_exists( 'zp_socialicon_load_widget' )
				|| function_exists( 'zp_home_slider' )
		) {

			require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-options-zigzagpress.php' );

			$gle_theme_check = 'ddw_genesis_layout_extras_box_zigzagpress';

		}  // end-if theme/brand check

		add_meta_box( 'genesis-layout-extras-box-childthemes', $gle_meta_box_title . __( 'Custom Post Types by Child Themes', 'genesis-layout-extras' ), $gle_theme_check, $_gle_settings_pagehook, 'column1' );

	}  // end-if child theme CPT check

}  // end of function ddw_genesis_layout_extras_theme_settings_boxes


/**
 * First meta box: setting up the setting fields & labels.
 * For WordPress core template tags.
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_box() {

	/** Description - user info */
	echo '<p><span class="description">' . __( 'Here you can set up a <strong>default</strong> layout option for various extra archive pages and other special pages.', 'genesis-layout-extras' ) . ' ' . sprintf( __( '%1$sGenesis Default%2$s in the drop-down menus below always means the chosen default layout option in the regular <a href="%3$s">Genesis layout settings</a>.', 'genesis-layout-extras' ), '<code style="font-style: normal; color: #333;">', '</code>', admin_url( 'admin.php?page=genesis#genesis-theme-settings-layout' ) ) . '</span></p>';

		echo '<hr class="div" />';

	/** Special sections */
	echo '<h4>' . __( 'Special Sections', 'genesis-layout-extras' ) . '</h4>';

		ddw_genesis_layout_extras_option( __( 'Hompage Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_home' );

			echo '<p><span class="description">' . sprintf( __( 'This setting works for homepage templates (file %1$shome.php%2$s is there - %1$sis_home()%2$s) <u>and</u> also for static pages as front page (%1$sis_front_page()%2$s).', 'genesis-layout-extras' ), '<code style="font-style: normal; color: #333;">', '</code>' ) . '</span></p>';

		ddw_genesis_layout_extras_option( __( 'Search Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_search' );

			echo '<p><span class="description">' . __( 'For regular search results display &ndash; if there are any results.', 'genesis-layout-extras' ) . '</span></p>';

		ddw_genesis_layout_extras_option( __( 'Search Not Found Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_search_not_found' );

			echo '<p><span class="description">' . __( 'If there are NO search results (empty).', 'genesis-layout-extras' ) . '</span></p>';

		ddw_genesis_layout_extras_option( __( '404 Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_404' );

			echo '<p><span class="description">' . sprintf( __( 'If a page/URL is not found. Regarding the %1$s404.php%2$s error page template from Genesis core or from current child theme.', 'genesis-layout-extras' ), '<code style="font-style: normal; color: #333;">', '</code>' ) . '</span></p>';

		echo '<div class="bottom-buttons"><input type="submit" class="button button-highlighted" value="' . __( 'Save', 'genesis-layout-extras' ) . '" /></div>';

		echo '<hr class="div" />';

	/** Singular pages */
	echo '<h4>' . __( 'Singular Pages', 'genesis-layout-extras' ) . '</h4>';

		ddw_genesis_layout_extras_option( __( 'Post Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_post' );
		ddw_genesis_layout_extras_option( __( 'Page Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_page' );
		ddw_genesis_layout_extras_option( __( 'Attachment Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_attachment' );

		echo '<div class="bottom-buttons"><input type="submit" class="button button-highlighted" value="' . __( 'Save', 'genesis-layout-extras' ) . '" /></div>';

		echo '<hr class="div" />';

	/** Archive sections */
	echo '<h4>' . __( 'Archive Sections', 'genesis-layout-extras' ) . '</h4>';

		ddw_genesis_layout_extras_option( __( 'Author Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_author' );
		ddw_genesis_layout_extras_option( __( 'Date Archive Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_date' );

			echo '<p><span class="description">' . sprintf( __( 'This is the general setting for date archives and overwrites the following three settings (Year, Month, Day)! So, if you setup any of the following three settings then let this one here on %1$sGenesis Default%2$s.', 'genesis-layout-extras' ), '<code style="font-style: normal; color: #333;">', '</code>' ) . '</span></p>';

		ddw_genesis_layout_extras_option( '&middot; ' . __( 'Date Archive - Year Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_date_year' );
		ddw_genesis_layout_extras_option( '&middot; ' . __( 'Date Archive - Month Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_date_month' );
		ddw_genesis_layout_extras_option( '&middot; ' . __( 'Date Archive - Day Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_date_day' );
		ddw_genesis_layout_extras_option( __( 'Category Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_category' );
		ddw_genesis_layout_extras_option( __( 'Tag Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_tag' );
		ddw_genesis_layout_extras_option( __( 'Taxonomy Page Layout', 'genesis-layout-extras' ) . ': ', 'ddw_genesis_layout_taxonomy' );

		echo '<div class="bottom-buttons"><input type="submit" class="button button-highlighted" value="' . __( 'Save', 'genesis-layout-extras' ) . '" /></div>';

}  // end of function ddw_genesis_layout_extras_box


/**
 * Setting up the drop-down menus
 *
 * @since 1.0.0
 *
 * @param $title
 * @param $option
 */
function ddw_genesis_layout_extras_option( $title, $option ) {

	?>

	<p><?php echo $title; ?>
	<select name="<?php echo GLE_SETTINGS_FIELD; ?>[<?php echo $option; ?>]">
		<option style="padding-right:10px;" value="" <?php selected( '', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Genesis Default', 'genesis-layout-extras' ); ?></option>
		<option style="padding-right: 10px; background-color: #eee;" value="content-sidebar" <?php selected( 'content-sidebar', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Content-Sidebar', 'genesis-layout-extras'); ?></option>
		<option style="padding-right: 10px; background-color: #eee;" value="sidebar-content" <?php selected( 'sidebar-content', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Sidebar-Content', 'genesis-layout-extras' ); ?></option>
		<option style="padding-right: 10px; background-color: #fafafa;" value="content-sidebar-sidebar" <?php selected( 'content-sidebar-sidebar', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Content-Sidebar-Sidebar', 'genesis-layout-extras' ); ?></option>
		<option style="padding-right: 10px; background-color: #fafafa;" value="sidebar-sidebar-content" <?php selected( 'sidebar-sidebar-content', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Sidebar-Sidebar-Content', 'genesis-layout-extras' ); ?></option>
		<option style="padding-right: 10px; background-color: #fafafa;" value="sidebar-content-sidebar" <?php selected( 'sidebar-content-sidebar', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Sidebar-Content-Sidebar', 'genesis-layout-extras' ); ?></option>
		<option style="padding-right: 10px; background-color: #ddd;" value="full-width-content" <?php selected( 'full-width-content', genesis_get_option( $option, GLE_SETTINGS_FIELD ) ); ?>><?php _e( 'Full Width Content', 'genesis-layout-extras' ); ?></option>
	</select></p>

	<?php

}  // end of function ddw_genesis_layout_extras_option


add_filter( 'screen_layout_columns', 'ddw_genesis_layout_extras_settings_layout_columns', 10, 2 );
/**
 * Setting 1 column for meta boxes
 *
 * @since 1.0.0
 *
 * @global mixed $_gle_settings_pagehook
 * @param $columns
 * @param $screen
 * @return int column
 */
function ddw_genesis_layout_extras_settings_layout_columns( $columns, $screen ) {

	/** Pagehook */
	global $_gle_settings_pagehook;

	/** Set column */
	if ( $screen == $_gle_settings_pagehook ) {

		// This page should have 1 column option
		$columns[$_gle_settings_pagehook] = 1;

	}

	return $columns;

}  // end of function ddw_genesis_layout_extras_settings_layout_columns


/**
 * This function is what actually gets output to the page. It handles the markup,
 * builds the form, outputs necessary JS stuff, and fires <code>do_meta_boxes()</code>
 *
 * @since 1.0.0
 *
 * @global mixed $_gle_settings_pagehook, $screen_layout_columns
 */
function ddw_genesis_layout_extras_settings_admin() {

	global $_gle_settings_pagehook, $screen_layout_columns;

	/** Set width and hide other columns */
	$width = "width: 99%;";
	$min_height = " min-height: 99%; !important";
	$hide2 = $hide3 = " display: none;";

	/** Output the page content/markup */
	?>
		<div id="gs" class="wrap genesis-metaboxes">
		<form method="post" action="options.php">

			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
			<?php settings_fields( GLE_SETTINGS_FIELD );  // important!  ?>

			<?php screen_icon( 'themes' ); ?>
			<h2>
				<?php _e( 'Genesis - Layout Extras', 'genesis-layout-extras' ); ?>
			</h2>

			<div class="<?php if ( class_exists( 'Genesis_Admin' ) ) { echo 'top-buttons'; } else { echo 'bottom-buttons'; } ?>"><br />
				<input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Save Settings', 'genesis-layout-extras' ) ?>" />
				<input type="submit" class="button-highlighted genesis-h2-button" name="<?php echo GLE_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'genesis-layout-extras' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset? - When resetting, ALL extra layout settings will be set to their Genesis default option!', 'genesis-layout-extras' ) ); ?>');" />
			</div><!-- .top-buttons -->

			<div class="metabox-holder">
				<div class="postbox-container" style="<?php echo $width; $min_height; ?>">
					<?php do_meta_boxes( $_gle_settings_pagehook, 'column1', null ); ?>
				</div>
			</div>

			<div class="bottom-buttons">
				<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'genesis-layout-extras' ) ?>" />
				<input type="submit" class="button-highlighted" name="<?php echo GLE_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'genesis-layout-extras' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset? - When resetting, ALL extra layout settings will be set to their Genesis default option!', 'genesis-layout-extras' ) ); ?>');" />
			</div><!-- .bottom-buttons -->

		</form>
		</div>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				// close postboxes that should be closed
				$( '.if-js-closed' ).removeClass( 'if-js-closed' ).addClass( 'closed' );
				// postboxes setup
				postboxes.add_postbox_toggles( '<?php echo $_gle_settings_pagehook; ?>' );
			});
			//]]>
		</script>

	<?php

}  // end of function ddw_genesis_layout_extras_settings_admin
