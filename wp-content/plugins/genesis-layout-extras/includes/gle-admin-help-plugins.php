<?php
/**
 * Helper functions for the admin - help tabs for supported plugins - only if active.
 *
 * @package    Genesis Layout Extras
 * @subpackage Admin Help
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2011-2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/genesis-layout-extras/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.3.0
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
 * Add optional help tab content for supported plugins.
 *
 * @since 1.3.0
 */
function ddw_gle_admin_help_plugins() {

	echo '<h3>' . __( 'Plugin: Genesis Layout Extras', 'genesis-layout-extras' ) . ' <small>v' . esc_attr( ddw_gle_plugin_get_data( 'Version' ) ) . '</small></h3>';

		echo '<h4>' . __( 'Custom Post Types by Plugins', 'genesis-layout-extras' ) . '</h4>';

		/** Plugin: AgentPress Listings */
		if ( post_type_exists( 'listing' ) ) {

			echo '<p>AgentPress Listings' .
				'<ul>' .
					'<li>' . __( 'Listing Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Listings Features Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul></p>';

		}  // end-if APL check

		/** Plugin: Genesis Media Project */
		if ( post_type_exists( 'video' ) ) {

			echo '<p>' . __( 'Genesis Media Project', 'genesis-layout-extras' ) .
				'<ul>' .
					'<li>' . __( 'Video Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Video SlideShows Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Video Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Video Tags Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul></p>';

		}  // end-if GMP check

		/** Plugins: WooCommerce or Jigoshop */
		if ( post_type_exists( 'product' ) ) {

			echo '<p>' . __( 'WooCommerce OR Jigoshop', 'genesis-layout-extras' ) .
				'<ul>' .
					'<li>' . __( 'Product Post Type Layout - Product Categories (all)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Product Post Type Layout - Product Tags (all)', 'genesis-layout-extras' ) . '</li>' .
				'</ul></p>';

		}  // end-if CPT "product" check

		/** Plugin: Easy Digital Downloads */
		if ( post_type_exists( 'download' ) ) {

			echo '<p>' . __( 'Easy Digital Downloads', 'genesis-layout-extras' ) .
				'<ul>' .
					'<li>' . __( 'Download Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Download Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Download Tags Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul></p>';

		}  // end-if EDD check

		/** Plugin: Sugar Events Calendar */
		if ( post_type_exists( 'sc_event' ) ) {

			echo '<p>' . __( 'Sugar Events Calendar', 'genesis-layout-extras' ) .
				'<ul>' .
					'<li>' . __( 'Event Post Type Layout (archive)', 'genesis-layout-extras' ) . '</li>' .
					'<li>' . __( 'Event Categories Taxonomy Layout', 'genesis-layout-extras' ) . '</li>' .
				'</ul></p>';

		}  // end-if Sugar Events check

		/** Plugin: bbPress 2.x Forum */
		if ( class_exists( 'bbPress' ) ) {

			echo '<p>' . __( 'bbPress 2.x', 'genesis-layout-extras' ) .
				'<ul>' .
					'<li>' . __( 'bbPress 2.x Forum Layout (all areas)', 'genesis-layout-extras' ) . '</li>' .
				'</ul></p>';

		}  // end-if bbPress 2.x check

}  // end of function ddw_gle_admin_help_plugins