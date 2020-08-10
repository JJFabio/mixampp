<?php

if (!defined('GENESIS_LANGUAGES_DIR')) {
    define('GENESIS_LANGUAGES_DIR', get_stylesheet_directory() . '/lib/languages');
}

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

define('KTHEME_NAME', 'K theme');
define('KTHEME_URL', 'https://asithemes.com/');
define('KTHEME_VERSION', '1.0.1');
define('KTHEME_CDN', get_stylesheet_directory_uri());
define('KTHEME_CDN_PATH', get_stylesheet_directory());
define('CHILD_THEME_NAME', KTHEME_NAME);
define('CHILD_THEME_VERSION', KTHEME_VERSION);

//* Add Theme Customizer settings
require_once(KTHEME_CDN_PATH . '/lib/customize.php');

//* Genesis
require_once(KTHEME_CDN_PATH . '/lib/genesis.php' );

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

//* Set sample content
function ktheme_after_setup_theme() {

    if (!get_theme_mod('ktheme_content_set', false)) {

        set_theme_mod('ktheme_frontpage_title_page', "Hi there, I'm a Genesis<br/><strong>Wordpress Theme</strong>");
        set_theme_mod('ktheme_frontpage_all_posts_text', __('Ver todos', 'ktheme'));
        set_theme_mod('ktheme_footer_text', '[footer_copyright before="%s "]');
        set_theme_mod('ktheme_content_set', true);

        /* Create test posts */
        $wp_upload_dir = wp_upload_dir();
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $ids = array(1, 2, 3, 4, 5, 6);

        foreach ($ids as $id) {
            $post_id = wp_insert_post(array(
                'post_title' => "Hi there, I'm a sexy WordPress Post",
                'post_excerpt' => 'This is an example of a WordPress post, you could edit this to put information about yourself or your site so readers know where you are coming from. ',
                'post_status' => 'publish'
            ));
            $filename = KTHEME_CDN_PATH . '/images/post-asithemes-k-' . $id . '.jpg';
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

add_action('after_setup_theme', 'ktheme_after_setup_theme');

//* Enqueue Scripts & Styles
function ktheme_wp_enqueue_scripts() {

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto+Slab:100,300,400,700', array(), KTHEME_VERSION);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), KTHEME_VERSION);

    wp_enqueue_script('scripts', KTHEME_CDN . '/js/scripts.js', array('jquery'), KTHEME_VERSION);
}

add_action('wp_enqueue_scripts', 'ktheme_wp_enqueue_scripts');

function ktheme_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['data-title'] = $item->title;
    return $atts;
}

add_filter('nav_menu_link_attributes', 'ktheme_nav_menu_link_attributes', 10, 4);
