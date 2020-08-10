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

    asitheme_customizer_panel_home($wp_customize);
    asitheme_customizer_panel_colors($wp_customize);
    asitheme_customizer_panel_header($wp_customize);
    asitheme_customizer_panel_footer($wp_customize);
    asitheme_customizer_panel_fonts($wp_customize);
    asitheme_customizer_panel_social($wp_customize);
}

function asitheme_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function asitheme_customizer_panel_home($wp_customize) {

    //* Add homepage setup panel
    $wp_customize->add_panel(ASITHEME_SLUG . '_homepage', array(
        'title' => __('Homepage', ASITHEME_SLUG),
        'priority' => 10,
    ));

    //* Banner section
    $wp_customize->add_section(ASITHEME_SLUG . '_frontpage_banner', array(
        'title' => __('Banner', ASITHEME_SLUG),
        'description' => '',
        'panel' => ASITHEME_SLUG . '_homepage',
    ));

    //* Banner Title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_banner_title', array(
        'default' => 'Amazing Genesis WordPress Theme',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_banner_title', array(
        'label' => __('Title', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_banner',
        'settings' => ASITHEME_SLUG . '_frontpage_banner_title',
        'type' => 'text',
    ));

    //* Banner Subtitle
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_banner_subtitle', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. Aliquam erat volutpat.',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_banner_subtitle', array(
        'label' => __('Subtitle', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_banner',
        'settings' => ASITHEME_SLUG . '_frontpage_banner_subtitle',
        'type' => 'text',
    ));

    //* Banner Button text
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_banner_button_text', array(
        'default' => __('Contact', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_banner_button_text', array(
        'label' => __('Button text', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_banner',
        'settings' => ASITHEME_SLUG . '_frontpage_banner_button_text',
        'type' => 'text',
    ));

    //* Banner Button link
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_banner_button_link', array(
        'default' => home_url('/'),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_banner_button_link', array(
        'label' => __('Button link', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_banner',
        'settings' => ASITHEME_SLUG . '_frontpage_banner_button_link',
        'type' => 'text',
    ));

    //* Banner Image
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_banner_image', array(
        'default' => ASITHEME_CDN . '/assets/images/default.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ASITHEME_SLUG . '_frontpage_banner_image', array(
        'label' => __('Image', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_banner',
        'settings' => ASITHEME_SLUG . '_frontpage_banner_image',
    )));

    //* Newsletter section
    $wp_customize->add_section(ASITHEME_SLUG . '_frontpage_newsletter_section', array(
        'title' => __('Newsletter', ASITHEME_SLUG),
        'description' => '',
        'panel' => ASITHEME_SLUG . '_homepage',
    ));

    //* Newsletter activation
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_newsletter', array(
        'default' => '',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_newsletter', array(
        'label' => __('Do you want to activate the newsletter section?', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_newsletter_section',
        'settings' => ASITHEME_SLUG . '_frontpage_newsletter',
        'type' => 'checkbox'
    ));

    //* Newsletter Title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_newsletter_title', array(
        'default' => __('Subscribe to the newsletter', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_newsletter_title', array(
        'label' => __('Title', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_newsletter_section',
        'settings' => ASITHEME_SLUG . '_frontpage_newsletter_title',
        'type' => 'text',
    ));

    //* Newsletter Content
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_newsletter_content', array(
        'default' => "<ul><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui. </li></ul>",
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, ASITHEME_SLUG . '_frontpage_newsletter_content', array(
        'label' => __('Content', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_newsletter_section',
        'settings' => ASITHEME_SLUG . '_frontpage_newsletter_content',
        'type' => 'textarea'
    )));

    //* Newsletter Form
    $choices = array(
        '' => __('Choose a form', ASITHEME_SLUG)
    );
    if (class_exists('Ninja_Forms')) {
        $forms = Ninja_Forms()->form()->get_forms();
        if ($forms) {
            foreach ($forms as $form) {
                $id = $form->get_id();
                $settings = $form->get_settings();
                $choices['ninja-' . $id] = 'Ninja Forms - ' . $settings['title'];
            }
        }
    }
    if (class_exists('RGFormsModel')) {
        $forms = RGFormsModel::get_forms(null, 'title');
        if ($forms) {
            foreach ($forms as $form) {
                $choices['gravity-' . $form->id] = 'Gravity Forms - ' . $form->title;
            }
        }
    }
    if (class_exists('WYSIJA')) {
        $model_forms = WYSIJA::get('forms', 'model');
        $forms = $model_forms->getRows();
        if ($forms) {
            for ($i = 0, $count = count($forms); $i < $count; $i++) {
                $form = $forms[$i];
                $choices['wysija-' . $form['form_id']] = 'Mailpoet 2 - ' . $form['name'];
            }
        }
    }
    if (class_exists('MailPoet\API\JSON\v1\Forms')) {
        $forms_object = new MailPoet\API\JSON\v1\Forms();
        $forms = $forms_object->listing();
        if ($forms) {
            foreach ($forms->data as $form) {
                $choices['mailpoet-' . $form['id']] = 'Mailpoet 3 - ' . $form['name'];
            }
        }
    }
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_newsletter_form', array(
        'default' => '',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_newsletter_form', array(
        'label' => __('Newsletter form', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_newsletter_section',
        'settings' => ASITHEME_SLUG . '_frontpage_newsletter_form',
        'type' => 'select',
        'choices' => $choices,
    ));

    //* CTAs Section
    $wp_customize->add_section(ASITHEME_SLUG . '_frontpage_cta_section', array(
        'title' => __('CTAs', ASITHEME_SLUG),
        'description' => '',
        'panel' => ASITHEME_SLUG . '_homepage',
    ));

    //* CTAs Title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_title_ctas', array(
        'default' => __('Services', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_title_ctas', array(
        'label' => __('Title', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_title_ctas',
        'type' => 'text',
    ));

    //* CTA 1 title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_title_1', array(
        'default' => __('Service one', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_title_1', array(
        'label' => __('Cta title 1', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_title_1',
    ));

    //* CTA 1 description
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_description_1', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui.',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_description_1', array(
        'label' => __('Cta description 1', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_description_1',
        'type' => 'textarea'
    ));

    //* CTA 1 link
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_link_1', array(
        'default' => '#',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_link_1', array(
        'label' => __('Cta Link 1', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_link_1',
    ));

    //* CTA 1 image
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_image_1', array(
        'default' => ASITHEME_CDN . '/assets/images/folder.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ASITHEME_SLUG . '_frontpage_cta_image_1', array(
        'label' => __('Image 1', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_image_1',
    )));

    //* CTA 2 title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_title_2', array(
        'default' => __('Service two', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_title_2', array(
        'label' => __('Cta title 2', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_title_2',
    ));

    //* CTA 2 description
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_description_2', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui.',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_description_2', array(
        'label' => __('Cta description 2', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_description_2',
        'type' => 'textarea'
    ));

    //* CTA 2 link
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_link_2', array(
        'default' => '#',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_link_2', array(
        'label' => __('Cta Link 2', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_link_2',
    ));

    //* CTA 2 image
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_image_2', array(
        'default' => ASITHEME_CDN . '/assets/images/diamond.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ASITHEME_SLUG . '_frontpage_cta_image_2', array(
        'label' => __('Image 2', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_image_2',
    )));

    //* CTA 3 title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_title_3', array(
        'default' => __('Service three', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_title_3', array(
        'label' => __('Cta title 1', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_title_3',
    ));

    //* CTA 3 description
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_description_3', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu eros dui.',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_description_3', array(
        'label' => __('Cta description 3', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_description_3',
        'type' => 'textarea'
    ));

    //* CTA 3 link
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_link_3', array(
        'default' => '#',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_cta_link_3', array(
        'label' => __('Cta Link 3', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_link_3',
    ));

    //* CTA 3 image
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_cta_image_3', array(
        'default' => ASITHEME_CDN . '/assets/images/lego.png',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ASITHEME_SLUG . '_frontpage_cta_image_3', array(
        'label' => __('Image 3', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_cta_section',
        'settings' => ASITHEME_SLUG . '_frontpage_cta_image_3',
    )));

    //* Posts section
    $wp_customize->add_section(ASITHEME_SLUG . '_frontpage_posts', array(
        'title' => __('Posts', ASITHEME_SLUG),
        'description' => '',
        'panel' => ASITHEME_SLUG . '_homepage',
    ));
    
    //* Posts Title
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_posts_title', array(
        'default' => __('Last posts', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_posts_title', array(
        'label' => __('Last posts title', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_posts',
        'settings' => ASITHEME_SLUG . '_frontpage_posts_title',
    ));

    //* Select posts to display 
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_display_posts', array(
        'default' => 'last',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_display_posts', array(
        'type' => 'select',
        'section' => ASITHEME_SLUG . '_frontpage_posts',
        'label' => __('Select posts to display', ASITHEME_SLUG),
        'choices' => array(
            'last' => __('Last posts', ASITHEME_SLUG),
            'featured' => __('Featured posts', ASITHEME_SLUG)
        ),
    ));

    //* Featured posts
    $choices = array();
    $featureds_posts = get_theme_mod(ASITHEME_SLUG . '_frontpage_featured_posts');
    if ($featureds_posts) {
        foreach ($featureds_posts as $fp_id) {
            $choices[$fp_id] = get_the_title($fp_id);
        }
    }
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_featured_posts', array(
        'default' => array(),
    ));
    $wp_customize->add_control(new WP_Customize_Multiselect_Control($wp_customize, ASITHEME_SLUG . '_frontpage_featured_posts', array(
        'label' => __('Featured posts', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_posts',
        'settings' => ASITHEME_SLUG . '_frontpage_featured_posts',
        'type' => 'multiselect',
        'choices' => $choices
    )));

    //* Num posts
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_num_posts', array(
        'default' => '4',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_num_posts', array(
        'label' => __('Number of posts to display', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_posts',
        'settings' => ASITHEME_SLUG . '_frontpage_num_posts',
    ));
    
    //* All posts text
    $wp_customize->add_setting(ASITHEME_SLUG . '_frontpage_all_posts_text', array(
        'default' => __('View all posts', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_frontpage_all_posts_text', array(
        'label' => __('All posts text', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_frontpage_posts',
        'settings' => ASITHEME_SLUG . '_frontpage_all_posts_text',
    ));
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
        'default' => '#ffffff',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_color', array(
        'label' => __('Text color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_color',
    )));

    //* Button background
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_background', array(
        'default' => '#2296f3',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_background', array(
        'label' => __('Background color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_background',
    )));

    //* Button border color
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_border_color', array(
        'default' => '#2296f3',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_border_color', array(
        'label' => __('Border color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_border_color',
    )));

    //* Button color hover
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_color_hover', array(
        'default' => '#ffffff',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_color_hover', array(
        'label' => __('Text color when the mouse passes over', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_color_hover',
    )));

    //* Button background hover
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_background_hover', array(
        'default' => '#047fe2',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_button_background_hover', array(
        'label' => __('Background color when the mouse passes over', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_buttons',
        'settings' => ASITHEME_SLUG . '_button_background_hover',
    )));

    //* Button border color hover
    $wp_customize->add_setting(ASITHEME_SLUG . '_button_border_color_hover', array(
        'default' => '#047fe2',
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

    //* Button color
    $wp_customize->add_setting(ASITHEME_SLUG . '_link_color', array(
        'default' => '#000000',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, ASITHEME_SLUG . '_link_color', array(
        'label' => __('Text color', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_colors_links',
        'settings' => ASITHEME_SLUG . '_link_color',
    )));
}

function asitheme_customizer_panel_header($wp_customize) {

    //* Add header setup panel
    $wp_customize->add_section(ASITHEME_SLUG . '_header', array(
        'title' => __('Header', ASITHEME_SLUG),
        'priority' => 12,
    ));

    $wp_customize->add_setting(ASITHEME_SLUG . '_header_position', array(
        'default' => 'relative',
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
        'default' => 50,
    ));

    $wp_customize->add_control(new WP_Customize_Range($wp_customize, ASITHEME_SLUG . '_header_transparency', array(
        'label' => __('Background transparency', ASITHEME_SLUG) . ' (%)',
        'min' => 0,
        'max' => 100,
        'step' => 1,
        'section' => ASITHEME_SLUG . '_header',
    )));
}

function asitheme_customizer_panel_footer($wp_customize) {

    //* Add footer setup panel
    $wp_customize->add_section(ASITHEME_SLUG . '_footer', array(
        'title' => __('Footer', ASITHEME_SLUG),
        'priority' => 13,
    ));

    //* Texto footer
    $wp_customize->add_setting(ASITHEME_SLUG . '_footer_text', array(
        'default' => '[footer_copyright]',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_footer_text', array(
        'label' => __('Text', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_footer',
        'settings' => ASITHEME_SLUG . '_footer_text',
    ));

    //* Menu footer
    $menus = wp_get_nav_menus();
    $choices = array('0' => __('&mdash; Select &mdash;'));
    foreach ($menus as $menu) {
        $choices[$menu->term_id] = wp_html_excerpt($menu->name, 40, '&hellip;');
    }
    $wp_customize->add_setting(ASITHEME_SLUG . '_footer_menu', array(
        'default' => '0',
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
        'title' => __('Font', ASITHEME_SLUG),
        'priority' => 14,
    ));

    //* Main Google Font Setting
    $wp_customize->add_setting(ASITHEME_SLUG . '_font', array(
        'default' => 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Google_Font_Control($wp_customize, ASITHEME_SLUG . '_font', array(
        'label' => __('Google Font', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_font',
        'settings' => ASITHEME_SLUG . '_font',
    )));
}

function asitheme_customizer_panel_social($wp_customize) {

    //* Add Social panel
    $wp_customize->add_section(ASITHEME_SLUG . '_social', array(
        'title' => __('Social networks', ASITHEME_SLUG),
        'priority' => 14,
    ));

    //* Social networks Setting
    $networks = array(
        'Facebook' => 'facebook',
        'Twitter' => 'twitter',
        'Instagram' => 'instagram',
        'Pinterest' => 'pinterest',
        'Google plus' => 'google_plus',
        'Flickr' => 'flickr',
        'Linkedin' => 'linkedin',
        'Skype' => 'skype',
        'TripAdvisor' => 'tripadvisor',
        'Tumblr' => 'tumblr',
        'Vimeo' => 'vimeo',
        'YouTube' => 'youtube'
    );

    foreach ($networks as $key => $value) {

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

    //* Footer active social
    $wp_customize->add_setting(ASITHEME_SLUG . '_social_footer', array(
        'default' => '',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_social_footer', array(
        'label' => __('Add social networks in the footer?', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_footer',
        'settings' => ASITHEME_SLUG . '_social_footer',
        'type' => 'checkbox'
    ));
}

add_action('wp_ajax_search', 'asitheme_wp_ajax_search');

function asitheme_wp_ajax_search() {

    $return = array();

    $search_results = get_posts(array(
        's' => $_POST['q'],
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => 50
    ));

    if ($search_results) {
        foreach ($search_results as $res) {
            $title = (strlen($res->post_title) > 50 ) ? substr($res->post_title, 0, 49) . '...' : $res->post_title;
            $return[] = array($res->ID, $title); // array( Post ID, Post Title )
        }
    }
    echo json_encode($return);
    die;
}
