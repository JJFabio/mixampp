<?php

/**
 *
 * @package     Seasons Pro
 * @author      WPStudio
 * @link        https://www.wpstud.io/themes
 */

//* Loads Stylesheets
add_action( 'wp_enqueue_scripts', 'wps_load_stylesheets' );
function wps_load_stylesheets() {

 	wp_enqueue_style('google-fonts','//fonts.googleapis.com/css?family=Lato:400,500,700|Roboto:400,500,700|Work+Sans:300,500,700', array(), CHILD_THEME_VERSION );
 	wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css', array(), '4.4.0' );

}

//* Remove styling plugins
add_action('wp_enqueue_scripts','wps_remove_unwanted_css', 100);
function wps_remove_unwanted_css() {

	wp_dequeue_style( 'grid-list-layout' );
	wp_dequeue_style( 'grid-list-button' );

}

//* Loads Scripts
add_action( 'wp_enqueue_scripts', 'wps_load_scripts' );
function wps_load_scripts() {

	//* fade up
	wp_enqueue_script( 'fadeup', get_stylesheet_directory_uri() . '/js/fadeup.js', array( 'jquery' ), CHILD_THEME_VERSION );

	//* sticky navigation
	wp_enqueue_script( 'sticky-menu', get_stylesheet_directory_uri() . '/js/sticky-nav.js', array( 'jquery' ), CHILD_THEME_VERSION );

	//* Responsive Navigation
	wp_enqueue_script( 'seasons-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'seasons-pro' ),
		'subMenu'  => __( 'Menu', 'seasons-pro' ),
	);
	wp_localize_script( 'leaven-responsive-menu', 'seasonsL10n', $output );

}