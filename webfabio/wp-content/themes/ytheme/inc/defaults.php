<?php

$defaults = array(
    ASITHEME_SLUG . '_button_color' => '#30445C',
    ASITHEME_SLUG . '_button_background' => '',
    ASITHEME_SLUG . '_button_border_color' => '#30445C',
    ASITHEME_SLUG . '_button_color_hover' => '#fff',
    ASITHEME_SLUG . '_button_background_hover' => '#30445C',
    ASITHEME_SLUG . '_button_border_color_hover' => '#30445C',
    ASITHEME_SLUG . '_link_color' => '#30445C',
    ASITHEME_SLUG . '_header_position' => 'relative',
    ASITHEME_SLUG . '_header_transparency' => 100,
    ASITHEME_SLUG . '_font' => 'Karla:400,400i,700,700i',
    ASITHEME_SLUG . '_font_headings' => 'Karla:400,400i,700,700i',
    ASITHEME_SLUG . '_social_footer' => false,
    ASITHEME_SLUG . '_button_border_width' => 1,
    ASITHEME_SLUG . '_woocommerce_buy_button_text' => __('Buy', ASITHEME_SLUG)
);

define('CHILD_THEME_DEFAULTS', $defaults);

$defaults_networks = array(
    'Facebook' => 'facebook_f',
    'Twitter' => 'twitter',
    'Instagram' => 'instagram',
    'Pinterest' => 'pinterest',
    'Flickr' => 'flickr',
    'Linkedin' => 'linkedin_in',
    'Skype' => 'skype',
    'TripAdvisor' => 'tripadvisor',
    'Tumblr' => 'tumblr',
    'Vimeo' => 'vimeo_v',
    'YouTube' => 'youtube',
    'Spotify' => 'spotify'
);

define('CHILD_THEME_DEFAULTS_NETWORKS', $defaults_networks);