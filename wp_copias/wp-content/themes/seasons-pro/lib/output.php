<?php
/*
 * Adds the required CSS to the front end.
 */

add_action( 'wp_head', 'wps_theme_styles' );

function wps_theme_styles() {

	$hero_image_bg_1 		= get_theme_mod( 'wps_hero_bg_1' );
	$hero_image_bg_2 		= get_theme_mod( 'wps_hero_bg_2' );
	$hero_image_bg_3 		= get_theme_mod( 'wps_hero_bg_3' );
	$hero_image_bg_shop 	= get_theme_mod( 'wps_hero_bg_shop' );
	$hero_text_color_1 		= get_theme_mod( 'wps_hero_text_color_1', '#fff' );
	$hero_text_color_2 		= get_theme_mod( 'wps_hero_text_color_2', '#fff' );
	$hero_text_color_3 		= get_theme_mod( 'wps_hero_text_color_3', '#fff' );
	$hero_color_webshop		= get_theme_mod( 'wps_hero_color_webshop', '#fff' );
	$cta_color_1			= get_theme_mod( 'wps_cta_color_one' );
	$cta_color_2			= get_theme_mod( 'wps_cta_color_two' );
	$cta_color_3			= get_theme_mod( 'wps_cta_color_three' );
	$cta_bgcolor_1			= get_theme_mod( 'wps_cta_bgcolor_one' );
	$cta_bgcolor_2			= get_theme_mod( 'wps_cta_bgcolor_two' );
	$cta_bgcolor_3			= get_theme_mod( 'wps_cta_bgcolor_three' );
	$testimonials_bg 		= get_theme_mod( 'wps_bg_testimonials' );
	$testimonials_fixed		= get_theme_mod( 'wps_testimonials_fixed' );


	echo '<style>';
	//* background hero unit 1
	echo '.fp-section-1 { background-image: ' . ( $hero_image_bg_1 ? 'url(' . $hero_image_bg_1 . ')' : 'none' ) . '}';
	//* background hero unit 2
	echo '.fp-section-2 { background-image: ' . ( $hero_image_bg_2 ? 'url(' . $hero_image_bg_2 . ')' : 'none' ) . '}';
	//* background hero unit 3
	echo '.fp-section-3 { background-image: ' . ( $hero_image_bg_3 ? 'url(' . $hero_image_bg_3 . ')' : 'none' ) . '}';
	//* background shop header
	echo '.shop-header  { background-image: ' . ( $hero_image_bg_shop ? 'url(' . $hero_image_bg_shop . ')' : 'none' ) . '}';
	//* text color hero unit 1
	echo '#front-intro .fp-section-1 .inner,  #front-intro .fp-section-1 .inner h2, #front-intro .fp-section-1 .button {color: ' . $hero_text_color_1 . '}';
	//* text color hero unit 2
	echo '#front-intro .fp-section-2 .inner,  #front-intro .fp-section-2 .inner h2, #front-intro .fp-section-2 .button {color: ' . $hero_text_color_2 . '}';
	//* text color hero unit 3
	echo '#front-intro .fp-section-3 .inner,  #front-intro .fp-section-3 .inner h2, #front-intro .fp-section-3 .button {color: ' . $hero_text_color_3 . '}';
	//* text color hero unit webshop
	echo '.shop-header .inner h1, .shop-header .inner .text {color: ' . $hero_color_webshop . '}';
	//* color cta box one
	echo '#front-intro .fp-section-4 h3, #front-intro .fp-section-4 p {color: ' . $cta_color_1 . '}';
	//*  color cta box two
	echo '#front-intro .fp-section-5 h3, #front-intro .fp-section-5 p {color: ' . $cta_color_2 . '}';
	//*  color cta box three
	echo '#front-intro .fp-section-6 h3, #front-intro .fp-section-6 p {color: ' . $cta_color_3 . '}';
	//* background color cta box one
	echo '#front-intro .fp-section-4 {background: ' . $cta_bgcolor_1 . '}';
	//* background color cta box two
	echo '#front-intro .fp-section-5 {background: ' . $cta_bgcolor_2 . '}';
	//* background color cta box three
	echo '#front-intro .fp-section-6 {background: ' . $cta_bgcolor_3 . '}';
	//* background testimonials
	echo '#front-section-3 { background-image: ' . ( $testimonials_bg  ? 'url(' . $testimonials_bg  . ')' : 'none' ) . '}';

	if  ( $testimonials_fixed  == 'yes') {
		echo '#front-section-3 { background-attachment: fixed';
	}
	echo '</style>';
}