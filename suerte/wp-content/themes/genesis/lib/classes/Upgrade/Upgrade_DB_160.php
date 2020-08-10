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
 * Upgrade class. Called when `db_version` Genesis setting is below 160.
 *
 * @since 3.1.0
 */
class Upgrade_DB_160 implements Upgrade_DB_Interface {
	/**
	 * Upgrade method.
	 *
	 * @since 1.6.0
	 * @since 3.1.0 Moved to class method.
	 */
	public function upgrade() {
		// Vestige nav settings, for backward compatibility.
		if ( 'nav-menu' !== genesis_get_option( 'nav_type' ) ) {
			_genesis_vestige(
				[
					'nav_type',
					'nav_superfish',
					'nav_home',
					'nav_pages_sort',
					'nav_categories_sort',
					'nav_depth',
					'nav_exclude',
					'nav_include',
				]
			);
		}

		// Vestige subnav settings, for backward compatibility.
		if ( 'nav-menu' !== genesis_get_option( 'subnav_type' ) ) {
			_genesis_vestige(
				[
					'subnav_type',
					'subnav_superfish',
					'subnav_home',
					'subnav_pages_sort',
					'subnav_categories_sort',
					'subnav_depth',
					'subnav_exclude',
					'subnav_include',
				]
			);
		}
	}
}
