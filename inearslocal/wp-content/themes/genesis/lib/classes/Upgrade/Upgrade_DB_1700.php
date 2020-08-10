<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

namespace StudioPress\Genesis\Upgrade;

/**
 * Upgrade class. Called when `db_version` Genesis setting is below 1700.
 *
 * @since 3.1.0
 */
class Upgrade_DB_1700 implements Upgrade_DB_Interface {
	/**
	 * Upgrade method.
	 *
	 * @since 1.7.0
	 * @since 3.1.0 Moved to class method.
	 */
	public function upgrade() {
		global $wpdb;

		// Changing the UI. Remove old user options.
		$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE meta_key = %s OR meta_key = %s", 'meta-box-order_toplevel_page_genesis', 'meta-box-order_genesis_page_seosettings' ) );
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->usermeta SET meta_value = %s WHERE meta_key = %s OR meta_key = %s", '1', 'screen_layout_toplevel_page_genesis', 'screen_layout_genesis_page_seosettings' ) );
	}
}
