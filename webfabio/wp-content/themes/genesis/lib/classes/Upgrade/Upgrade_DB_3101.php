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
 * Upgrade class. Called when `db_version` Genesis setting is below 3101.
 *
 * @since 3.1.2
 */
class Upgrade_DB_3101 implements Upgrade_DB_Interface {
	/**
	 * Upgrade method.
	 *
	 * @since 3.1.2
	 */
	public function upgrade() {
		$search      = [
			'© ' . date( 'Y' ),
			'&copy; ' . date( 'Y' ),
			'&#169; ' . date( 'Y' ),
			'&#x000A9; ' . date( 'Y' ),
		];
		$replace     = '[footer_copyright]';
		$footer_text = genesis_get_option( 'footer_text', null, false );

		genesis_update_settings(
			[
				'footer_text' => str_replace( $search, $replace, $footer_text ),
			]
		);
	}
}
