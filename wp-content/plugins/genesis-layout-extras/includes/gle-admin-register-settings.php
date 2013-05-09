<?php
/**
 * Plugin register settings & sanitize.
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


/**
 * Return the defaults array for all setting options.
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_defaults() {

	$options = array(
		'ddw_genesis_layout_home'                         => '',
		'ddw_genesis_layout_search'                       => '',
		'ddw_genesis_layout_search_not_found'             => '',
		'ddw_genesis_layout_404'                          => '',
		'ddw_genesis_layout_post'                         => '',
		'ddw_genesis_layout_page'                         => '',
		'ddw_genesis_layout_attachment'                   => '',
		'ddw_genesis_layout_author'                       => '',
		'ddw_genesis_layout_date'                         => '',
		'ddw_genesis_layout_date_year'                    => '',
		'ddw_genesis_layout_date_month'                   => '',
		'ddw_genesis_layout_date_day'                     => '',
		'ddw_genesis_layout_category'                     => '',
		'ddw_genesis_layout_tag'                          => '',
		'ddw_genesis_layout_taxonomy'                     => '',
		'ddw_genesis_layout_cpt_apl_listing'              => '',
		'ddw_genesis_layout_cpt_apl_features'             => '',
		'ddw_genesis_layout_cpt_gmp_video'                => '',
		'ddw_genesis_layout_cpt_gmp_video_slideshow'      => '',
		'ddw_genesis_layout_cpt_gmp_video_category'       => '',
		'ddw_genesis_layout_cpt_gmp_video_tag'            => '',
		'ddw_genesis_layout_cpt_wcjs_product_cat'         => '',
		'ddw_genesis_layout_cpt_wcjs_product_tag'         => '',
		'ddw_genesis_layout_cpt_edd_download'             => '',
		'ddw_genesis_layout_cpt_edd_download_category'    => '',
		'ddw_genesis_layout_cpt_edd_download_tag'         => '',
		'ddw_genesis_layout_cpt_sc_event'                 => '',
		'ddw_genesis_layout_cpt_sc_event_category'        => '',
		'ddw_genesis_layout_bbpress'                      => '',
		'ddw_genesis_layout_bbpress_topics'               => '',
		'ddw_genesis_layout_cpt_child_portfolio'          => '',
		'ddw_genesis_layout_cpt_child_portfolio_category' => '',
		'ddw_genesis_layout_cpt_themedy_products'         => '',
		'ddw_genesis_layout_cpt_themedy_product_category' => '',
		'ddw_genesis_layout_cpt_themedy_photo_gallery'    => ''
	);

	return apply_filters( 'ddw_genesis_layout_extras_settings_defaults', $options );

}  // end of function ddw_genesis_layout_extras_defaults


add_action( 'genesis_settings_sanitizer_init', 'ddw_genesis_layout_extras_sanitization' );
/**
 * Add all settings to Genesis sanitization - for security.
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_sanitization() {

	genesis_add_option_filter( 'no_html', GLE_SETTINGS_FIELD,
		array(
			'ddw_genesis_layout_home',
			'ddw_genesis_layout_search',
			'ddw_genesis_layout_search_not_found',
			'ddw_genesis_layout_404',
			'ddw_genesis_layout_post',
			'ddw_genesis_layout_page',
			'ddw_genesis_layout_attachment',
			'ddw_genesis_layout_author',
			'ddw_genesis_layout_date',
			'ddw_genesis_layout_date_year',
			'ddw_genesis_layout_date_month',
			'ddw_genesis_layout_date_day',
			'ddw_genesis_layout_category',
			'ddw_genesis_layout_tag',
			'ddw_genesis_layout_taxonomy',
			'ddw_genesis_layout_cpt_apl_listing',
			'ddw_genesis_layout_cpt_apl_features',
			'ddw_genesis_layout_cpt_gmp_video',
			'ddw_genesis_layout_cpt_gmp_slideshow',
			'ddw_genesis_layout_cpt_gmp_video_category',
			'ddw_genesis_layout_cpt_gmp_video_tag',
			'ddw_genesis_layout_cpt_wcjs_product_cat',
			'ddw_genesis_layout_cpt_wcjs_product_tag',
			'ddw_genesis_layout_cpt_edd_download',
			'ddw_genesis_layout_cpt_edd_download_category',
			'ddw_genesis_layout_cpt_edd_download_tag',
			'ddw_genesis_layout_cpt_sc_event',
			'ddw_genesis_layout_cpt_sc_event_category',
			'ddw_genesis_layout_bbpress',
			'ddw_genesis_layout_bbpress_topics',
			'ddw_genesis_layout_cpt_child_portfolio',
			'ddw_genesis_layout_cpt_child_portfolio_category',
			'ddw_genesis_layout_cpt_themedy_products',
			'ddw_genesis_layout_cpt_themedy_product_category',
			'ddw_genesis_layout_cpt_themedy_photo_gallery'
		) );

}  // end of function ddw_genesis_layout_extras_sanitization


add_action( 'admin_init', 'ddw_genesis_layout_extras_register_settings' );
/**
 * Register the settings field for the plugin.
 *
 * @since 1.0.0
 */
function ddw_genesis_layout_extras_register_settings() {

	/** Register settings field */
	register_setting( GLE_SETTINGS_FIELD, GLE_SETTINGS_FIELD );

	/** Add the defaults to this settings field */
	add_option( GLE_SETTINGS_FIELD, ddw_genesis_layout_extras_defaults() );
 
	/** Add Reset functionality to settings field */
	if ( function_exists ( 'genesis_get_option' ) && genesis_get_option( 'reset', GLE_SETTINGS_FIELD ) ) {

		update_option( GLE_SETTINGS_FIELD, ddw_genesis_layout_extras_defaults() );

		genesis_admin_redirect( 'gle-layout-extras', array( 'reset' => 'true' ) );

		exit;

	}

}  // end of function ddw_genesis_layout_extras_register_settings