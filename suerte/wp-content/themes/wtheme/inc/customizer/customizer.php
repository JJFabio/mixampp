<?php

if (!class_exists('WP_Customize_Control'))
    return NULL;

//* Include custom classes
require_once(ASITHEME_CDN_PATH . '/inc/customizer/inc/class-wp-customize-range.php');
require_once(ASITHEME_CDN_PATH . '/inc/customizer/inc/class-wp-customize-text-editor.php');
require_once(ASITHEME_CDN_PATH . '/inc/customizer/inc/class-wp-customize-google-font.php');
require_once(ASITHEME_CDN_PATH . '/inc/customizer/inc/class-wp-customize-multiselect.php');

//* Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
add_action('customize_controls_enqueue_scripts', 'asitheme_customize_controls_enqueue_scripts');

function asitheme_customize_controls_enqueue_scripts() {

    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css', array(), CHILD_THEME_VERSION);
    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js', array(), CHILD_THEME_VERSION, true);

    wp_enqueue_style(ASITHEME_SLUG . '-customizer', ASITHEME_CDN . '/assets/css/customizer.css', array(), CHILD_THEME_VERSION);
    wp_register_script(ASITHEME_SLUG . '-customizer', ASITHEME_CDN . '/assets/js/customizer.js', array('customize-preview'), CHILD_THEME_VERSION, true);
    wp_localize_script(ASITHEME_SLUG . '-customizer', 'asitheme_customizer_slug', ASITHEME_SLUG);
    wp_enqueue_script(ASITHEME_SLUG . '-customizer');
}

add_action('customize_register', 'asitheme_customizer', 20);

function asitheme_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('blog_title');
    $wp_customize->remove_section('genesis_header');

    asitheme_customizer_panel_colors($wp_customize);
    asitheme_customizer_panel_header($wp_customize);
    asitheme_customizer_panel_footer($wp_customize);
    asitheme_customizer_panel_fonts($wp_customize);
    asitheme_customizer_panel_social($wp_customize);
}

add_action('customize_controls_print_footer_scripts', 'asitheme_customize_controls_print_footer_scripts');

function asitheme_customize_controls_print_footer_scripts() {
    if (version_compare(PARENT_THEME_VERSION, '3.1.0', '>=')) {
        ?>
        <script>
            wp.customize.bind('ready', function () {
                jQuery('#_customize-input-' + asitheme_customizer_slug + '_footer_text').prop('disabled', true);
                jQuery('#_customize-input-' + asitheme_customizer_slug + '_footer_menu').prop('disabled', true);
            });
        </script>
        <?php
    }
}

function asitheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function asitheme_customizer_panel_colors($wp_customize) {

    //* Add Colores panel
    $wp_customize->add_panel(ASITHEME_SLUG . '_colors', array(
        'title' => __('Colors', ASITHEME_SLUG),
        'priority' => 11,
    ));

    //* Add Botones section
    $wp_customize->add_section(ASITHEME_SLUG . '_colors_buttons', array(
        'title' => __('Buttons', ASITHEME_SLUG),
        'panel' => ASITHEME_SLUG . '_colors',
    ));

    //* Button color
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_color', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_color'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_color', array(
        'label' => __('Text color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_color',
    )));

    //* Button background
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_background', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_background'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_background', array(
        'label' => __('Background color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_background',
    )));

    //* Button border color
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_border_color', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_border_color'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_border_color', array(
        'label' => __('Border color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_border_color',
    )));

    //* Button color hover
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_color_hover', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_color_hover'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_color_hover', array(
        'label' => __('Text color when the mouse passes over', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_color_hover',
    )));

    //* Button background hover
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_background_hover', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_background_hover'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_background_hover', array(
        'label' => __('Background color when the mouse passes over', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_background_hover',
    )));

    //* Button border color hover
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_border_color_hover', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_border_color_hover'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_border_color_hover', array(
        'label' => __('Border color when the mouse passes over', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_border_color_hover',
    )));

    //* Add Enlaces section
    $wp_customize->add_section(ASITHEME_SLUG . '_colors_links', array(
        'title' => __('Links', ASITHEME_SLUG),
        'panel' => ASITHEME_SLUG . '_colors',
    ));

    //* Link color
    $wp_customize->add_setting(ASITHEME_SLUG . '_link_color', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_link_color'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_link_color', array(
        'label' => __('Text color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_links',
        'settings' => ASITHEME_SLUG . '_link_color',
    )));

    //* Border width
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_border_width', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_border_width'],
    ));

    $wp_customize->add_control(new WP_Customize_Range($wp_customize, ASITHEME_SLUG . '_button_border_width', array(
        'label' => __('Border width', ASITHEME_SLUG) . ' (%)',
        'min' => 0,
        'max' => 10,
        'step' => 1,
        'section' => ASITHEME_SLUG . '_colors_buttons',
    )));
}

function asitheme_customizer_panel_header($wp_customize) {

    //* Add header setup panel
    $wp_customize->add_section(ASITHEME_SLUG . '_header', array(
        'title' => __('Header', ASITHEME_SLUG),
        'priority' => 12,
    ));

    $wp_customize->add_setting(ASITHEME_SLUG . '_header_position', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_header_position'],
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control(ASITHEME_SLUG . '_header_position', array(
        'type' => 'select',
        'section' => ASITHEME_SLUG . '_header',
        'label' => __('Header position', ASITHEME_SLUG),
        'choices' => array(
            'fixed' => __('Header fixed', ASITHEME_SLUG),
            'relative' => __('Header relative', ASITHEME_SLUG)
        ),
    ));

    $wp_customize->add_setting(ASITHEME_SLUG . '_header_transparency', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_header_transparency'],
    ));

    $wp_customize->add_control(new WP_Customize_Range($wp_customize, ASITHEME_SLUG . '_header_transparency', array(
        'label' => __('Background transparency', ASITHEME_SLUG) . ' (%)',
        'min' => 0,
        'max' => 100,
        'step' => 1,
        'section' => ASITHEME_SLUG . '_header',
    )));

    //* Header search center
    $wp_customize->add_setting(ASITHEME_SLUG . '_header_search', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_header_search'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_header_search', array(
        'label' => __('Show search engine as in the demo?', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_header',
        'settings' => ASITHEME_SLUG . '_header_search',
        'type' => 'checkbox'
    ));

    //* Button background
    $wp_customize->add_setting(ASITHEME_SLUG . '_header_background', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_header_background'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_header_background', array(
        'label' => __('Header background color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_header',
        'settings' => ASITHEME_SLUG . '_header_background',
    )));
}

function asitheme_customizer_panel_footer($wp_customize) {

    //* Add footer setup panel
    $wp_customize->add_section(ASITHEME_SLUG . '_footer', array(
        'title' => __('Footer', ASITHEME_SLUG),
        'priority' => 13,
    ));

    if (version_compare(PARENT_THEME_VERSION, '3.1.0', '>=')) {

        //* Description
        $wp_customize->add_setting(ASITHEME_SLUG . '_footer_description', array(
            'default' => '',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(ASITHEME_SLUG . '_footer_description', array(
            'type' => 'hidden',
            'section' => ASITHEME_SLUG . '_footer',
            'settings' => ASITHEME_SLUG . '_footer_description',
            'description' => sprintf(__('From Genesis 3.1.0 and later versions, if you want to modify footer content you have to go <a href="%s">Theme Settings > Footer</a>.', ASITHEME_SLUG), "javascript:wp.customize.section('genesis_footer').focus();"),
        ));
    }

    //* Texto footer
    $wp_customize->add_setting(ASITHEME_SLUG . '_footer_text', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_footer_text'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_footer_text', array(
        'label' => __('Footer Credits Text', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_footer',
        'settings' => ASITHEME_SLUG . '_footer_text',
        'type' => 'textarea',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting(ASITHEME_SLUG . '_footer_menu', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_footer_menu'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_footer_menu', array(
        'label' => __('Menu', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_footer',
        'settings' => ASITHEME_SLUG . '_footer_menu',
        'type' => 'select',
        'choices' => $choices,
    ));
}

function asitheme_customizer_panel_fonts($wp_customize) {

    //* Add font panel
    $wp_customize->add_section(ASITHEME_SLUG . '_font', array(
        'title' => __('Fonts', ASITHEME_SLUG),
        'priority' => 14,
    ));

    //* Main Google Font Setting
    $wp_customize->add_setting(ASITHEME_SLUG . '_font', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_font'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Google_Font_Control($wp_customize, ASITHEME_SLUG . '_font', array(
        'label' => __('Body', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_font',
        'settings' => ASITHEME_SLUG . '_font'
    )));

    //* Headings Google Font Setting
    $wp_customize->add_setting(ASITHEME_SLUG . '_font_headings', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_font_headings'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Google_Font_Control($wp_customize, ASITHEME_SLUG . '_font_headings', array(
        'label' => __('Headings', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_font',
        'settings' => ASITHEME_SLUG . '_font_headings',
    )));
}

function asitheme_customizer_panel_social($wp_customize) {

    //* Add Social panel
    $wp_customize->add_section(ASITHEME_SLUG . '_social', array(
        'title' => __('Social networks', ASITHEME_SLUG),
        'priority' => 14,
    ));

    //* Footer active social
    $wp_customize->add_setting(ASITHEME_SLUG . '_social_footer', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_social_footer'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_social_footer', array(
        'label' => __('Add social networks in the footer?', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_social',
        'settings' => ASITHEME_SLUG . '_social_footer',
        'type' => 'checkbox'
    ));

    //* Social networks Setting
    foreach (CHILD_THEME_DEFAULTS_NETWORKS as $key => $value) {

        $wp_customize->add_setting(ASITHEME_SLUG . '_social_' . $value, array(
            'default' => '',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(ASITHEME_SLUG . '_social_' . $value, array(
            'label' => $key . ' ' . __('link', ASITHEME_SLUG),
            'section' => ASITHEME_SLUG . '_social',
            'settings' => ASITHEME_SLUG . '_social_' . $value,
            'type' => 'text'
        ));
    }
}