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

add_action('customize_controls_enqueue_scripts', 'itheme_customize_controls_enqueue_scripts');

function itheme_customize_controls_enqueue_scripts() {
    wp_enqueue_script('itheme-customizer', ITHEME_CDN . '/js/customizer.js', array('customize-preview'), ITHEME_VERSION, true);
}

add_action('customize_register', 'itheme_customizer', 20);

function itheme_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_control('blog_title');

    itheme_customizer_panel_home($wp_customize);
    itheme_customizer_panel_colors($wp_customize);
    itheme_customizer_panel_footer($wp_customize);
    itheme_customizer_panel_header($wp_customize);
}

function itheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function itheme_customizer_panel_home($wp_customize) {

    //* Add homepage setup panel
    $wp_customize->add_panel('itheme_homepage', array(
        'title' => __('Homepage', 'itheme'),
        'priority' => 10,
    ));

    //* Settings homepage
    //* Create Banner Section
    $wp_customize->add_section('itheme_frontpage_banner', array(
        'title' => __('Banner', 'itheme'),
        'description' => '',
        'panel' => 'itheme_homepage',
    ));

    //* Banner title
    $wp_customize->add_setting('itheme_frontpage_banner_title', array(
        'default' => "Hi there, I'm a Genesis<br/><strong>Wordpress Theme</strong>",
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'itheme_frontpage_banner_title', array(
        'label' => __('Title', 'itheme'),
        'section' => 'itheme_frontpage_banner',
        'settings' => 'itheme_frontpage_banner_title',
        'type' => 'textarea'
    )));

    //* Banner title color
    $wp_customize->add_setting('itheme_frontpage_banner_title_color', array(
        'default' => '#ffffff',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'itheme_frontpage_banner_title_color', array(
        'label' => __('Color button', 'itheme'),
        'section' => 'itheme_frontpage_banner',
        'settings' => 'itheme_frontpage_banner_title_color',
    )));

    //* Banner button text
    $wp_customize->add_setting('itheme_frontpage_banner_button_text', array(
        'default' => __('Join us', 'itheme'),
        'sanitize_callback' => 'sanitize_text_field',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_banner_button_text', array(
        'label' => __('Button text', 'itheme'),
        'section' => 'itheme_frontpage_banner',
        'settings' => 'itheme_frontpage_banner_button_text',
        'type' => 'text',
    ));

    //* Banner button link
    $wp_customize->add_setting('itheme_frontpage_banner_button_link', array(
        'default' => home_url(),
        'sanitize_callback' => 'sanitize_text_field',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_banner_button_link', array(
        'label' => __('Button link', 'itheme'),
        'section' => 'itheme_frontpage_banner',
        'settings' => 'itheme_frontpage_banner_button_link',
        'type' => 'text',
    ));

    //* Banner Image
    $wp_customize->add_setting('itheme_frontpage_banner_image', array(
        'default' => ITHEME_CDN . '/images/default.jpg',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'itheme_frontpage_banner_image', array(
        'label' => __('Image', 'itheme'),
        'section' => 'itheme_frontpage_banner',
        'settings' => 'itheme_frontpage_banner_image',
    )));

    //* SETTINGS HOMEPAGE CTA
    //* Create CTA section
    $wp_customize->add_section('itheme_frontpage_cta_boxes', array(
        'title' => __('CTA boxes', 'itheme'),
        'description' => '',
        'panel' => 'itheme_homepage',
    ));

    //* CTA 1 text
    $wp_customize->add_setting('itheme_frontpage_cta_text_1', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'itheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_cta_text_1', array(
        'label' => __('Cta text 1', 'itheme'),
        'section' => 'itheme_frontpage_cta_boxes',
        'settings' => 'itheme_frontpage_cta_text_1',
        'type' => 'textarea'
    ));

    //* CTA 1 image
    $wp_customize->add_setting('itheme_frontpage_cta_image_1', array(
        'default' => ITHEME_CDN . '/images/icon-a.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'itheme_frontpage_cta_image_1', array(
        'label' => __('Cta image 1', 'itheme'),
        'section' => 'itheme_frontpage_cta_boxes',
        'settings' => 'itheme_frontpage_cta_image_1',
    )));

    //* CTA 2 text
    $wp_customize->add_setting('itheme_frontpage_cta_text_2', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'itheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_cta_text_2', array(
        'label' => __('Cta text 2', 'itheme'),
        'section' => 'itheme_frontpage_cta_boxes',
        'settings' => 'itheme_frontpage_cta_text_2',
        'type' => 'textarea'
    ));

    //* CTA 2 image
    $wp_customize->add_setting('itheme_frontpage_cta_image_2', array(
        'default' => ITHEME_CDN . '/images/icon-b.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'itheme_frontpage_cta_image_2', array(
        'label' => __('Cta image 2', 'itheme'),
        'section' => 'itheme_frontpage_cta_boxes',
        'settings' => 'itheme_frontpage_cta_image_2',
    )));

    //* CTA 3 text
    $wp_customize->add_setting('itheme_frontpage_cta_text_3', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi justo.',
        'sanitize_callback' => 'itheme_sanitize_text',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_cta_text_3', array(
        'label' => __('Cta text 3', 'itheme'),
        'section' => 'itheme_frontpage_cta_boxes',
        'settings' => 'itheme_frontpage_cta_text_3',
        'type' => 'textarea'
    ));

    //* CTA 3 image
    $wp_customize->add_setting('itheme_frontpage_cta_image_3', array(
        'default' => ITHEME_CDN . '/images/icon-c.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'itheme_frontpage_cta_image_3', array(
        'label' => __('Cta image 3', 'itheme'),
        'section' => 'itheme_frontpage_cta_boxes',
        'settings' => 'itheme_frontpage_cta_image_3',
    )));

    //* SETTINGS HOMEPAGE POSTS
    //* Create POSTS section
    $wp_customize->add_section('itheme_frontpage_posts', array(
        'title' => __('Posts', 'itheme'),
        'description' => '',
        'panel' => 'itheme_homepage',
    ));

    //* Num posts
    $wp_customize->add_setting('itheme_frontpage_num_posts', array(
        'default' => '2',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_num_posts', array(
        'label' => __('Number of posts to display', 'itheme'),
        'section' => 'itheme_frontpage_posts',
        'settings' => 'itheme_frontpage_num_posts',
    ));

    //* All posts text
    $wp_customize->add_setting('itheme_frontpage_all_posts_text', array(
        'default' => __('View all', 'itheme'),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_frontpage_all_posts_text', array(
        'label' => __('Text "View All"', 'itheme'),
        'section' => 'itheme_frontpage_posts',
        'settings' => 'itheme_frontpage_all_posts_text',
    ));
}

function itheme_customizer_panel_colors($wp_customize) {

    //* Add Colores panel
    $wp_customize->add_panel('itheme_colors', array(
        'title' => __('Colors', 'itheme'),
        'priority' => 11,
    ));

    //* Add Botones section
    $wp_customize->add_section('itheme_colors_buttons', array(
        'title' => __('Buttons', 'itheme'),
        'panel' => 'itheme_colors',
    ));

    //* Button color
    $wp_customize->add_setting('itheme_button_color', array(
        'default' => '#ffffff',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'itheme_button_color', array(
        'label' => __('Text color', 'itheme'),
        'section' => 'itheme_colors_buttons',
        'settings' => 'itheme_button_color',
    )));

    //* Button background
    $wp_customize->add_setting('itheme_button_background', array(
        'default' => '#ffb11b',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'itheme_button_background', array(
        'label' => __('Background color', 'itheme'),
        'section' => 'itheme_colors_buttons',
        'settings' => 'itheme_button_background',
    )));

    //* Add Enlaces section
    $wp_customize->add_section('itheme_colors_links', array(
        'title' => __('Links', 'itheme'),
        'panel' => 'itheme_colors',
    ));

    //* Button color
    $wp_customize->add_setting('itheme_link_color', array(
        'default' => '#ffb11b',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'itheme_link_color', array(
        'label' => __('Text color', 'itheme'),
        'section' => 'itheme_colors_links',
        'settings' => 'itheme_link_color',
    )));
}

function itheme_customizer_panel_footer($wp_customize) {

    //* Add footer setup panel
    $wp_customize->add_section('itheme_footer', array(
        'title' => __('Footer', 'itheme'),
        'priority' => 12,
    ));

    //* Texto footer
    $wp_customize->add_setting('itheme_footer_text', array(
        'default' => '[footer_copyright before="%s "]',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_footer_text', array(
        'label' => __('Text', 'itheme'),
        'section' => 'itheme_footer',
        'settings' => 'itheme_footer_text',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting('itheme_footer_menu', array(
        'default' => '0',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control('itheme_footer_menu', array(
        'label' => __('Menu', 'itheme'),
        'section' => 'itheme_footer',
        'settings' => 'itheme_footer_menu',
        'type' => 'select',
        'choices' => $choices,
    ));
}

function itheme_customizer_panel_header($wp_customize) {
    
    //* Add header setup panel
    $wp_customize->add_section('itheme_header', array(
        'title' => __('Header', 'itheme'),
        'priority' => 13,
    ));
    
    $wp_customize->add_setting('itheme_header_position', array(
        'default' => 'relative',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control('itheme_header_position', array(
        'type' => 'select',
        'section' => 'itheme_header',
        'label' => __('Header position', 'itheme'),
        'choices' => array(
            'fixed' => __('Header fixed', 'itheme'),
            'relative' => __('Header relative', 'itheme')
        ),
    ));
}