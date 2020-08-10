<?php

if (!defined('GENESIS_LANGUAGES_DIR')) {
    define('GENESIS_LANGUAGES_DIR', get_stylesheet_directory() . '/lib/languages');
}

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

define('GTHEME_NAME', 'G theme');
define('GTHEME_URL', 'https://asithemes.com/');
define('GTHEME_VERSION', '1.0.1');
define('GTHEME_CDN', get_stylesheet_directory_uri());
define('GTHEME_CDN_PATH', get_stylesheet_directory());
define('CHILD_THEME_NAME', GTHEME_NAME);
define('CHILD_THEME_VERSION', GTHEME_VERSION);

//* Add Theme Customizer settings
require_once(GTHEME_CDN_PATH . '/lib/customize.php');

//* Genesis
require_once(GTHEME_CDN_PATH . '/lib/genesis.php' );

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

//* Set sample content
function gtheme_after_setup_theme() {

    if (!get_theme_mod('gtheme_content_set', false)) {

        set_theme_mod('gtheme_frontpage_banner_image', GTHEME_CDN . '/images/default.jpg');
        set_theme_mod('gtheme_frontpage_banner_title', "Hi, I'm a <strong>Genesis<br/>Wordpress Theme</strong>");
        set_theme_mod('gtheme_frontpage_banner_subtitle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('gtheme_frontpage_banner_button_link', home_url());
        set_theme_mod('gtheme_frontpage_banner_button_text', 'Subscribe');
        set_theme_mod('gtheme_frontpage_cta_title_1', 'Service One');
        set_theme_mod('gtheme_frontpage_cta_description_1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('gtheme_frontpage_cta_link_1', '#');
        set_theme_mod('gtheme_frontpage_cta_title_2', 'Service Two');
        set_theme_mod('gtheme_frontpage_cta_description_2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('gtheme_frontpage_cta_link_2', '#');
        set_theme_mod('gtheme_frontpage_cta_title_3', 'Service Three');
        set_theme_mod('gtheme_frontpage_cta_description_3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('gtheme_frontpage_cta_link_3', '#');
        set_theme_mod('gtheme_footer_text', '[footer_copyright before="%s "]');
        set_theme_mod('gtheme_content_set', true);

        /* Create test posts */
        $wp_upload_dir = wp_upload_dir();
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $ids = array(3, 2, 1);

        foreach ($ids as $id) {
            $post_id = wp_insert_post(array(
                'post_title' => 'Lorem ipsum dolor sit amet.',
                'post_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi',
                'post_status' => 'publish'
            ));
            $filename = GTHEME_CDN_PATH . '/images/post-asithemes-g-' . $id . '.jpg';
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

add_action('after_setup_theme', 'gtheme_after_setup_theme');

//* Enqueue Scripts & Styles
function gtheme_wp_enqueue_scripts() {

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i', array(), GTHEME_VERSION);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), GTHEME_VERSION);

    wp_enqueue_script('scripts', GTHEME_CDN . '/js/scripts.js', array('jquery'), GTHEME_VERSION);
}

add_action('wp_enqueue_scripts', 'gtheme_wp_enqueue_scripts');

function gtheme_body_class($classes) {

    global $is_chrome;

    if ($is_chrome) {
        $classes[] = 'chrome';
    }

    return $classes;
}

add_filter('body_class', 'gtheme_body_class');

function gtheme_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['data-title'] = $item->title;
    return $atts;
}

add_filter('nav_menu_link_attributes', 'gtheme_nav_menu_link_attributes', 10, 4);
