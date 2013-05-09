<?php
/**
 * Layout logic for the frontend display.
 *
 * @package    Genesis Layout Extras
 * @subpackage Frontend
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


add_filter( 'genesis_pre_get_option_site_layout', 'ddw_genesis_layout_extras_filter', 101 );
/**
 * Manage Genesis layouts for extra sections
 *
 * @since  1.0.0
 *
 * @uses   filter: genesis_pre_get_option_site_layout
 *
 * @param  $opt
 *
 * @global mixed $wp_query
 *
 * @return string Genesis layout option
 */
function ddw_genesis_layout_extras_filter( $opt ) {

	global $wp_query;

	/** Homepage / Front Page */
	if ( ( is_home() || is_front_page() ) && genesis_get_option( 'ddw_genesis_layout_home', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_home', GLE_SETTINGS_FIELD );

	/** Search (has results!) */
	elseif ( ( is_search() && ! empty( $wp_query->posts ) ) && genesis_get_option( 'ddw_genesis_layout_search', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_search', GLE_SETTINGS_FIELD );

	/** Search not found (no results!) */
	elseif ( ( is_search() && empty( $wp_query->posts ) ) && genesis_get_option( 'ddw_genesis_layout_search_not_found', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_search_not_found', GLE_SETTINGS_FIELD );

	/** 404 Error */
	elseif ( is_404() && genesis_get_option( 'ddw_genesis_layout_404', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_404', GLE_SETTINGS_FIELD );

	/** Date (general) */
	elseif ( is_date() && genesis_get_option( 'ddw_genesis_layout_date', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_date', GLE_SETTINGS_FIELD );

	/** Date: year */
	elseif ( is_year() && genesis_get_option( 'ddw_genesis_layout_date_year', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_date_year', GLE_SETTINGS_FIELD );

	/** Date: month */
	elseif ( is_month() && genesis_get_option( 'ddw_genesis_layout_date_month', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_date_month', GLE_SETTINGS_FIELD );

	/** Date: day */
	elseif ( is_day() && genesis_get_option( 'ddw_genesis_layout_date_day', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_date_day', GLE_SETTINGS_FIELD );

	/** Author */
	elseif ( is_author() && genesis_get_option( 'ddw_genesis_layout_author', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_author', GLE_SETTINGS_FIELD );

	/** Category (all!) */
	elseif ( is_category() && genesis_get_option( 'ddw_genesis_layout_category', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_category', GLE_SETTINGS_FIELD );

	/** Tag (all!) */
	elseif ( is_tag() && genesis_get_option( 'ddw_genesis_layout_tag', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_tag', GLE_SETTINGS_FIELD );

	/**
	 * Taxonomy (all, general)
	 * Exceptions, because extra setup via extra settings:
	 *    features, slideshow, video-category, video-tag, product_cat, product_tag, product-category, galleries
	 */
	elseif ( is_tax() && ! ( is_tax( array( 'features', 'product_cat', 'product_tag', 'slideshow', 'video-category', 'video-tag', 'product-category', 'galleries' ) ) ) && genesis_get_option( 'ddw_genesis_layout_taxonomy', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_taxonomy', GLE_SETTINGS_FIELD );

	/** Posts (all!) */
	elseif ( is_singular( 'post' ) && genesis_get_option( 'ddw_genesis_layout_post', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_post', GLE_SETTINGS_FIELD );

	/** Pages (all!) */
	elseif ( is_singular( 'page' ) && genesis_get_option( 'ddw_genesis_layout_page', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_page', GLE_SETTINGS_FIELD );

	/** Attachment (all!) */
	elseif ( is_attachment() && genesis_get_option( 'ddw_genesis_layout_attachment', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_attachment', GLE_SETTINGS_FIELD );

	/** CPT: "Listing" (by APL plugin) */
	elseif ( is_post_type_archive( 'listing' ) && genesis_get_option( 'ddw_genesis_layout_cpt_apl_listing', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_apl_listing', GLE_SETTINGS_FIELD );

	/** CPT: "Listing" - Tax: "Features" (by APL plugin) */
	elseif ( is_tax( 'features' ) && genesis_get_option( 'ddw_genesis_layout_cpt_apl_features', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_apl_features', GLE_SETTINGS_FIELD );

	/** CPT: "Video" (by GMP plugin) */
	elseif ( is_post_type_archive( 'video' ) && genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video', GLE_SETTINGS_FIELD );

	/** CPT: "Video" - Tax: "SlideShow" (by GMP plugin) */
	elseif ( is_tax( 'slideshow' ) && genesis_get_option( 'ddw_genesis_layout_cpt_gmp_slideshow', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_slideshow', GLE_SETTINGS_FIELD );

	/** CPT: "Video" - Tax: "Video Category" (by GMP plugin) */
	elseif ( is_tax( 'video-category' ) && genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_category', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_category', GLE_SETTINGS_FIELD );

	/** CPT: "Video" - Tax: "Video Tag" (by GMP plugin) */
	elseif ( is_tax( 'video-tag' ) && genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_tag', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_gmp_video_tag', GLE_SETTINGS_FIELD );

	/** CPT: "Product" (by WooCommerce & Jigoshop plugins) */
	elseif ( is_tax( 'product_cat' ) && genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_cat', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_cat', GLE_SETTINGS_FIELD );

	elseif ( is_tax( 'product_tag' ) && genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_tag', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_wcjs_product_tag', GLE_SETTINGS_FIELD );

	/** CPT: "Download" (by Easy Digital Downloads plugin) */
	elseif ( is_post_type_archive( 'download' ) && genesis_get_option( 'ddw_genesis_layout_cpt_edd_download', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_edd_download', GLE_SETTINGS_FIELD );

	/** CPT: "Download" - Tax: "Download Category" (by Easy Digital Downloads plugin) */
	elseif ( is_tax( 'download_category' ) && genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_category', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_category', GLE_SETTINGS_FIELD );

	/** CPT: "Download" - Tax: "Download Tag" (by Easy Digital Downloads plugin) */
	elseif ( is_tax( 'download_tag' ) && genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_tag', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_edd_download_tag', GLE_SETTINGS_FIELD );

	/** CPT: "SC_Event" (by Sugar Events Calendar plugin) */
	elseif ( is_post_type_archive( 'sc_event' ) && genesis_get_option( 'ddw_genesis_layout_cpt_sc_event', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_sc_event', GLE_SETTINGS_FIELD );

	/** CPT: "SC_Event" - Tax: "Event Category" (by Sugar Events Calendar plugin) */
	elseif ( is_tax( 'sc_event_category' ) && genesis_get_option( 'ddw_genesis_layout_cpt_sc_event_category', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_sc_event_category', GLE_SETTINGS_FIELD );

	/** CPT: "Portfolio" (by various child themes) */
	elseif ( is_post_type_archive( 'portfolio' ) && genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio', GLE_SETTINGS_FIELD );

	/** CPT: "Portfolio" - Tax: "Portfolio Category" (by various child themes) */
	elseif ( is_tax( 'portfolio_category' ) && genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio_category', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_child_portfolio_category', GLE_SETTINGS_FIELD );

	/** CPT: "Products" (by Themedy Child Themes) */
	elseif ( is_post_type_archive( 'products' ) && genesis_get_option( 'ddw_genesis_layout_cpt_themedy_products', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_themedy_products', GLE_SETTINGS_FIELD );

	/** CPT: "Products" - Tax: "Product Category" (by Themedy Child Themes) */
	elseif ( is_tax( 'product-category' ) && genesis_get_option( 'ddw_genesis_layout_cpt_themedy_product_category', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_themedy_product_category', GLE_SETTINGS_FIELD );

	/** CPT: "Photo" - Tax: "Photo Gallery" (by Themedy Child Themes) */
	elseif ( is_tax( 'galleries' ) && genesis_get_option( 'ddw_genesis_layout_cpt_themedy_photo_gallery', GLE_SETTINGS_FIELD ) )
		$opt = genesis_get_option( 'ddw_genesis_layout_cpt_themedy_photo_gallery', GLE_SETTINGS_FIELD );

	/** Finally, output the layout(s) */
	return $opt;

}  // end of function ddw_genesis_layout_extras_filter


add_filter( 'bbp_genesis_force_full_content_width', 'ddw_genesis_layout_extras_bbpress_filter', 101 );
add_filter( 'bbp_genesis_layout', 'ddw_genesis_layout_extras_bbpress_filter' );
/**
 * Manage Genesis layouts for bbPress 2.x Forum section.
 *
 * @since  1.0.0
 *
 * @uses   filter: bbp_genesis_force_full_content_width
 * @uses   filter: bbp_genesis_layout
 * @uses   is_bbpress()
 * @uses   genesis_get_option()
 *
 * @param  $opt
 *
 * @return string Genesis layout option.
 */
function ddw_genesis_layout_extras_bbpress_filter( $opt ) {

	/** CPT: all bbPress 2.x post types */
	if ( is_bbpress() && genesis_get_option( 'ddw_genesis_layout_bbpress', GLE_SETTINGS_FIELD ) ) {

		$opt = genesis_get_option( 'ddw_genesis_layout_bbpress', GLE_SETTINGS_FIELD );

	}  // end-if bbPress & option check

	/** Output bbPress Forums layout */
	return $opt;

}  // end of function ddw_genesis_layout_extras_bbpress_filter


add_filter( 'bbp_genesis_force_full_content_width', 'ddw_genesis_layout_extras_bbpress_topics_filter', 101 );
add_filter( 'bbp_genesis_layout', 'ddw_genesis_layout_extras_bbpress_topics_filter' );
/**
 * Manage Genesis layouts for bbPress 2.x forum Topics.
 *
 * @since  1.7.0
 *
 * @uses   filter: bbp_genesis_force_full_content_width
 * @uses   filter: bbp_genesis_layout
 * @uses   get_post_type()
 * @uses   is_bbpress()
 * @uses   genesis_get_option()
 *
 * @param  $opt
 *
 * @return string Genesis layout option.
 */
function ddw_genesis_layout_extras_bbpress_topics_filter() {

	/** CPT: all bbPress 2.x post types */
	if ( ( 'topic' == get_post_type() && is_bbpress() )
		&& genesis_get_option( 'ddw_genesis_layout_bbpress_topics', GLE_SETTINGS_FIELD )
	) {

		$opt = genesis_get_option( 'ddw_genesis_layout_bbpress_topics', GLE_SETTINGS_FIELD );

	}  // end-if bbPress & topics plus option check

	/** Output bbPress topics layout */
	return $opt;

}  // end of function ddw_genesis_layout_extras_bbpress_topics_filter