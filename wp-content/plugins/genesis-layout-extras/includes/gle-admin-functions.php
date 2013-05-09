<?php
/**
 * Helper functions for the admin.
 *
 * @package    Genesis Layout Extras
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/genesis-layout-extras/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.7.0
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_filter( 'genesis_export_options', 'ddw_gle_export_options' );
/**
* Hook "Genesis Layout Extras" plugin into "Genesis Exporter", allowing
*    "Genesis Layout Extras" settings to be exported.
*
* @since  1.7.0
*
* @param  array $options Genesis Exporter options.
*
* @return array
*/
function ddw_gle_export_options( array $options ) {

	/** Add this plugin settings to the Genesis Exporter feature. */
	$options[ 'gle' ] = array(
		'label'          => __( 'Plugin', 'genesis-layout-extras' ) . ': ' . __( 'Genesis Layout Extras', 'genesis-layout-extras' ),
		'settings-field' => GLE_SETTINGS_FIELD
	);

	/** Return the options array for the Exporter */
	return $options;

}  // end of function ddw_gle_export_options