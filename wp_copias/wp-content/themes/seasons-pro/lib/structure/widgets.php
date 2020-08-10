<?php

/**
 *
 * @package     Seasons Pro
 * @author      WPStudio
 * @link        https://www.wpstud.io/themes
 */

if( !defined( 'ABSPATH' ) ) exit;

//* Home widget 1
genesis_register_sidebar( array(
	'id'            => 'widget_after_header_one',
	'name'          => __( 'Home Products', 'seasons-pro' ),
	'description'   => __( 'Add Woocommerce Product widget.', 'seasons-pro' ),
	'before_title'  => '<h2 class="widget-title widgettitle">',
	'after_title'   => "</h2>\n",
) );

//* Home widget two
genesis_register_sidebar( array(
	'id'            => 'widget_after_header_two',
	'name'          => __( 'Home Testimonials', 'seasons-pro' ),
	'description'   => __( 'Add testimonials widget.', 'seasons-pro' ),
	'before_title'  => '<h2 class="widget-title widgettitle">',
	'after_title'   => "</h2>\n",
) );

//* Home widget three
genesis_register_sidebar( array(
	'id'            => 'widget_after_header_three',
	'name'          => __( 'Home Latest Posts', 'seasons-pro' ),
	'description'   => __( 'Add genesis feaured posts.', 'seasons-pro' ),
	'before_title'  => '<h2 class="widget-title widgettitle">',
	'after_title'   => "</h2>\n",
) );

//* Register webshop sidebar
genesis_register_sidebar( array(
	'id' 			=> 'woo_primary_sidebar',
    'name' 			=> __( 'Webshop Sidebar', 'genesis' ),
    'description' 	=> __( 'This is the WooCommerce webshop sidebar', 'seasons-pro' ),
) );

//* Register webshop above footer
genesis_register_sidebar( array(
	'id' 			=> 'woo_footer_widget',
    'name' 			=> __( 'Webshop Footer', 'genesis' ),
    'description' 	=> __( 'This is the Webshop footer widget', 'seasons-pro' ),
) );

//* Register webshop above footer
genesis_register_sidebar( array(
	'id' 			=> 'widget_home_four',
    'name' 			=> __( 'Home Above Footer', 'genesis' ),
    'description' 	=> __( 'This is the Webshop footer widget', 'seasons-pro' ),
) );

//* Register webshop above footer
genesis_register_sidebar( array(
	'id' 			=> 'widget_home_five',
    'name' 			=> __( 'Home CTA', 'genesis' ),
    'description' 	=> __( 'This is the Webshop footer widget', 'seasons-pro' ),
) );