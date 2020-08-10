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

add_action('customize_controls_enqueue_scripts', 'ktheme_customize_controls_enqueue_scripts');

function ktheme_customize_controls_enqueue_scripts() {
    wp_enqueue_script('ktheme-customizer', KTHEME_CDN . '/js/customizer.js', array('customize-preview'), KTHEME_VERSION, true);
}

add_action('customize_register', 'ktheme_customizer', 20);

function ktheme_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('blog_title');

    //* Add panels
    //* Add homepage setup panel
    $wp_customize->add_section('ktheme_homepage', array(
        'title' => __('Homepage Setup', 'ktheme'),
        'priority' => 10,
    ));

    //* Webshop background
    $wp_customize->add_setting('ktheme_frontpage_title_page', array(
        'default' => "Hi there, I'm a Genesis<br/><strong>Wordpress Theme</strong>",
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'ktheme_frontpage_title_page', array(
        'label' => __('Título de la página', 'ktheme'),
        'section' => 'ktheme_homepage',
        'settings' => 'ktheme_frontpage_title_page',
        'type' => 'textarea'
    )));

    //* All posts text
    $wp_customize->add_setting('ktheme_frontpage_all_posts_text', array(
        'default' => __('Ver todos', 'ktheme'),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('ktheme_frontpage_all_posts_text', array(
        'label' => __('Ver todos texto', 'ktheme'),
        'section' => 'ktheme_homepage',
        'settings' => 'ktheme_frontpage_all_posts_text',
    ));

    //* Add footer setup panel
    $wp_customize->add_section('ktheme_footer', array(
        'title' => __('Pie de página', 'ktheme'),
        'priority' => 11,
    ));

    //* Texto footer
    $wp_customize->add_setting('ktheme_footer_text', array(
        'default' => '[footer_copyright before="%s "]',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('ktheme_footer_text', array(
        'label' => __('Texto', 'ktheme'),
        'section' => 'ktheme_footer',
        'settings' => 'ktheme_footer_text',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting('ktheme_footer_menu', array(
        'default' => '0',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('ktheme_footer_menu', array(
        'label' => __('Menú', 'ktheme'),
        'section' => 'ktheme_footer',
        'settings' => 'ktheme_footer_menu',
        'type' => 'select',
        'choices' => $choices,
    ));
}

function ktheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
