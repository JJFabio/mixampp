<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

define('ITHEME_NAME', 'I Theme');
define('ITHEME_URL', 'https://asithemes.com/');
define('ITHEME_VERSION', '1.0.4');
define('ITHEME_CDN', get_stylesheet_directory_uri());
define('ITHEME_CDN_PATH', get_stylesheet_directory());
define('CHILD_THEME_NAME', ITHEME_NAME);
define('CHILD_THEME_VERSION', ITHEME_VERSION);

//* Add Theme Customizer settings
require_once(ITHEME_CDN_PATH . '/lib/customize.php');

//* Genesis
require_once(ITHEME_CDN_PATH . '/lib/genesis.php' );

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

//* Set sample content
function itheme_after_setup_theme() {

    load_theme_textdomain('itheme', ITHEME_CDN_PATH . '/lib/languages');

    if (!get_theme_mod('itheme_content_set', false)) {

        set_theme_mod('itheme_frontpage_banner_image', ITHEME_CDN . '/images/default.jpg');
        set_theme_mod('itheme_frontpage_banner_title', "Hi there, I'm a Genesis<br/><strong>Wordpress Theme</strong>");
        set_theme_mod('itheme_frontpage_banner_title_color', '#ffffff');
        set_theme_mod('itheme_frontpage_banner_button_link', home_url());
        set_theme_mod('itheme_frontpage_banner_button_text', 'Join us');
        set_theme_mod('itheme_frontpage_all_posts_text', 'Ver todos');
        set_theme_mod('itheme_frontpage_num_posts', 2);
        set_theme_mod('itheme_button_color', '#ffffff');
        set_theme_mod('itheme_button_background', '#ffb11b');
        set_theme_mod('itheme_link_color', '#ffb11b');
        set_theme_mod('itheme_frontpage_cta_image_1', ITHEME_CDN . '/images/icon-a.png');
        set_theme_mod('itheme_frontpage_cta_text_1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('itheme_frontpage_cta_image_2', ITHEME_CDN . '/images/icon-b.png');
        set_theme_mod('itheme_frontpage_cta_text_2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('itheme_frontpage_cta_image_3', ITHEME_CDN . '/images/icon-c.png');
        set_theme_mod('itheme_frontpage_cta_text_3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.');
        set_theme_mod('itheme_footer_text', '[footer_copyright before="%s "]');
        set_theme_mod('itheme_header_position', 'relative');
        set_theme_mod('itheme_content_set', true);

        /* Create test posts */
        $wp_upload_dir = wp_upload_dir();
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $ids = array(2, 1);

        foreach ($ids as $id) {
            $post_id = wp_insert_post(array(
                'post_title' => "Hi there, I'm a WordPress Post",
                'post_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi',
                'post_status' => 'publish'
            ));
            $filename = ITHEME_CDN_PATH . '/images/post-asithemes-i-' . $id . '.jpg';
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

add_action('after_setup_theme', 'itheme_after_setup_theme');

//* Enqueue Scripts & Styles
function itheme_wp_enqueue_scripts() {

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto+Slab:100,300,400,700', array(), ITHEME_VERSION);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), ITHEME_VERSION);

    wp_enqueue_script('scripts', ITHEME_CDN . '/js/scripts.js', array('jquery'), ITHEME_VERSION);
}

add_action('wp_enqueue_scripts', 'itheme_wp_enqueue_scripts');

function itheme_body_class($classes) {

    global $is_chrome;

    if ($is_chrome) {
        $classes[] = 'chrome';
    }

    if (is_home() || is_author() || is_archive() || is_search()) {
        $classes[] = 'blog-style';
    }

    return $classes;
}

add_filter('body_class', 'itheme_body_class');

function itheme_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['data-title'] = $item->title;
    return $atts;
}

add_filter('nav_menu_link_attributes', 'itheme_nav_menu_link_attributes', 10, 4);

function itheme_wp_head() {
    $boton_color = get_theme_mod('itheme_button_color', '#ffffff');
    $boton_background = get_theme_mod('itheme_button_background', '#ffb11b');
    $link_color = get_theme_mod('itheme_link_color', '#ffb11b');
    ?>
    <style type="text/css">
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button{
            background-color: <?php echo $boton_background; ?> !important;
            color: <?php echo $boton_color; ?> !important;
        }
        button:hover,
        input:hover[type="button"],
        input:hover[type="reset"],
        input:hover[type="submit"],
        .button:hover,
        button:focus,
        input:focus[type="button"],
        input:focus[type="reset"],
        input:focus[type="submit"],
        .button:focus,
        .footer-widgets button,
        .footer-widgets input[type="button"],
        .footer-widgets input[type="reset"],
        .footer-widgets input[type="submit"],
        .footer-widgets .button,
        .site-header .cart-contents span,
        .enews-widget input[type="submit"]{
            background-color: <?php echo $boton_background; ?>;
            color: <?php echo $boton_color; ?>;
        }
        a,
        .entry-title a:hover,
        .entry-title a:focus,
        .nav-primary .genesis-nav-menu .sub-menu a:hover,
        .nav-primary .genesis-nav-menu .sub-menu a:focus,
        .nav-primary .genesis-nav-menu .sub-menu .current-menu-item > a{
            color: <?php echo $link_color; ?>;
        }
    </style>
    <?php
}

add_action('wp_head', 'itheme_wp_head');

function itheme_pre_get_posts($query) {

    if (is_admin())
        return;

    if (is_search() && $query->is_main_query()) {
        $query->set('post_type', 'post');
    }
}

add_action('pre_get_posts', 'itheme_pre_get_posts');

