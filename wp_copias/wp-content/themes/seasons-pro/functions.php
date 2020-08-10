<?php

/**
 *
 * @package     Seasons Pro
 * @author      WPStudio
 * @link        https://www.wpstud.io/themes
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Seasons Pro' );
define( 'CHILD_THEME_URL', 'https://www.wpstud.io/' );
define( 'CHILD_THEME_VERSION', '1.1' );

//* Setup Theme
require_once( CHILD_DIR . '/lib/settings/theme-defaults.php');
require_once( CHILD_DIR . '/lib/settings/coloroptions.php');
require_once( CHILD_DIR . '/lib/settings/setlogo.php' );

//* Add Theme Customizer settings
require get_stylesheet_directory() . '/lib/customize.php';

//* Include Customizer CSS
require get_stylesheet_directory() . '/lib/output.php';

//* Genesis
require_once( CHILD_DIR . '/lib/genesis.php' );

//* Structure
require_once( CHILD_DIR . '/lib/structure/header.php' );
require_once( CHILD_DIR . '/lib/structure/footer.php' );
require_once( CHILD_DIR . '/lib/structure/widgets.php' );

//* WooCommerce
if ( class_exists( 'woocommerce' ) ) {
	require_once( CHILD_DIR . '/lib/woo/woo-set.php' );
}

//* Admin
require_once( CHILD_DIR . '/lib/admin/admin-branding.php' );

//* Set sample content
add_action( 'after_setup_theme', 'wps_set_sample_content' );
function wps_set_sample_content()
{

	if ( !get_theme_mod( 'wps_content_set', false ) ) {

		set_theme_mod( 'wps_hero_title_one', 'Hi, I am Seasons a multiPurpose theme' );
		set_theme_mod( 'wps_hero_text_one', '<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing</a> elit. Praesent vel interdum diam, in ultricies diam. Proin vehicula sagittis lorem, nec.</p>' );
		set_theme_mod( 'wps_hero_button1_text', 'Push me' );
		set_theme_mod( 'wps_hero_title_two', '50% Discount' );
		set_theme_mod( 'wps_hero_text_two', 'Change background, color and text with the WordPress customizer. ' );
		set_theme_mod( 'wps_hero_button2_text', 'Push me' );
		set_theme_mod( 'wps_hero_title_three', 'New collection' );
		set_theme_mod( 'wps_hero_text_three', 'Change background, color and text with the WordPress customizer.' );
		set_theme_mod( 'wps_hero_button3_text', 'Push me' );
		set_theme_mod( 'wps_cta_text_one', '<i class="fa fa-plane"></i><h3>Free shipping wordwide</h3><p>Guranteed Delivery in 3 Days</p>' );
		set_theme_mod( 'wps_cta_text_two', '<i class="fa fa-comments-o"></i><h3>24/7 Customer service</h3><p>Call us at 026-4464-920</p>' );
		set_theme_mod( 'wps_cta_text_three', '<i class="fa fa-refresh"></i><h3>Money Back Guarantee</h3><p>Send within 21 days</p>' );
		set_theme_mod( 'wps_hero_text_webshop', 'Set your subtitle true the customizer' );
		set_theme_mod( 'wps_content_set', true );

	}

}

//* Setup widget counts
function wps_count_widgets( $id ) {

	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

//* Flexible widget classes
function wps_widget_area_class( $id ) {

	$count = wps_count_widgets( $id );

	$class = '';

	if( $count == 1 ) {
		$class .= ' per-row-1';
	} elseif( $count % 2 == 0 ) {
		$class .= ' per-row-2';
	} else {
		$class .= ' per-row-3';
	}
	return $class;

}