<?php

/**
 *
 * @package     Seasons Pro
 * @author      WPStudio
 * @link        https://www.wpstud.io/themes/
 */

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'seasons-pro', apply_filters( 'seasons-pro', get_stylesheet_directory() . '/languages', 'seasons-pro' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support('genesis-responsive-viewport');

// Add support for structural wraps
add_theme_support('genesis-structural-wraps', array('header', 'nav', 'subnav', 'site-inner', 'footer-widgets', 'footer'));

//* Activate Shortcodes in textwidgets
add_filter( 'widget_text', 'do_shortcode' );

//* Add support for 4-column footer widgets
add_theme_support('genesis-footer-widgets', 4);

//* Declare WooCommerce Support
add_theme_support( 'genesis-connect-woocommerce' );

//* Size featured image
add_image_size( 'post-image', 980, 490, TRUE );
add_image_size('widget-image', 760, 570, TRUE );

//* Unregister default Genesis layouts
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');
genesis_unregister_layout('sidebar-content-sidebar');

//* Unregister default Genesis sidebars
unregister_sidebar('sidebar-alt');
unregister_sidebar( 'header-right' );

//* Position primary navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Position secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

//* Remove navigation header
remove_action('genesis_after_header', 'genesis_do_subnav');

//* Remove site description
add_action('get_header', 'wps_remove_header');
function wps_remove_header() {

    remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

}

//* Remove blog heading
remove_action ( 'genesis_before_loop', 'genesis_do_posts_page_heading', 10 );

//* Add screen reader class to archive description
add_filter( 'genesis_attr_author-archive-description', 'genesis_attributes_screen_reader_class' );

//* Remove blog template heading
remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading', 10 );

//* Customize the entry meta in the entry header
add_filter('genesis_post_info', 'wps_post_info_filter');
function wps_post_info_filter($post_info) {

    if ( is_singular('post') ) {

        $post_info = '[post_date][post_author_posts_link][post_categories before="Filed Under: "][post_comments]';
        return $post_info;

    }

    else {

        $post_info = '[post_date][post_author_posts_link]';
        return $post_info;

    }

}

//* Customize the author box title
add_filter( 'genesis_author_box_title', 'wps_author_box_title', 10, 2);
function wps_author_box_title( $title, $context ) {

    if ( 'single' == $context ) {

        $title = str_replace( 'About', '', $title );

    }

    return $title;

}

//* Avatar size comments
add_filter( 'genesis_comment_list_args', 'wps_avatar_size' );
function wps_avatar_size( $args ) {

    $args['avatar_size'] = 70;
    return $args;

}

//* Reduce the navigation to two level depth
add_filter( 'wp_nav_menu_args', 'wps_max_depth_primary_nav' );
function wps_max_depth_primary_nav( $args ){

    if ( 'primary' != $args['theme_location'] ) {

        return $args;

    }

    $args['depth'] = 2;
    return $args;

}

//* Customize search form input button text
add_filter( 'genesis_search_button_text', 'wps_search_button_text' );
function wps_search_button_text( $text ) {

    return esc_attr( '&#xf002;' );

}

//* Modify the Genesis content read more link
add_filter( 'excerpt_more', 'wps_read_more_link' );
add_filter( 'get_the_content_more_link', 'wps_read_more_link' );
add_filter( 'the_content_more_link', 'wps_read_more_link' );
function wps_read_more_link($more) {

    $read_more_title = sprintf( '<span class="screen-reader-text">%s %s</span>', __( 'about ', 'seasons-pro' ), get_the_title() );
    return sprintf( ' ... <a href="%s" class="more-link">%s %s</a>', get_permalink(), __( 'Continue Reading', 'seasons-pro' ), $read_more_title );

}

//* Reposition featured image on archive pages
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_before_entry', 'genesis_do_post_image', 5 );

//* Display featured image on top of the post
add_action( 'genesis_entry_header', 'wps_featured_post_image', 11 );
function wps_featured_post_image() {

  if ( ! is_singular( 'post' ) )  return;
    the_post_thumbnail('post-image');

}

//* Remove the entry footer markup + content
add_action ( 'get_header' , 'remove_post_meta_pages' );
function remove_post_meta_pages() {

    if ( is_singular('post') ) {

        return;

    }

    else {

        remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
        remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
        remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

    }

}

//* Modify breadcrumb arguments
add_filter( 'genesis_breadcrumb_args', 'wps_breadcrumb_args' );
function wps_breadcrumb_args( $args ) {

    $args['home'] = '<i class="fa fa-home"></i>';
    $args['sep'] = ' - ';
    $args['labels']['prefix'] = '';

return $args;

}

//* Reposition comments
add_action('genesis_before_loop','wps_reposition_comments');
function wps_reposition_comments() {

    if (is_singular('post')) {

        remove_action( 'genesis_after_entry', 'genesis_get_comments_template', 10 );
        add_action ( 'genesis_before_footer', 'genesis_get_comments_template', 5 );

    }

}

//* Add opening div wrapper comments
add_action( 'genesis_before_footer', 'wpstudio_add_opening_wrap', 5 );
function wpstudio_add_opening_wrap() {

    if (is_singular('post')) {

        echo '<div class="comments"> <div class="wrap">';

    }

}

//* Add closing div wrapper comments
add_action( 'genesis_after_comment_form', 'wpstudio_add_closing_wrap', 4 );
function wpstudio_add_closing_wrap() {

    if (is_singular('post')) {

        echo '</div></div>';

    }

}

//* Remove entry footer and entry meta
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


add_action( 'genesis_entry_content', 'wps_prev_next_post_nav' );
function wps_prev_next_post_nav() {

    if ( is_single() ) {

        echo '<div class="prev-next-navigation">';
        previous_post_link( '%link', 'previous post' );
        next_post_link( '%link', 'next post' );
        echo '</div>';

    }

}

//* Add extra class to content
add_filter( 'genesis_attr_content', 'wps_add_class' );
function wps_add_class( $attributes ) {

  $attributes['class'] = $attributes['class']. ' fadeup';
    return $attributes;

}

//* Shortcode for color button
add_shortcode('btn', 'wps_shortcode_btn');
function wps_shortcode_btn($atts, $content = null) {

   extract(shortcode_atts(array('link' => '#'), $atts));
   return '<a class="button" href="'.$link.'"><span>' . do_shortcode($content) . '</span></a>';

}

//* Shortcode for color button
add_shortcode('btn-light', 'wps_shortcode_btn_light');
function wps_shortcode_btn_light($atts, $content = null) {

   extract(shortcode_atts(array('link' => '#'), $atts));
   return '<a class="button-light" href="'.$link.'"><span>' . do_shortcode($content) . '</span></a>';

}

//* Shortcode for color button
add_shortcode('btn-dark', 'wps_shortcode_btn_dark');
function wps_shortcode_btn_dark($atts, $content = null) {

   extract(shortcode_atts(array('link' => '#'), $atts));
   return '<a class="button-dark" href="'.$link.'"><span>' . do_shortcode($content) . '</span></a>';

}