<?php

/**
 *
 * @package      Seasons Pro
 * @author       WPStudio
 * @subpackage   Customizations
 * @link         https://www.wpstud.io/themes
 */

//* Theme Setup
add_action( 'after_switch_theme', 'wps_theme_settings' );
function wps_theme_settings() {

	if( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 5,
			'content_archive'           => 'full',
			'content_archive_limit'     => 140,
			'content_archive_thumbnail' => 1,
			'image_size'		   		=> 'widget-image',
			'image_alignment'			=> 'alignleft',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'full-width-content',
		) );

	} else {

		_genesis_update_settings( array(
			'blog_cat_num'              => 5,
			'content_archive'           => 'full',
			'content_archive_limit'     => 140,
			'content_archive_thumbnail' => 1,
			'image_size'		   		=> 'medium',
			'image_alignment'			=> 'alignleft',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'full-width-content',
		) );

	}

	update_option( 'posts_per_page', 5 );

}

//* Default Simple Social Icon Styles
add_filter( 'simple_social_default_styles', 'wps_default_style' );
function wps_default_style( $defaults ) {

	$args = array(

		'size'                   => 32,
		'border_radius'          => 24,
		'border_width'           => 0,
		'border_color'	         => '',
		'border_color_hover'     => '',
		'icon_color'             => '#ffffff',
		'icon_color_hover'       => '#daddde',
		'background_color_hover' => '#2C343A',
		'background_color' 		 => '#2C343A',
		'alignment'              => 'alignleft',
		'new_window'             => 1,

	);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}