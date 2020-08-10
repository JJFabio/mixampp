<?php
/**
 * This file adds the Landing template to the Seasons Pro Theme.
 *
 * @author      WPStudio
 * @subpackage  Customizations
 * @link        https://www.wpstud.io/themes
 */

/*
Template Name: Landing
*/

//* Force full width page layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add landing body class to the head
add_filter( 'body_class', 'wps_add_body_class' );
function wps_add_body_class( $classes ) {

	$classes[] = 'simple-landing';
	return $classes;

}

//* Remove site header elements
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Remove navigation
remove_action( 'genesis_header', 'genesis_do_nav', 13 );
remove_action( 'genesis_before_header', 'genesis_do_subnav' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas');

//* Remove site footer elements
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Run the Genesis loop
genesis();