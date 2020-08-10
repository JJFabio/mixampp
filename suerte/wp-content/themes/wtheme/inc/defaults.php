<?php

$defaults = array(
    ASITHEME_SLUG . '_button_color' => '#fff',
    ASITHEME_SLUG . '_button_background' => '#84c0ac',
    ASITHEME_SLUG . '_button_border_color' => '#84c0ac',
    ASITHEME_SLUG . '_button_color_hover' => '#fff',
    ASITHEME_SLUG . '_button_background_hover' => '#67966c',
    ASITHEME_SLUG . '_button_border_color_hover' => '#67966c',
    ASITHEME_SLUG . '_link_color' => '#000',
    ASITHEME_SLUG . '_footer_text' => '[footer_copyright]',
    ASITHEME_SLUG . '_footer_menu' => '',
    ASITHEME_SLUG . '_header_position' => 'relative',
    ASITHEME_SLUG . '_header_transparency' => 100,
    ASITHEME_SLUG . '_font' => 'Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
    ASITHEME_SLUG . '_font_headings' => 'Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
    ASITHEME_SLUG . '_social_footer' => false,
    ASITHEME_SLUG . '_button_border_width' => 1,
    ASITHEME_SLUG . '_header_search' => true,
    ASITHEME_SLUG . '_header_background' => '#f9f7f4',
    ASITHEME_SLUG . '_woocommerce_buy_button_text' => __('Buy', ASITHEME_SLUG),
);

define('CHILD_THEME_DEFAULTS', $defaults);

$defaults_networks = array(
    'Facebook' => 'facebook',
    'Twitter' => 'twitter',
    'Instagram' => 'instagram',
    'Pinterest' => 'pinterest',
    'Google plus' => 'google_plus',
    'Flickr' => 'flickr',
    'Linkedin' => 'linkedin',
    'Skype' => 'skype',
    'TripAdvisor' => 'tripadvisor',
    'Tumblr' => 'tumblr',
    'Vimeo' => 'vimeo',
    'YouTube' => 'youtube',
    'Spotify' => 'spotify'
);

define('CHILD_THEME_DEFAULTS_NETWORKS', $defaults_networks);