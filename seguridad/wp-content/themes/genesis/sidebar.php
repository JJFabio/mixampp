<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/genesis/
 */

// Output primary sidebar structure.
genesis_markup( array(
	'open'    => '<aside %s>' . genesis_sidebar_title( 'sidebar' ),
	'context' => 'sidebar-primary',
) );

/**
 * Fires immediately after the Primary Sidebar opening markup.
 *
 * @since ???
 */
do_action( 'genesis_before_sidebar_widget_area' );

/**
 * Fires to display the main Primary Sidebar content.
 *
 * @since ???
 */
do_action( 'genesis_sidebar' );

/**
 * Fires immediately before the Primary Sidebar closing markup.
 *
 * @since ???
 */
do_action( 'genesis_after_sidebar_widget_area' );

// End .sidebar-primary.
genesis_markup( array(
	'close'   => '</aside>',
	'context' => 'sidebar-primary',
) );