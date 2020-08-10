<?php

if (!defined('GENESIS_LANGUAGES_DIR')) {
    define('GENESIS_LANGUAGES_DIR', get_stylesheet_directory() . '/lib/languages');
}

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

define('HTHEME_NAME', 'H theme');
define('HTHEME_URL', 'https://asithemes.com/');
define('HTHEME_VERSION', '1.0.1');
define('HTHEME_CDN', get_stylesheet_directory_uri());
define('HTHEME_CDN_PATH', get_stylesheet_directory());
define('CHILD_THEME_NAME', HTHEME_NAME);
define('CHILD_THEME_VERSION', HTHEME_VERSION);

//* Add Theme Customizer settings
require_once(HTHEME_CDN_PATH . '/lib/customize.php');

//* Genesis
require_once(HTHEME_CDN_PATH . '/lib/genesis.php' );

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

//* Set sample content
function htheme_after_setup_theme() {

    if (!get_theme_mod('htheme_content_set', false)) {

        set_theme_mod('htheme_frontpage_title_page', "Hi there, I'm a <strong>Genesis<br/>Wordpress Theme</strong>");
        set_theme_mod('htheme_frontpage_paragraph_page', 'This is an example of a WordPress post, you could edit this to put information about yourself or your site so readers.');
        set_theme_mod('htheme_frontpage_button_text', 'Join us');
        set_theme_mod('htheme_frontpage_button_link', home_url('/'));
        set_theme_mod('htheme_frontpage_all_posts_text', 'All posts');
        set_theme_mod('htheme_footer_text', '[footer_copyright before="%s "]');
        set_theme_mod('htheme_content_set', true);

        /* Create test posts */
        $wp_upload_dir = wp_upload_dir();
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $ids = array(1,2,3);

        foreach ($ids as $id) {
            $post_id = wp_insert_post(array(
                'post_title' => 'Sample Post',
                'post_excerpt' => 'This is an example of a WordPress post, you could edit this to put information about yourself or your site so readers know where you are coming from. ',
                'post_status' => 'publish'
            ));
            $filename = HTHEME_CDN_PATH . '/images/post-asithemes-c-' . $id . '.jpg';
            $filename_upload = $wp_upload_dir['url'] . '/' . basename($filename);
            $filename_upload_path = $wp_upload_dir['path'] . '/' . basename($filename);
            copy($filename, $filename_upload_path);
            $filetype = wp_check_filetype(basename($filename), null);
            $attachment = array(
                'guid' => $filename_upload,
                'post_mime_type' => $filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment($attachment, $filename_upload_path, $post_id);
            $attach_data = wp_generate_attachment_metadata($attach_id, $filename_upload_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            set_post_thumbnail($post_id, $attach_id);
        }
    }
}

add_action('after_setup_theme', 'htheme_after_setup_theme');

//* Enqueue Scripts & Styles
function htheme_wp_enqueue_scripts() {

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i', array(), HTHEME_VERSION);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), HTHEME_VERSION);

    wp_enqueue_script('scripts', HTHEME_CDN . '/js/scripts.js', array('jquery'), HTHEME_VERSION);
}

add_action('wp_enqueue_scripts', 'htheme_wp_enqueue_scripts');

function htheme_body_class($classes) {

    global $is_chrome;

    if ($is_chrome) {
        $classes[] = 'chrome';
    }

    if (is_home() || is_author() || is_archive() || is_search()) {
        $classes[] = 'blog-style';
    }

    return $classes;
}

add_filter('body_class', 'htheme_body_class');

function htheme_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['data-title'] = $item->title;
    return $atts;
}

add_filter('nav_menu_link_attributes', 'htheme_nav_menu_link_attributes', 10, 4);
