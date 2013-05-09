<?php
/**
 * Main plugin file.
 * This plugin for Genesis Theme Framework allows modifying of default layouts
 *    for homepage, singular, archive, attachment, search, 404 and even
 *    bbPress 2.x pages via Genesis theme settings.
 *
 * @package   Genesis Layout Extras
 * @author    David Decker
 * @copyright Copyright (c) 2011-2013, David Decker - DECKERWEB
 * @link      http://deckerweb.de/twitter
 *
 * @origin    Based on the work of @WPChildThemes for original plugin called
 *            "Genesis Layout Manager" (C) 2010 (GPL).
 *
 * Plugin Name: Genesis Layout Extras
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/genesis-layout-extras/
 * Description: This plugin for Genesis Theme Framework allows modifying of default layouts for homepage, singular, archive, attachment, search, 404 and even bbPress 2.x pages via Genesis theme settings.
 * Version: 1.7.0
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: genesis-layout-extras
 * Domain Path: /languages/
 *
 * Copyright (c) 2011-2013 David Decker - DECKERWEB
 *
 *     This file is part of Genesis Layout Extras,
 *     a plugin for WordPress.
 *
 *     Genesis Layout Extras is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     Genesis Layout Extras is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting constants
 *
 * @since 1.0.0
 */
/** Plugin directory */
define( 'GLE_PLUGIN_DIR', dirname( __FILE__ ) );

/** Plugin base directory */
define( 'GLE_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );

/** Plugin settings field */
define( 'GLE_SETTINGS_FIELD', 'gle-settings' );

/** Required Version of Genesis Framework */
define( 'GLE_REQUIRED_GENESIS', '1.8.2' );

/** Required Version of Genesis Framework */
define( 'GLE_LATEST_WORDPRESS', '3.4.2' );


register_activation_hook( __FILE__, 'ddw_genesis_layout_extras_activation_check' );
/**
 * Checks for activated Genesis Framework before allowing plugin to activate.
 *
 * Note: register_activation_hook() isn't run after auto or manual upgrade, only on activation!
 *
 * @since  1.3.0
 *
 * @uses   load_plugin_textdomain()
 * @uses   get_template_directory()
 * @uses   deactivate_plugins()
 * @uses   wp_die()
 *
 * @param  $gle_user_action_message
 * @param  $gle_deactivation_message
 *
 * @return string Optional plugin activation messages for the user.
 */
function ddw_genesis_layout_extras_activation_check() {

	/**
	 * Look for translations to display for the activation message
	 * Look first in WordPress "languages" folder, then in plugin's "languages" folder
	 */
	load_plugin_textdomain( 'genesis-layout-extras', false, GLE_PLUGIN_BASEDIR . '/../../languages/genesis-layout-extras/' );
	load_plugin_textdomain( 'genesis-layout-extras', false, GLE_PLUGIN_BASEDIR . '/languages' );

	/** Check for activated Genesis Framework (= template/parent theme) */
	if ( basename( get_template_directory() ) == 'genesis' && ! class_exists( 'Genesis_Admin_Boxes' ) ) {

		/** User action message */
		$gle_user_action_message = '<p>' . sprintf( __( 'You\'re in luck because you\'re already running the Genesis Framework :). However, you\'re using an %1$solder%2$s version of Genesis and should upgrade to the latest version available but at least to version %3$s.', 'genesis-layout-extras' ), '<em>', '</em>', '<code>' . GLE_REQUIRED_GENESIS . '</code>' ) . '</p>' .
			'<p>' . sprintf( __( 'Get the latest version of %1$sGenesis Framework here%2$s or go to your %3$sMy StudioPress Portal%4$s to download the latest version package. Also, make sure, you\'re running the latest WordPress version, that is %5$s or higher.', 'genesis-layout-extras' ), '<a href="http://deckerweb.de/go/genesis/" target="_new">', '</a>', '<a href="http://deckerweb.de/go/mystudiopress/" target="_new"><em>', '</em></a>', '<code>' . GLE_LATEST_WORDPRESS . '</code>' ) . '</p>' .
			'<p>' . sprintf( __( 'Just go back and enjoy using %s, while on the next occasion you should make any necessary updates. Thank you!', 'genesis-layout-extras' ), '<em>' . __( 'Genesis Layout Extras', 'genesis-layout-extras' ) . '</em>' ) . '</p>';

		wp_die( $gle_user_action_message, __( 'Genesis Layout Extras', 'genesis-layout-extras' ), array( 'back_link' => true ) );

	} elseif ( basename( get_template_directory() ) != 'genesis' ) {

		/** If no Genesis, deactivate ourself */
		deactivate_plugins( plugin_basename( __FILE__ ) );  // Deactivate ourself

		/** Deactivation message */
		$gle_deactivation_message = sprintf( __( 'Sorry, you can&rsquo;t activate unless you have installed the %1$sGenesis Framework%2$s', 'genesis-layout-extras' ), '<a href="http://deckerweb.de/go/genesis/" target="_new">', '</a>' );

		wp_die( $gle_deactivation_message, __( 'Genesis Layout Extras', 'genesis-layout-extras' ), array( 'back_link' => true ) );

	}  // end-if Genesis/ version check

}  // end of function ddw_genesis_layout_extras_activation_check


add_action( 'init', 'ddw_genesis_layout_extras_init' );
/**
 * Load the text domain for translation of the plugin.
 * Load admin helper functions - only within 'wp-admin'.
 * Load logic/functions for the frontend display - and only when on frontend.
 * 
 * @since 1.0.0
 *
 * @uses  load_plugin_textdomain()
 * @uses  is_admin()
 * @uses  current_user_can()
 *
 * @param $gle_wp_lang_dir
 * @param $gle_lang_dir
 */
function ddw_genesis_layout_extras_init() {

	/** Set filter for WordPress languages directory */
	$gle_wp_lang_dir = GLE_PLUGIN_BASEDIR . '/../../languages/genesis-layout-extras/';
	$gle_wp_lang_dir = apply_filters( 'gle_filter_wp_lang_dir', $gle_wp_lang_dir );

	/** Set filter for plugin's languages directory */
	$gle_lang_dir = GLE_PLUGIN_BASEDIR . '/languages/';
	$gle_lang_dir = apply_filters( 'gle_filter_lang_dir', $gle_lang_dir );

	/** Load the translations as well as admin and frontend functions only when needed */
	if ( is_admin() ) {
		
		/** First look in WordPress' "languages" folder = custom & update-secure! */
		load_plugin_textdomain( 'genesis-layout-extras', false, $gle_wp_lang_dir );

		/** Then look in plugin's "languages" folder = default */
		load_plugin_textdomain( 'genesis-layout-extras', false, $gle_lang_dir );

		/** Include plugin code parts */
		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-register-settings.php' );
		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-options.php' );
		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-functions.php' );
		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-extras.php' );
		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-help.php' );

	} else {

		require_once( GLE_PLUGIN_DIR . '/includes/gle-frontend.php' );

	}  // end-if is_admin() check

	/** Add "Settings Page" link to plugin page - only within 'wp-admin' */
	if ( is_admin() && current_user_can( 'manage_options' ) ) {

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ) , 'ddw_gle_settings_page_link' );

	}

}  // end of function ddw_genesis_layout_extras_init


/**
 * Returns current plugin's header data in a flexible way.
 *
 * @since  1.6.0
 *
 * @uses   get_plugins()
 *
 * @param  $gle_plugin_value
 * @param  $gle_plugin_folder
 * @param  $gle_plugin_file
 *
 * @return string Plugin data.
 */
function ddw_gle_plugin_get_data( $gle_plugin_value ) {

	/** Bail early if we are not in wp-admin */
	if ( ! is_admin() ) {
		return;
	}

	/** Include WordPress plugin data */
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$gle_plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$gle_plugin_file = basename( ( __FILE__ ) );

	return $gle_plugin_folder[ $gle_plugin_file ][ $gle_plugin_value ];

}  // end of function ddw_gle_plugin_get_data