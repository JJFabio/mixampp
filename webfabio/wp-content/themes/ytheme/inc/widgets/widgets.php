<?php

if (!defined('ABSPATH')) {
    exit;
}

// Include widget classes.
include_once(ASITHEME_CDN_PATH . '/inc/widgets/inc/abstract-asi-widget.php');

add_action('wp_enqueue_scripts', 'asitheme_widgets_wp_enqueue_scripts');

function asitheme_widgets_wp_enqueue_scripts() {
    wp_enqueue_style('asitheme-widgets', ASITHEME_CDN . '/assets/css/widgets.css', array(), CHILD_THEME_VERSION);
}
