<?php
/**
 * Plugin Name: Genesis login modal box
 * Plugin URI: https://wpstud.io/plugins
 * Description: Login modal box
 * Version: 1.3
 * Author: Frank Schrijvers
 * Author URI: https://www.wpstud.io
 * Text Domain: wpstudio-login-modal-box
 * Domain Path: /languages
 * License: GPLv2
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Callback on the `plugins_loaded` hook.
 * Loads the plugin text domain via load_plugin_textdomain()
 *
 * @uses load_plugin_textdomain()
 * @since 1.0.0
 *
 * @access public
 * @return void
 */
function wps_load_plugin_textdomain() {

	load_plugin_textdomain( 'wpstudio-login-modal-box', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}

add_action( 'init', 'wps_load_plugin_textdomain' );


/**
 *  Enqueue scripts and styles
 */
function wps_glmb_load_scripts() {

	wp_enqueue_script( 'remodal', plugin_dir_url( __FILE__ ) . '/assets/js/remodal.js', array( 'jquery' ) );
	wp_enqueue_style( 'glmb-style', plugin_dir_url( __FILE__ ) . '/assets/css/wpstudio-glmb-style.css', array() );
	wp_enqueue_style( 'dashicons' );

}

add_action( 'wp_enqueue_scripts', 'wps_glmb_load_scripts', 99 );


/**
 * Load required files.
 */
function wps_glmb_init() {

		require dirname( __FILE__ )  . '/inc/glmb-admin.php';
		include dirname( __FILE__ ) . '/inc/glmb-frontend.php';
		new WPSTUDIO_Glmb_Settings();

}

add_action( 'genesis_setup', 'wps_glmb_init' );


/**
 * Add shortcode
 *
 * @param [type] $atts
 * @param string $content text within link.
 * @return login link
 */
function wps_glmb_shortcode( $atts, $content = null ) {

	return '<a href="#login" title="login" class="login">' . $content . '</a>';

}

add_shortcode( 'wps_login', 'wps_glmb_shortcode' );


/**
 * If username or password is wrong redirect
 *
 * @param [type] $username
 * @return void
 */
function wps_login_fail( $username ) {

	$referrer = $_SERVER['HTTP_REFERER'];

	if ( ! empty( $referrer ) && ! strstr( $referrer, 'wp-login' ) && ! strstr( $referrer, 'wp-admin' ) ) {

		$referrer = $_SERVER['HTTP_REFERER'];

		wp_redirect( home_url() . '/?#login' );

		exit;
	}
}

add_action( 'wp_login_failed', 'wps_login_fail' );
