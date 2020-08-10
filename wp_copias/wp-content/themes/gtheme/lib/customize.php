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
                'teeny' => true
            );
            wp_editor($this->value(), $this->id, $settings);
            do_action('admin_footer');
            do_action('admin_print_footer_scripts');
            ?>
        </label>
        <?php
    }

}

//* Binds JS handlers to make Theme Customizer preview reload changes asynchronously.

add_action('customize_controls_enqueue_scripts', 'gtheme_customize_controls_enqueue_scripts');

function gtheme_customize_controls_enqueue_scripts() {
    wp_enqueue_script('gtheme-customizer', GTHEME_CDN . '/js/customizer.js', array('customize-preview'), GTHEME_VERSION, true);
}

add_action('customize_register', 'gtheme_customizer', 20);

function gtheme_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('blog_title');

    //* Add panels
    //* Add homepage setup panel
    $wp_customize->add_panel('gtheme_homepage', array(
        'title' => __('Homepage Setup', 'gtheme'),
        'priority' => 10,
    ));

    //* Settings homepage
    //* Create Banner Section
    $wp_customize->add_section('gtheme_frontpage_banner', array(
        'title' => 'Banner', 'gtheme',
        'description' => '',
        'panel' => 'gtheme_homepage',
    ));

    //* Banner title
    $wp_customize->add_setting('gtheme_frontpage_banner_title', array(
        'default' => "Hi, I'm a <strong>Genesis<br/>Wordpress Theme</strong>",
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'gtheme_frontpage_banner_title', array(
        'label' => __('Title banner', 'gtheme'),
        'section' => 'gtheme_frontpage_banner',
        'settings' => 'gtheme_frontpage_banner_title',
        'type' => 'textarea'
    )));

    //* Banner subtitle
    $wp_customize->add_setting('gtheme_frontpage_banner_subtitle', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_banner_subtitle', array(
        'label' => __('Subtitle', 'gtheme'),
        'section' => 'gtheme_frontpage_banner',
        'settings' => 'gtheme_frontpage_banner_subtitle',
        'type' => 'textarea',
    ));

    //* Banner button text
    $wp_customize->add_setting('gtheme_frontpage_banner_button_text', array(
        'default' => __('Subscribe', 'gtheme'),
        'sanitize_callback' => 'sanitize_text_field',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_banner_button_text', array(
        'label' => __('Button text', 'gtheme'),
        'section' => 'gtheme_frontpage_banner',
        'settings' => 'gtheme_frontpage_banner_button_text',
        'type' => 'text',
    ));

    //* Banner button link
    $wp_customize->add_setting('gtheme_frontpage_banner_button_link', array(
        'default' => home_url(),
        'sanitize_callback' => 'sanitize_text_field',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_banner_button_link', array(
        'label' => __('Button link', 'gtheme'),
        'section' => 'gtheme_frontpage_banner',
        'settings' => 'gtheme_frontpage_banner_button_link',
        'type' => 'text',
    ));

    //* Banner Image
    $wp_customize->add_setting('gtheme_frontpage_banner_image', array(
        'default' => GTHEME_CDN . '/images/default.jpg',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gtheme_frontpage_banner_image', array(
        'label' => __('Image', 'gtheme'),
        'section' => 'gtheme_frontpage_banner',
        'settings' => 'gtheme_frontpage_banner_image',
    )));

    //* SETTINGS HOMEPAGE CTA
    //* Create CTA section
    $wp_customize->add_section('gtheme_frontpage_cta_boxes', array(
        'title' => 'CTA boxes', 'altitude',
        'description' => '',
        'panel' => 'gtheme_homepage',
    ));

    //* CTA 1 title
    $wp_customize->add_setting('gtheme_frontpage_cta_title_1', array(
        'default' => 'Service One',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_title_1', array(
        'label' => __('Cta title 1', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_title_1',
    ));

    //* CTA 1 description
    $wp_customize->add_setting('gtheme_frontpage_cta_description_1', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_description_1', array(
        'label' => __('Cta description 1', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_description_1',
    ));

    //* CTA 1 link
    $wp_customize->add_setting('gtheme_frontpage_cta_link_1', array(
        'default' => '#',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_link_1', array(
        'label' => __('Cta Link 1', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_link_1',
    ));

    //* CTA 2 title
    $wp_customize->add_setting('gtheme_frontpage_cta_title_2', array(
        'default' => 'Service Two',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_title_2', array(
        'label' => __('Cta title 2', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_title_2',
    ));

    //* CTA 2 description
    $wp_customize->add_setting('gtheme_frontpage_cta_description_2', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_description_2', array(
        'label' => __('Cta description 2', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_description_2',
    ));

    //* CTA 2 link
    $wp_customize->add_setting('gtheme_frontpage_cta_link_2', array(
        'default' => '#',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_link_2', array(
        'label' => __('Cta Link 2', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_link_2',
    ));
    
    //* CTA 3 title
    $wp_customize->add_setting('gtheme_frontpage_cta_title_3', array(
        'default' => 'Service Three',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_title_3', array(
        'label' => __('Cta title 3', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_title_3',
    ));

    //* CTA 3 description
    $wp_customize->add_setting('gtheme_frontpage_cta_description_3', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_description_3', array(
        'label' => __('Cta description 3', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_description_3',
    ));

    //* CTA 3 link
    $wp_customize->add_setting('gtheme_frontpage_cta_link_3', array(
        'default' => '#',
        'sanitize_callback' => 'gtheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_frontpage_cta_link_3', array(
        'label' => __('Cta Link 3', 'gtheme'),
        'section' => 'gtheme_frontpage_cta_boxes',
        'settings' => 'gtheme_frontpage_cta_link_3',
    ));

    //* Add footer setup panel
    $wp_customize->add_section('gtheme_footer', array(
        'title' => __('Pie de página', 'gtheme'),
        'priority' => 11,
    ));

    //* Texto footer
    $wp_customize->add_setting('gtheme_footer_text', array(
        'default' => '[footer_copyright before="%s "]',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_footer_text', array(
        'label' => __('Texto', 'gtheme'),
        'section' => 'gtheme_footer',
        'settings' => 'gtheme_footer_text',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting('gtheme_footer_menu', array(
        'default' => '0',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('gtheme_footer_menu', array(
        'label' => __('Menú', 'gtheme'),
        'section' => 'gtheme_footer',
        'settings' => 'gtheme_footer_menu',
        'type' => 'select',
        'choices' => $choices,
    ));
}

function gtheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
