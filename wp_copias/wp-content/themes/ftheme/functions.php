<?php

if (!defined('GENESIS_LANGUAGES_DIR')) {
    define('GENESIS_LANGUAGES_DIR', get_stylesheet_directory() . '/lib/languages');
}

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

define('FTHEME_NAME', 'F theme');
define('FTHEME_URL', 'https://asithemes.com/');
define('FTHEME_VERSION', '1.0.2');
define('FTHEME_CDN', get_stylesheet_directory_uri());
define('FTHEME_CDN_PATH', get_stylesheet_directory());
define('CHILD_THEME_NAME', FTHEME_NAME);
define('CHILD_THEME_VERSION', FTHEME_VERSION);

//* Add Theme Customizer settings
require_once(FTHEME_CDN_PATH . '/lib/customize.php');

//* Genesis
require_once(FTHEME_CDN_PATH . '/lib/genesis.php' );

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

//* Set sample content
function ftheme_after_setup_theme() {

    if (!get_theme_mod('ftheme_content_set', false)) {

        set_theme_mod('ftheme_frontpage_title_page', "<strong>Genesis WordPress</strong><br>Theme for Podcasters");
        set_theme_mod('ftheme_footer_text', '[footer_copyright before="%s "]');
        set_theme_mod('ftheme_content_set', true);
        
        /* Create test posts */
        $wp_upload_dir = wp_upload_dir();
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $ids = array(1, 2, 3);
        $textos = array('Primero', 'Segundo', 'Tercero');

        $i = 0;
        foreach ($ids as $id) {
            $post_id = wp_insert_post(array(
                'post_title' => $id . ". Episodio " . $textos[$i],
                'post_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed maximus ullamcorper facilisis. Duis eget leo scelerisque, ultricies turpis ut, aliquam nulla. Cras tempus feugiat elit.',
                'post_status' => 'publish'
            ));
            $filename = FTHEME_CDN_PATH . '/images/post-asithemes-f-' . $id . '.jpg';
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
            $i++;
        }
    }
}

add_action('after_setup_theme', 'ftheme_after_setup_theme');

function ftheme_body_class($classes) {

    global $is_chrome;

    if ($is_chrome)
        $classes[] = 'chrome';

    return $classes;
}

add_filter('body_class', 'ftheme_body_class');

function ftheme_be_ajax_load_more() {

    check_ajax_referer('be-load-more-nonce', 'nonce');

    $page = esc_attr($_POST['page']);
    $posts_per_page = genesis_get_option('blog_cat_num');
    $offset = ($posts_per_page * $page) - 1;
    $num_actual = $offset + 1;

    $args = array(
        'post_type' => 'post',
        'paged' => $page,
        'posts_per_page' => $posts_per_page
    );

    if (isset($_POST['query'])) {

        if (isset($_POST['query']['author_name'])) {
            $args['author_name'] = $_POST['query']['author_name'];
        }
        if (isset($_POST['query']['category_name'])) {
            $args['category_name'] = $_POST['query']['category_name'];
        }
    }

    $args_total = $args;
    $args_total['posts_per_page'] = -1;

    $total = count(get_posts($args_total));

    ob_start();

    ftheme_genesis_filters_actions_loop();

    genesis_custom_loop(wp_parse_args($args));

    if ($num_actual < $total) {
        ftheme_genesis_after_loop();
    }

    wp_reset_postdata();
    $data = ob_get_clean();
    wp_send_json_success($data);
    wp_die();
}

add_action('wp_ajax_be_ajax_load_more', 'ftheme_be_ajax_load_more');
add_action('wp_ajax_nopriv_be_ajax_load_more', 'ftheme_be_ajax_load_more');

function ftheme_genesis_noposts_text() {
    return __('No hay más entradas', 'ftheme');
}

add_action('genesis_noposts_text', 'ftheme_genesis_noposts_text');

function ftheme_pre_get_posts($query) {

    if (is_front_page() || is_category() || is_author()) {
        $query->set('posts_per_page', genesis_get_option('blog_cat_num'));
    }
}

add_action('pre_get_posts', 'ftheme_pre_get_posts');

//* Enqueue Scripts & Styles
function ftheme_wp_enqueue_scripts() {

    global $wp_query;

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i', array(), FTHEME_VERSION);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), FTHEME_VERSION);

    wp_enqueue_script('scripts', FTHEME_CDN . '/js/scripts.js', array('jquery'), FTHEME_VERSION);

    $args = array(
        'nonce' => wp_create_nonce('be-load-more-nonce'),
        'url' => admin_url('admin-ajax.php'),
        'query' => $wp_query->query
    );

    wp_localize_script('scripts', 'beloadmore', $args);
}

add_action('wp_enqueue_scripts', 'ftheme_wp_enqueue_scripts');

function ftheme_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['data-title'] = $item->title;
    return $atts;
}

add_filter('nav_menu_link_attributes', 'ftheme_nav_menu_link_attributes', 10, 4);
