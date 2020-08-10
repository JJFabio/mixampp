<?php
/**
 * This file adds the modal box to the frontend.
 *
 * @package Genesis login modal box
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_filter( 'genesis_after_footer', 'wpstudio_glmb_add_login_form', 100 );
/**
 * Add login form.
 */
function wpstudio_glmb_add_login_form() {

	if ( genesis_get_option( 'glmb_loginurl', 'glmb-settings' ) ) {

		$login_url = genesis_get_option( 'glmb_loginurl', 'glmb-settings' );

	} elseif ( is_home() || is_404() ) {

		$login_url = '/';

	} else {

		$login_url = get_permalink();


	}

	$login_title = genesis_get_option( 'glmb_title', 'glmb-settings' );

	echo '<div class="remodal" data-remodal-id="login">';
	echo '<p class="signin-title">' . $login_title . '</p>';
	echo '<button data-remodal-action="close" class="remodal-close ion-close" aria-label="Close"></button>';

	$referrer = $_SERVER['HTTP_REFERER'];

	if ( basename( $_SERVER['REQUEST_URI'] ) == '?' ) {

		echo '<div id="login-error">';
		echo sprintf( __( 'Login failed: You have entered an incorrect Username or Password, please try again.', 'wpstudio-login-modal-box' ) );
		echo '</div>';

	}

	echo '<div class="login">';

	$args = array(
		'echo'           => true,
		'redirect'       => $login_url,
		'form_id'        => 'login',
		'label_username' => __( 'Username', 'wpstudio-login-modal-box' ),
		'label_password' => __( 'Password', 'wpstudio-login-modal-box' ),
		'label_remember' => __( 'Remember Me', 'wpstudio-login-modal-box' ),
		'label_log_in'   => __( 'Log In', 'wpstudio-login-modal-box' ),
		'id_username'    => 'log',
		'id_password'    => 'pwd',
		'id_remember'    => 'rememberme',
		'id_submit'      => 'wp-submit',
		'remember'       => true,
		'value_username' => '',
		'value_remember' => false,
	);
	wp_login_form( $args );

	echo '</div>';

	printf( '<a href="%s">' . __( 'Lost password?', 'wpstudio-login-modal-box' ) . '</a>', __( wp_lostpassword_url() ) );

	echo '</div>';

}

add_action( 'wp_logout', 'wpstudio_glmb_logout_url' );
/**
 * Redirect logout to homepage
 *
 * @return void
 */
function wpstudio_glmb_logout_url() {

	if ( genesis_get_option( 'glmb_logouturl', 'glmb-settings' ) ) {

		$logout_url = genesis_get_option( 'glmb_logouturl', 'glmb-settings' );

	} else {

		$logout_url = '/';

	}

	wp_redirect( $logout_url );

	exit();

}


add_filter( 'genesis_nav_items', 'wpstudio_add_login', 10, 2 );
add_filter( 'wp_nav_menu_items', 'wpstudio_add_login', 10, 2 );
/**
 * Add login logout button.
 *
 * @param [type] $menu
 * @param [type] $args
 * @return void
 */
function wpstudio_add_login( $menu, $args ) {

	$login_location = genesis_get_option( 'glmb_position', 'glmb-settings' );

	$args = (array) $args;

	if ( $login_location !== $args['theme_location']  )

	return $menu;

	$logout = '<li class="menu-item logout"><a href="' . wp_logout_url( home_url() ) . '" title="Logout">' . esc_html__( 'Log out', 'wpstudio-login-modal-box' ) . '</a></li>';

	if ( is_home() ) {

		$login = '<li class="menu-item login"><a href="/#login" title="Login">' . esc_html__( 'Login', 'wpstudio-login-modal-box' ) . '</a></li>';

	} else {

		$login = '<li class="menu-item login"><a href="' . get_the_permalink() . '/#login" title="Login">' . esc_html__( 'Login', 'wpstudio-login-modal-box' ) . '</a></li>';
	}

	if ( has_filter( 'wpstudio_add_logout_filter' ) ) {

		$logout = apply_filters( 'wpstudio_add_logout_filter', $logout );

	}

	if ( has_filter( 'wpstudio_add_login_filter' ) ) {

		$login = apply_filters( 'wpstudio_add_login_filter', $login );

	}

	if ( is_user_logged_in() ) {

		return $menu . $logout;

	} else {

		return $menu . $login;
	}
}
