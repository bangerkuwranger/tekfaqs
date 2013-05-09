<?php
/**
 * Helper functions for the admin - help tabs.
 *
 * @package    Genesis Layout Extras
 * @subpackage Admin Help
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2011-2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/genesis-layout-extras/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.1.0
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
 * Add help tabs to options page - for WordPress 3.3 and higher
 *
 * @since  1.2.0
 *
 * @uses   get_current_screen()
 * @uses   WP_Screen::add_help_tab()
 * @uses   WP_Screen::set_help_sidebar()
 * @uses   ddw_gle_help_sidebar_content()
 *
 * @param  $screen
 *
 * @global $_gle_settings_pagehook
 *
 * @return strings Help tabs/content
 */
function ddw_genesis_layout_extras_help_tabs() {

	global $_gle_settings_pagehook;

	$screen = get_current_screen();

	/** Bail if not on screen or prior WordPress 3.3 */
	if ( ! class_exists( 'WP_Screen' )
		|| ! $screen
		|| $screen->id != $_gle_settings_pagehook
	) {
		return;
	}

	/** Add the help tabs */
	$screen->add_help_tab( array(
		'id'       => 'gle-usage',
		'title'    => __( 'What the Plugin Does', 'genesis-layout-extras' ),
		'callback' => apply_filters( 'gle_filter_help_content_usage', 'ddw_gle_help_content_usage' ),
	) );

	/** Help tab only if supported plugins active */
	if ( post_type_exists( 'listing' )
		|| class_exists( 'bbPress' )
		|| post_type_exists( 'product' )
		|| post_type_exists( 'video' )
		|| post_type_exists( 'download' )
		|| post_type_exists( 'sc_event' )
	) {

		$screen->add_help_tab( array(
			'id'       => 'gle-plugin-support',
			'title'    => __( 'Plugin Support', 'genesis-layout-extras' ),
			'callback' => apply_filters( 'gle_filter_help_plugins', 'ddw_gle_admin_help_plugins' ),
		) );

		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-help-plugins.php' );

	}  // end-if plugins check

	/**
	 * Help tab only if supported child themes active
	 */
	/** By StudioPress */
	if ( ( function_exists( 'minimum_portfolio_post_type' ) || function_exists( 'executive_portfolio_post_type' ) )
		&& post_type_exists( 'portfolio' )
	) {

		$screen->add_help_tab( array(
			'id'       => 'gle-child-theme-support',
			'title'    => __( 'Child Theme Support', 'genesis-layout-extras' ),
			'callback' => apply_filters( 'gle_filter_help_studiopress', 'ddw_gle_admin_help_studiopress' ),
		) );

		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-help-studiopress.php' );

	}  // end-if child theme studiopress check

	/** By Themedy brand */
	if ( function_exists( 'themedy_load_styles' )
		&& ( post_type_exists( 'products' ) || post_type_exists( 'photo' ) )
	) {

		$screen->add_help_tab( array(
			'id'       => 'gle-child-theme-support',
			'title'    => __( 'Child Theme Support', 'genesis-layout-extras' ),
			'callback' => apply_filters( 'gle_filter_help_themedy', 'ddw_gle_admin_help_themedy' ),
		) );

		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-help-themedy.php' );

	}  // end-if child theme themedy check

	/** By ZigZagPress brand */
	if ( ( CHILD_THEME_NAME == 'Megalithe'
			|| CHILD_THEME_NAME == 'Engrave Theme'
			|| CHILD_THEME_NAME == 'Vanilla'
			|| CHILD_THEME_NAME == 'Solo'
			|| CHILD_THEME_NAME == 'Bijou'
			|| CHILD_THEME_NAME == 'Eshop'
			|| CHILD_THEME_NAME == 'Single'
			|| CHILD_THEME_NAME == 'Tequila'
		) && post_type_exists( 'portfolio' )
	) {

		$screen->add_help_tab(array(
			'id'       => 'gle-child-theme-support',
			'title'    => __( 'Child Theme Support', 'genesis-layout-extras' ),
			'callback' => apply_filters( 'gle_filter_help_zigzagpress', 'ddw_gle_admin_help_zigzagpress' ),
		) );

		require_once( GLE_PLUGIN_DIR . '/includes/gle-admin-help-zigzagpress.php' );

	}  // end-if child theme zigzagpress check

	/** ...general help tabs cont. */
	$screen->add_help_tab( array(
		'id'       => 'gle-faq',
		'title'    => __( 'FAQ - Frequently Asked Questions', 'genesis-layout-extras' ),
		'callback' => apply_filters( 'gle_filter_help_content_faq', 'ddw_gle_help_content_faq' ),
	) );

	$screen->add_help_tab( array(
		'id'      => 'gle-translations',
		'title'   => __( 'Translations', 'genesis-layout-extras' ),
		'callback' => apply_filters( 'gle_filter_help_content_translations', 'ddw_gle_help_content_translations' ),
	) );

	$screen->add_help_tab( array(
		'id'      => 'gle-support-donation-rating-tips',
		'title'   => __( 'Support - Donations - Rating &amp; Tips', 'genesis-layout-extras' ),
		'callback' => apply_filters( 'gle_filter_help_content_support_donation_rating_tips', 'ddw_gle_help_content_support_donation_rating_tips' ),
	) );

	$screen->add_help_tab( array(
		'id'      => 'gle-author-license',
		'title'   => __( 'Author - License', 'genesis-layout-extras' ),
		'callback' => apply_filters( 'gle_filter_help_content_author_license', 'ddw_gle_help_content_author_license' ),
	) );

	/** Add help sidebar */
	$screen->set_help_sidebar( ddw_gle_help_sidebar_content() );

}  // ddw_genesis_layout_extras_help_tabs


/**
 * Create and display plugin help tab content: "Usage".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_plugin_get_data()
 *
 * @param  $gle_help_usage
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_usage() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . esc_attr( ddw_gle_plugin_get_data( 'Version' ) ) . '</small></h3>' .
			'<h4>' . __( 'What the Plugin Does', 'genesis-layout-extras' ) . '</h4>' .
			'<p>' . __( 'This plugin for the Genesis Theme Framework allows modifying of default layouts for homepage, singular, archive, attachment, search and 404 pages via an options page under the Genesis menu. In addition you can also modify the default layout option for pages generated by the bbPress 2.x forum plugin and the AgentPress Listings plugin.', 'genesis-layout-extras' ) . '</p>';

}  // end of function ddw_gle_help_content_usage


/**
 * Create and display plugin help tab content: "FAQ".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_plugin_get_data()
 *
 * @param  $gle_help_faq
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_faq() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . esc_attr( ddw_gle_plugin_get_data( 'Version' ) ) . '</small></h3>' .
			'<h4>' . __( 'FAQ - Frequently Asked Questions', 'genesis-layout-extras' ) . '</h4>' .
			'<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'Some settings seem to have no effect at all, what happens here?', 'genesis-layout-extras' ) . '</em><br /><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'This has to do with priorities. In general, if there is a template for a specific page (archive) type, for example <code>image.php</code> for image attachment display, then Genesis & WordPress will always use that first for the content output AS LONG AS there is an layout setting function or filter in there. Only if there are no templates with layout settings found, the layout option settings will take full effect. So, if our example <code>image.php</code> has a layout filter set in this then has the higher priority but if there is no layout filter in there then the layout setting of the plugin will take effect! - Well, if you experience such cases just leave these fields on "Genesis Default" and you are good to go :-).', 'genesis-layout-extras' ) . '</p>' .
			'<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'There are two layout options for the plugin AgentPress Listings post type. What does that mean?', 'genesis-layout-extras' ). '</em><br /><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . sprintf( __( 'You just can set the layout option for the archive pages of the "listings" post type, plus for all terms of its built-in "features" taxonomy. - &mdash; Of course, the plugin (and so the setting here) could be used with the %3$sAgentPress child theme%4$s and also with any other Genesis child theme, so this setting might come in really handy ;-).', 'genesis-layout-extras' ), '<a href="http://deckerweb.de/go/agentpress-listings/" target="_new" title="Plugin: AgentPress Listings ...">', '</a>', '<a href="http://deckerweb.de/go/genesis-agentpress-child-theme/" target="_new" title="AgentPress Genesis Child Theme ...">', '</a>' ) . '</p>' .
			'<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'What means Reset of settings?', 'genesis-layout-extras' ) . '</em><br /><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'Actually it just restores the default layout setting which is always defined in regular layout settings on the Genesis Theme Settings page.', 'genesis-layout-extras' ) . '</p>' .
			'<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'Which settings are effected when doing a reset?', 'genesis-layout-extras' ). '</em><br /><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'ALL available options <em>on this page</em> are resetted to their defaults! So if you only want to reset <em>one</em> option and leave all other as they are then only change this one section and then click the SAVE button and you are done.', 'genesis-layout-extras' ) . '</p>' .
			'<p><strong>' . __( 'Question', 'genesis-layout-extras' ) . ':</strong> <em>' . __( 'With my child theme some of the layout options have no effect, what happens here?', 'genesis-layout-extras' ) . '</em><br /><strong>' . __( 'Answer', 'genesis-layout-extras' ) . ':</strong> ' . __( 'This is the case when a child theme does not support one or more specific layout options. For example: When a child has unregistered the layout option "Sidebar-Sidebar-Content" then the plugin setting of "Sidebar-Sidebar-Content" will have no effect at all. This is absolutely logical behavior because the plugin can only set options which are supported by the active child theme.', 'genesis-layout-extras' ) . '</p>';

}  // end of function ddw_gle_help_content_faq


/**
 * Create and display plugin help tab content: "Translations".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_plugin_get_data()
 *
 * @param  $gle_help_translations
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_translations() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . esc_attr( ddw_gle_plugin_get_data( 'Version' ) ) . '</small></h3>' .
			'<h4>' . __( 'Translations', 'genesis-layout-extras' ) . '</h4>' .
			'<p>' . sprintf( __( 'Please contribute to existing or new translations on %sour free translations platform%s powered by GlotPress.', 'genesis-layout-extras' ), '<a href="' . esc_url( GLE_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'genesis-layout-extras' ) . '"><strong>', '</strong></a>' ) . '</p>' .
		'<p><strong><em>&mdash; ' . __( 'Thank You!', 'genesis-layout-extras' ) . '</em></strong></p>';

}  // end of function ddw_gle_help_content_translations


/**
 * Create and display plugin help tab content: "Support, Donation, Rating, Tips".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_plugin_get_data()
 *
 * @param  $gle_help_support_donation_rating_tips
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_support_donation_rating_tips() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . esc_attr( ddw_gle_plugin_get_data( 'Version' ) ) . '</small></h3>' .
			'<h4>' . __( 'Support - Donations - Rating &amp; Tips', 'genesis-layout-extras' ) . '</h4>' .
			'<p>&bull; <strong>' . __( 'Donations', 'genesis-layout-extras' ) . ':</strong> ' . sprintf( __( 'Please %1$sdonate to support the further maintenance and development%2$s of the plugin. <em>Thank you in advance!</em>', 'genesis-layout-extras' ), '<a href="' . esc_url( GLE_URL_DONATE ) . '" target="_new">', '</a>' ) . '</p>' .
			'<p>&bull; <strong>' . __( 'Support', 'genesis-layout-extras' ). ':</strong> ' . sprintf( __( 'Done via %1$sWordPress.org plugin page support forum%2$s. - Maybe I will setup my own support forum in the future, though.', 'genesis-layout-extras' ), '<a href="' . esc_url( GLE_URL_WPORG_FORUM ) . '" target="_new" title="WordPress.org Plugin Support Forum ...">', '</a>' ) . '</p>' .
			'<p>&bull; <strong>' . __( 'Rating &amp; Tips', 'genesis-layout-extras' ) . ':</strong> ' . sprintf( __( 'If you like the plugin please %1$srate at WordPress.org%2$s with 5 stars. <em>Thank you!</em> &mdash; %3$sMore plugins for Genesis Framework and WordPress in general by DECKERWEB%4$s', 'genesis-layout-extras' ), '<a href="' . esc_url( GLE_URL_WPORG_PLUGIN ) . '" target="_new">', '</a>', '<a href="' . esc_url( GLE_URL_WPORG_DDW ) . '" target="_new" title="DECKERWEB Genesis and WordPress Plugins ...">', '</a>' ) . '</p>';

}  // end of function ddw_gle_help_content_support_donation_rating_tips


/**
 * Create and display plugin help tab content: "Author, License".
 *
 * @since  1.0.0
 *
 * @uses   ddw_gle_plugin_get_data()
 *
 * @param  $gle_help_author_license
 *
 * @return string/HTML of help tab content.
 */
function ddw_gle_help_content_author_license() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . esc_attr( ddw_gle_plugin_get_data( 'Version' ) ) . '</small></h3>' .
			'<h4>' . __( 'Author - License', 'genesis-layout-extras' ) . '</h4>' .
			'<p>&bull; <strong>' . __( 'Author', 'genesis-layout-extras' ) . ':</strong> ' . sprintf( __( 'David Decker of %1$sdeckerweb.de%2$s and %3$sGenesisThemes%4$s', 'genesis-layout-extras' ), '<a href="http://deckerweb.de/" target="_new">', '</a>', '<a href="' . __( 'http://genesisthemes.de/en/', 'genesis-layout-extras' ). '" target="_new">', '</a>' ) . '</p>' .
			'<p>&bull; <strong>' . __( 'License', 'genesis-layout-extras' ) . ':</strong> ' . sprintf( __( 'GPLv2 or later - %1$sMore info on the GPL license ...%2$s', 'genesis-layout-extras' ), '<a href="http://www.opensource.org/licenses/gpl-license.php" target="_new" title="GPL ...">', '</a>' ) . '</p>';

}  // end of function ddw_gle_help_content_author_license


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since  1.7.0
 *
 * @uses   ddw_gle_plugin_get_data()
 *
 * @param  $gle_help_sidebar
 *
 * @return string/HTML of help sidebar content.
 */
function ddw_gle_help_sidebar_content() {

	$gle_help_sidebar = '<p><strong>' . __( 'Feedback and more about the Author', 'genesis-layout-extras' ) . '</strong></p>' .
		'<p><a href="' . __( 'http://genesisthemes.de/en/', 'genesis-layout-extras' ) . '" target="_blank" title="' . __( 'Website', 'genesis-layout-extras' ) . '">' . __( 'Website', 'genesis-layout-extras' ) . '</a> | <a href="' . esc_url( GLE_URL_WPORG_FORUM ) . '" target="_blank" title="' . __( 'Forum', 'genesis-layout-extras' ) . '">' . __( 'Forum', 'genesis-layout-extras' ) . '</a></p>' .
		'<p>' . __( 'Social:', 'genesis-layout-extras' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">' . __( 'Twitter', 'genesis-layout-extras' ) . '</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">' . __( 'Facebook', 'genesis-layout-extras' ) . '</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">' . __( 'Google+', 'genesis-layout-extras' ) . '</a> | <a href="' . esc_url( ddw_gle_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
		'<p><a href="' . esc_url( GLE_URL_WPORG_PROFILE ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters( 'gle_filter_help_sidebar_content', $gle_help_sidebar );

}  // end of function ddw_gle_help_sidebar_content