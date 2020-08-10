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

add_action('customize_controls_enqueue_scripts', 'htheme_customize_controls_enqueue_scripts');

function htheme_customize_controls_enqueue_scripts() {
    wp_enqueue_script('htheme-customizer', HTHEME_CDN . '/js/customizer.js', array('customize-preview'), HTHEME_VERSION, true);
}

add_action('customize_register', 'htheme_customizer', 20);

function htheme_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('blog_title');

    //* Add panels
    //* Add homepage setup panel
    $wp_customize->add_section('htheme_homepage', array(
        'title' => __('Homepage Setup', 'htheme'),
        'priority' => 10,
    ));

    //* Webshop background
    $wp_customize->add_setting('htheme_frontpage_title_page', array(
        'default' => "Hi there, I'm a<br/><strong>Genesis Wordpress Theme</strong>",
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'htheme_frontpage_title_page', array(
        'label' => __('Featured title', 'htheme'),
        'section' => 'htheme_homepage',
        'settings' => 'htheme_frontpage_title_page',
        'type' => 'textarea'
    )));

    //* Paragraph
    $wp_customize->add_setting('htheme_frontpage_paragraph_page', array(
        'default' => "This is an example of a WordPress post, you could edit this to put information about yourself or your site so readers.",
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'htheme_frontpage_paragraph_page', array(
        'label' => __('Featured paragraph', 'htheme'),
        'section' => 'htheme_homepage',
        'settings' => 'htheme_frontpage_paragraph_page',
        'type' => 'textarea'
    )));

    //* Button text
    $wp_customize->add_setting('htheme_frontpage_button_text', array(
        'default' => 'Join us',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('htheme_frontpage_button_text', array(
        'label' => __('Featured button text', 'htheme'),
        'section' => 'htheme_homepage',
        'settings' => 'htheme_frontpage_button_text',
        'type' => 'text',
    ));

    //* Button link
    $wp_customize->add_setting('htheme_frontpage_button_link', array(
        'default' => home_url('/'),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('htheme_frontpage_button_link', array(
        'label' => __('Featured button link', 'htheme'),
        'section' => 'htheme_homepage',
        'settings' => 'htheme_frontpage_button_link',
        'type' => 'text',
    ));

    //* All posts text
    $wp_customize->add_setting('htheme_frontpage_all_posts_text', array(
        'default' => 'All posts',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('htheme_frontpage_all_posts_text', array(
        'label' => __('All posts text', 'htheme'),
        'section' => 'htheme_homepage',
        'settings' => 'htheme_frontpage_all_posts_text',
        'type' => 'text',
    ));

    //* Add footer setup panel
    $wp_customize->add_section('htheme_footer', array(
        'title' => __('Pie de página', 'htheme'),
        'priority' => 11,
    ));

    //* Texto footer
    $wp_customize->add_setting('htheme_footer_text', array(
        'default' => '[footer_copyright before="%s "]',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('htheme_footer_text', array(
        'label' => __('Texto', 'htheme'),
        'section' => 'htheme_footer',
        'settings' => 'htheme_footer_text',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting('htheme_footer_menu', array(
        'default' => '0',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('htheme_footer_menu', array(
        'label' => __('Menú', 'htheme'),
        'section' => 'htheme_footer',
        'settings' => 'htheme_footer_menu',
        'type' => 'select',
        'choices' => $choices,
    ));
}

function htheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
