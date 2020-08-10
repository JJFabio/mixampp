<?php
//* Start the engine
include_once(get_template_directory() . '/lib/init.php');

$theme = wp_get_theme();
define('ASITHEME_CDN', get_stylesheet_directory_uri());
define('ASITHEME_CDN_PATH', get_stylesheet_directory());
define('CHILD_THEME_NAME', $theme->get('Name'));
define('CHILD_THEME_VERSION', $theme->get('Version'));
define('CHILD_THEME_THEMEURI', $theme->get('ThemeURI'));
define('CHILD_THEME_AUTHOR', $theme->get('Author'));
define('CHILD_THEME_AUTHORURI', $theme->get('AuthorURI'));

define('ASITHEME_SLUG', 'btheme');

//* Add Theme Customizer settings
require_once(ASITHEME_CDN_PATH . '/inc/customizer/customizer.php');

//* Genesis
require_once(ASITHEME_CDN_PATH . '/inc/genesis.php');

//* Setup Wizard
require_once(ASITHEME_CDN_PATH . '/inc/setup-wizard/setup-wizard.php');

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('woocommerce/woocommerce.php')) {
    require_once(ASITHEME_CDN_PATH . '/inc/woocommerce/woocommerce.php');
}
if (is_plugin_active('gravityforms/gravityforms.php')) {
    require_once(ASITHEME_CDN_PATH . '/inc/gravityforms/gravityforms.php');
}
if (is_plugin_active('gravityforms/gravityforms.php') || is_plugin_active('ninja-forms/ninja-forms.php') || is_plugin_active('wysija-newsletters/index.php') || is_plugin_active('mailpoet/mailpoet.php')) {

    add_action('wp_enqueue_scripts', 'asitheme_forms_wp_enqueue_scripts');

    function asitheme_forms_wp_enqueue_scripts() {

        wp_enqueue_style('asitheme-forms', ASITHEME_CDN . '/assets/css/forms.css', array(), CHILD_THEME_VERSION);
    }

}

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery'));

add_action('after_setup_theme', 'asitheme_after_setup_theme');

function asitheme_after_setup_theme() {

    load_theme_textdomain(ASITHEME_SLUG, ASITHEME_CDN_PATH . '/languages');

    //* Updater theme
    require(ASITHEME_CDN_PATH . '/inc/updater/updater.php');

    if (!get_theme_mod(ASITHEME_SLUG . '_content_set', false)) {

        set_theme_mod(ASITHEME_SLUG . '_content_set', true);
        set_theme_mod(ASITHEME_SLUG . '_button_color', '#ffffff');
        set_theme_mod(ASITHEME_SLUG . '_button_background', '#c3251d');
        set_theme_mod(ASITHEME_SLUG . '_link_color', '#c3251d');
        set_theme_mod(ASITHEME_SLUG . '_footer_text', '[footer_copyright]');
        set_theme_mod(ASITHEME_SLUG . '_header_position', 'relative');
    }
}

//* Enqueue Scripts & Styles
add_action('wp_enqueue_scripts', 'asitheme_wp_enqueue_scripts');

function asitheme_wp_enqueue_scripts() {

    $content_font = get_theme_mod(ASITHEME_SLUG . '_font', 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');
    wp_enqueue_style('google-fonts', add_query_arg(array('family' => $content_font), 'https://fonts.googleapis.com/css'), array(), CHILD_THEME_VERSION);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION);

    wp_enqueue_script('scripts', ASITHEME_CDN . '/assets/js/scripts.js', array('jquery'), CHILD_THEME_VERSION);
}

add_filter('body_class', 'asitheme_body_class');

function asitheme_body_class($classes) {

    global $is_chrome, $is_safari;

    if ($is_chrome) {
        $classes[] = 'chrome';
    }

    if ($is_safari) {
        $classes[] = 'safari';
    }

    if (is_home() || is_author() || is_archive() || is_search() || is_page_template('page_blog.php')) {
        $classes[] = 'blog-style';
    }

    return $classes;
}

add_filter('nav_menu_link_attributes', 'asitheme_nav_menu_link_attributes', 10, 4);

function asitheme_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['data-title'] = $item->title;
    return $atts;
}

add_action('wp_head', 'asitheme_wp_head');

function asitheme_wp_head() {
    $boton_color = get_theme_mod(ASITHEME_SLUG . '_button_color', '#ffffff');
    $boton_background = get_theme_mod(ASITHEME_SLUG . '_button_background', '#c3251d');
    $boton_border = get_theme_mod(ASITHEME_SLUG . '_button_border_color', $boton_background);
    $boton_color_hover = get_theme_mod(ASITHEME_SLUG . '_button_color_hover', $boton_color);
    $boton_background_hover = get_theme_mod(ASITHEME_SLUG . '_button_background_hover', $boton_background);
    $boton_boder_hover = get_theme_mod(ASITHEME_SLUG . '_button_border_color_hover', $boton_background);
    $link_color = get_theme_mod(ASITHEME_SLUG . '_link_color', '#c3251d');
    $font_customize = get_theme_mod(ASITHEME_SLUG . '_font', 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');
    $font = str_replace('+', ' ', explode(':', $font_customize));
    $header_transparency = get_theme_mod(ASITHEME_SLUG . '_header_transparency', 50);
    $header_transparency = (int) $header_transparency / 100;
    ?>
    <style type="text/css">
        body{
            font-family: "<?php echo $font[0]; ?>", sans-serif;
        }
        .button,
        button,
        input[type="button"],
        input[type="reset"],
        input[type="submit"]{
            background-color: <?php echo $boton_background; ?>;
            color: <?php echo $boton_color; ?>;
            border-color: <?php echo $boton_border; ?>;
        }
        button:hover,
        .button:hover,
        input:hover[type="button"],
        input:hover[type="reset"],
        input:hover[type="submit"]{
            background-color: <?php echo $boton_background_hover; ?>;
            color: <?php echo $boton_color_hover; ?>;
            border-color: <?php echo $boton_boder_hover; ?>;
        }
        .button:active,
        button:active,
        input:active[type="button"],
        input:active[type="reset"],
        input:active[type="submit"]{
            background-color: <?php echo $boton_background; ?>;
            color: <?php echo $boton_color; ?>;
            border-color: <?php echo $boton_border; ?>;
        }
        a,
        .entry-title a:hover,
        .entry-title a:focus,
        .nav-primary .genesis-nav-menu .sub-menu a:hover,
        .nav-primary .genesis-nav-menu .sub-menu a:focus,
        .nav-primary .genesis-nav-menu .sub-menu .current-menu-item > a{
            color: <?php echo $link_color; ?>;
        }
        .site-header.fixed.scroll{
            background-color: rgba(255,255,255,<?php echo $header_transparency ?>);
        }
    </style>
    <?php
}

add_action('pre_get_posts', 'asitheme_pre_get_posts');

function asitheme_pre_get_posts($query) {

    if (is_admin()) {
        return;
    }

    if (is_search() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'page'));
    }
}

add_filter('genesis_footer_copyright_shortcode', 'asitheme_genesis_footer_copyright_shortcode', 10, 2);

function asitheme_genesis_footer_copyright_shortcode($output, $atts) {
    return sprintf(date('Y') . ' %s <a href="' . CHILD_THEME_THEMEURI . '" rel="nofollow" target="_blank">' . CHILD_THEME_NAME . '</a> by <a href="' . CHILD_THEME_AUTHORURI . '" rel="nofollow" target="_blank">' . CHILD_THEME_AUTHOR . '</a>', $atts['copyright']);
}