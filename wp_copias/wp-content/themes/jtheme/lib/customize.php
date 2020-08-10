<?php
if (!class_exists('WP_Customize_Control'))
    return NULL;

class Text_Editor_Custom_Control extends WP_Customize_Control {

    public function render_content() {
        ?>
        <label>
            <span class="customize-text_editor" style="display: block;font-size: 14px;line-height: 24px;font-weight: 600;color: #555d66;">
                <?php echo esc_html($this->label); ?>
            </span>
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea($this->value()); ?>">
            <?php
            $settings = array(
                'textarea_name' => $this->id,
                'media_buttons' => false,
                'drag_drop_upload' => false,
                'teeny' => true,
                'textarea_rows' => 10
            );
            wp_editor($this->value(), $this->id, $settings);
            ?>
            <style type="text/css">
                #wp-link-wrap {
                    z-index: 99999999999999 !important;
                }
                #wp-link-backdrop {
                    z-index: 99999999999999 !important;
                }
                .mce-floatpanel, .mce-toolbar-grp.mce-inline-toolbar-grp {
                    z-index: 99999999999999 !important;
                }
            </style>
        </label>
        <?php
        do_action('admin_print_footer_scripts');
    }

}

//* Binds JS handlers to make Theme Customizer preview reload changes asynchronously.

add_action('customize_controls_enqueue_scripts', 'jtheme_customize_controls_enqueue_scripts');

function jtheme_customize_controls_enqueue_scripts() {
    wp_enqueue_script('jtheme-customizer', JTHEME_CDN . '/js/customizer.js', array('customize-preview'), JTHEME_VERSION, true);
}

add_action('customize_register', 'jtheme_customizer', 20);

function jtheme_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('blog_title');

    jtheme_customizer_panel_home($wp_customize);
    jtheme_customizer_panel_colors($wp_customize);
    jtheme_customizer_panel_footer($wp_customize);
    jtheme_customizer_panel_header($wp_customize);
}

function jtheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function jtheme_customizer_panel_home($wp_customize) {

    //* Add homepage setup panel
    $wp_customize->add_section('jtheme_homepage', array(
        'title' => __('Homepage', 'jtheme'),
        'priority' => 10,
    ));

    //* Webshop background
    $wp_customize->add_setting('jtheme_frontpage_title_page', array(
        'default' => "Hi there, I'm a<br/><strong>Genesis Wordpress Theme</strong>",
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'jtheme_frontpage_title_page', array(
        'label' => __('Title page', 'jtheme'),
        'section' => 'jtheme_homepage',
        'settings' => 'jtheme_frontpage_title_page',
        'type' => 'textarea'
    )));

    //* Num posts
    $wp_customize->add_setting('jtheme_frontpage_num_posts', array(
        'default' => '3',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('jtheme_frontpage_num_posts', array(
        'label' => __('Number of posts to display', 'jtheme'),
        'section' => 'jtheme_homepage',
        'settings' => 'jtheme_frontpage_num_posts',
    ));

    //* All posts text
    $wp_customize->add_setting('jtheme_frontpage_all_posts_text', array(
        'default' => __('View all', 'jtheme'),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('jtheme_frontpage_all_posts_text', array(
        'label' => __('Text "View all"', 'jtheme'),
        'section' => 'jtheme_homepage',
        'settings' => 'jtheme_frontpage_all_posts_text',
    ));
}

function jtheme_customizer_panel_colors($wp_customize) {

    //* Add Colores panel
    $wp_customize->add_panel('jtheme_colors', array(
        'title' => __('Colors', 'jtheme'),
        'priority' => 11,
    ));

    //* Add Botones section
    $wp_customize->add_section('jtheme_colors_buttons', array(
        'title' => __('Buttons', 'jtheme'),
        'panel' => 'jtheme_colors',
    ));

    //* Button color
    $wp_customize->add_setting('jtheme_button_color', array(
        'default' => '#ffffff',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jtheme_button_color', array(
        'label' => __('Text color', 'jtheme'),
        'section' => 'jtheme_colors_buttons',
        'settings' => 'jtheme_button_color',
    )));

    //* Button background
    $wp_customize->add_setting('jtheme_button_background', array(
        'default' => '#e9ac35',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jtheme_button_background', array(
        'label' => __('Background color', 'jtheme'),
        'section' => 'jtheme_colors_buttons',
        'settings' => 'jtheme_button_background',
    )));

    //* Add Enlaces section
    $wp_customize->add_section('jtheme_colors_links', array(
        'title' => __('Links', 'jtheme'),
        'panel' => 'jtheme_colors',
    ));

    //* Button color
    $wp_customize->add_setting('jtheme_link_color', array(
        'default' => '#e9ac35',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jtheme_link_color', array(
        'label' => __('Text color', 'jtheme'),
        'section' => 'jtheme_colors_links',
        'settings' => 'jtheme_link_color',
    )));
}

function jtheme_customizer_panel_footer($wp_customize) {

    //* Add footer setup panel
    $wp_customize->add_section('jtheme_footer', array(
        'title' => __('Footer', 'jtheme'),
        'priority' => 12,
    ));

    //* Texto footer
    $wp_customize->add_setting('jtheme_footer_text', array(
        'default' => '[footer_copyright before="%s "]',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('jtheme_footer_text', array(
        'label' => __('Text', 'jtheme'),
        'section' => 'jtheme_footer',
        'settings' => 'jtheme_footer_text',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting('jtheme_footer_menu', array(
        'default' => '0',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('jtheme_footer_menu', array(
        'label' => __('Menu', 'jtheme'),
        'section' => 'jtheme_footer',
        'settings' => 'jtheme_footer_menu',
        'type' => 'select',
        'choices' => $choices,
    ));
}

function jtheme_customizer_panel_header($wp_customize) {
    
    //* Add header setup panel
    $wp_customize->add_section('jtheme_header', array(
        'title' => __('Header', 'jtheme'),
        'priority' => 13,
    ));
    
    $wp_customize->add_setting('jtheme_header_position', array(
        'default' => 'relative',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control('jtheme_header_position', array(
        'type' => 'select',
        'section' => 'jtheme_header',
        'label' => __('Header position', 'jtheme'),
        'choices' => array(
            'fixed' => __('Header fixed', 'jtheme'),
            'relative' => __('Header relative', 'jtheme')
        ),
    ));
}