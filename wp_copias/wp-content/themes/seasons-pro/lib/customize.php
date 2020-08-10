<?php

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

add_action( 'customize_preview_init', 'wps_customize_preview_js' );
function wps_customize_preview_js() {

  wp_enqueue_script( 'wps_customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160705', true );

}

function wps_customizer( $wp_customize ) {

  //* ADD PANELS

  //* add homepage setup panel
  $wp_customize->add_panel( 'wps_homepage', array(
      'title'           => __( 'Homepage Setup', 'seasons-pro' ),
      'priority'        => 10,
  ) );

  //* add webshop setup panel
  $wp_customize->add_section( 'wps_webshop', array(
      'title'           => __( 'Webshop Setup', 'seasons-pro' ),
      'description'     => __( 'For best result use an image with a minimal width of 1140 pixels.' ),
      'priority'        => 10,
  ) );


  //* SETTINGS HOMEPAGE UNIT 1

  //* Create Hero Unit Panel 1 Section
  $wp_customize->add_section( 'wps_hero_unit_one', array(
    'title'             => 'Hero Unit 1', 'seasons-pro',
    'description'       => 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.',
    'panel'             => 'wps_homepage',
  ) );

  //* Hero Title Panel 1
  $wp_customize->add_setting( 'wps_hero_title_one', array(
      'default'         => 'Hi, I am Seasons a MultiPurpose Theme',
      'type'            => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_title_one', array(
      'label'           => __( 'Title', 'seasons-pro' ),
      'section'         => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_title_one',

  ) );

  //* Hero Text Panel 1
  $wp_customize->add_setting( 'wps_hero_text_one', array(
    'default'           => '<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing</a> elit. Praesent vel interdum diam, in ultricies diam. Proin vehicula sagittis lorem, nec.</p>',
    'sanitize_callback' => 'wps_sanitize_text',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_text_one', array(
    'label'             => __( 'Main text', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_text_one',
    'type'              => 'textarea',
  ) );

  //* Hero Text color 1
  $wp_customize->add_setting( 'wps_hero_text_color_1', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_text_color_1', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_text_color_1',
  ) ) );

  //* Hero show button Panel 1
  $wp_customize->add_setting( 'wps_hero_button1_show', array(
    'default'           => 'yes',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'wps_hero_button1_show', array(
    'label'             => __( 'Show button', 'seasons-pro'),
    'section'           => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_button1_show',
    'type'              => 'select',
    'choices'           => array( 'yes' => __( 'Yes', 'seasons-pro' ), 'no' => __( 'No', 'seasons-pro' ) ),
  ) );

  //* Hero button text Panel 1
  $wp_customize->add_setting( 'wps_hero_button1_text', array(
    'default'           => __( 'Push me', 'seasons-pro' ),
    'sanitize_callback' => 'sanitize_text_field',
      'type'            => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_button1_text', array(
    'label'             => __( 'Button text', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_button1_text',
    'type'              => 'text',
  ) );

  //* Hero Button link Panel 1
  $wp_customize->add_setting( 'wps_hero_button1_link', array(
    'default'           => home_url(),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_button1_link', array(
    'label'             => __( 'Button link', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_button1_link',
    'type'              => 'text',
  ) );

  //* Hero background Panel 1
  $wp_customize->add_setting( 'wps_hero_bg_1', array(
    'type'              => 'theme_mod',
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw',
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wps_hero_bg_1', array(
    'label'             => __( 'Background image', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_one',
    'settings'          => 'wps_hero_bg_1',
  ) ) );

  //* SETTINGS HOMEPAGE UNIT 2

  //* Create Hero Unit Panel 2 Section
  $wp_customize->add_section( 'wps_hero_unit_two', array(
    'title'             => 'Hero Unit 2', 'seasons-pro',
    'description'       => 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.',
    'panel'             => 'wps_homepage',
  ) );

  //* Hero Title Panel 2
  $wp_customize->add_setting( 'wps_hero_title_two', array(
      'default'         => 'Hi, I am Seasons a MultiPurpose Theme',
      'type'            => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_title_two', array(
      'label'           => __( 'Title', 'seasons-pro' ),
      'section'         => 'wps_hero_unit_two',
  ) );

  //* Hero Text Panel 2
  $wp_customize->add_setting( 'wps_hero_text_two', array(
    'default'           => '<p>Lorem ipsum dolor sit amet elit. Praesent vel interdum diam, in ultricies diam.</p>',
    'sanitize_callback' => 'wps_sanitize_text',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_text_two', array(
    'label'             => __( 'Main text', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_two',
    'settings'          => 'wps_hero_text_two',
      'type'            => 'textarea',
    ) );

  //* Hero Text color 2
  $wp_customize->add_setting( 'wps_hero_text_color_2', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_text_color_2', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_two',
    'settings'          => 'wps_hero_text_color_2',
  ) ) );

  //* Hero show button Panel 2
  $wp_customize->add_setting( 'wps_hero_button2_show', array(
    'default'           => 'yes',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'wps_hero_button2_show', array(
    'label'             => __( 'Show button', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_two',
    'settings'          => 'wps_hero_button2_show',
    'type'              => 'select',
    'choices'           => array( 'yes' => __( 'Yes', 'seasons-pro' ), 'no' => __( 'No', 'seasons-pro' ) ),
  ) );

  //* Hero button text Panel 2
  $wp_customize->add_setting( 'wps_hero_button2_text', array(
    'default'           => __( 'Push me', 'seasons-pro' ),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_button2_text', array(
    'label'             => __( 'Button text', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_two',
    'settings'          => 'wps_hero_button2_text',
    'type'              => 'text',
  ) );

  //* Hero Button link Panel 2
  $wp_customize->add_setting( 'wps_hero_button2_link', array(
    'default'           => home_url(),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_button2_link', array(
    'label'             => __( 'Button link', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_two',
    'settings'          => 'wps_hero_button2_link',
    'type'              => 'text',
  ) );

  //* Hero background Panel 2
  $wp_customize->add_setting( 'wps_hero_bg_2', array(
    'type'              => 'theme_mod',
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw',
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wps_hero_bg_2', array(
    'label'             => __( 'Background image', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_two',
    'settings'          => 'wps_hero_bg_2',
  ) ) );

  //* SETTINGS HOMEPAGE UNIT 3

  //* Create Hero Unit Panel 3 Section
  $wp_customize->add_section( 'wps_hero_unit_three', array(
    'title'             => 'Hero Unit 3', 'seasons-pro',
    'description'       => 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.',
    'panel'             => 'wps_homepage',
  ) );

  //* Hero Title Panel 3
  $wp_customize->add_setting( 'wps_hero_title_three', array(
      'default'         => 'Hi, I am Seasons a MultiPurpose Theme',
      'type'            => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_title_three', array(
      'label'           => __( 'Title', 'seasons-pro' ),
      'section'         => 'wps_hero_unit_three',
  ) );

  //* Hero Text Panel 3
  $wp_customize->add_setting( 'wps_hero_text_three', array(
    'default'           => '<p>Lorem ipsum dolor sit amet elit. Praesent vel interdum diam, in ultricies diam.</p>',
    'sanitize_callback' => 'wps_sanitize_text',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_text_three', array(
    'label'             => __( 'Main text', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_three',
    'settings'          => 'wps_hero_text_three',
    'type'              => 'textarea',
  ) );

  //* Hero Text color 3
  $wp_customize->add_setting( 'wps_hero_text_color_3', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_text_color_3', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_three',
    'settings'          => 'wps_hero_text_color_3',
  ) ) );

  //* Hero show button Panel 3
  $wp_customize->add_setting( 'wps_hero_button3_show', array(
    'default'           => 'yes',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'wps_hero_button3_show', array(
    'label'             => __( 'Show button', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_three',
    'settings'          => 'wps_hero_button3_show',
    'type'              => 'select',
    'choices'           => array( 'yes' => __( 'Yes', 'seasons-pro' ), 'no' => __( 'No', 'seasons-pro' ) ),
  ) );

  //* Hero button text Panel 3
  $wp_customize->add_setting( 'wps_hero_button3_text', array(
    'default'           => __( 'Push me', 'seasons-pro' ),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_button3_text', array(
    'label'             => __( 'Button text', 'seasons-pro'),
    'section'           => 'wps_hero_unit_three',
    'settings'          => 'wps_hero_button3_text',
    'type'              => 'text',
  ) );

  //* Hero Button link Panel 3
  $wp_customize->add_setting( 'wps_hero_button3_link', array(
    'default'           => home_url(),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_button3_link', array(
    'label'             => __( 'Button link', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_three',
    'settings'          => 'wps_hero_button3_link',
    'type'              => 'text',
  ) );

  //* Hero background Panel 3
  $wp_customize->add_setting( 'wps_hero_bg_3', array(
    'type'              => 'theme_mod',
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw',
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wps_hero_bg_3', array(
    'label'             => __( 'Background image', 'seasons-pro' ),
    'section'           => 'wps_hero_unit_three',
    'settings'          => 'wps_hero_bg_3',
  ) ) );

  //* SETTINGS HOMEPAGE CTA

  //* Create Hero Unit Panel 3 Section
  $wp_customize->add_section( 'wps_cta_boxes', array(
    'title'             => 'CTA boxes', 'altitude',
    'description'       => 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.',
    'panel'             => 'wps_homepage',
  ) );

  //* Show hide 3 CTA sections
  $wp_customize->add_setting( 'wps_cta_show', array(
    'default'           => 'yes',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'wps_cta_show', array(
    'label'             => __( 'Show cta sections', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_show',
    'type'              => 'select',
    'choices'           => array( 'yes' => __( 'Yes', 'seasons-pro' ), 'no' => __( 'No', 'seasons-pro' ) ),
  ) );

  //* Hero Text CTA 1
  $wp_customize->add_setting( 'wps_cta_text_one', array(
      'default'         => '<i class="fa fa-plane"></i><h3>Free Shipping Wordwide</h3><p>Guranteed Delivery in 3 Days</p>',
    'sanitize_callback' => 'wps_sanitize_text',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_cta_text_one', array(
      'label'           => __( 'Text Box 1', 'seasons-pro' ),
      'section'         => 'wps_cta_boxes',
      'settings'        => 'wps_cta_text_one',
      'type'            => 'textarea',
  ) );

  //* Text color CTA 1
  $wp_customize->add_setting( 'wps_cta_color_one', array(
    'default'           => '#3f3f3f',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_color_1', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_color_one',
  ) ) );

  //* BG Color Box 1
  $wp_customize->add_setting( 'wps_cta_bgcolor_one', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_bgcolor_1', array(
    'label'             => __( 'Background color', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_bgcolor_one',
  ) ) );

  //* Link Box 1
  $wp_customize->add_setting( 'wps_cta_link_one', array(
    'default'           => home_url(),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'cta_link_1', array(
    'label'             => __( 'Link', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_link_one',
    'type'              => 'text',
  ) );

  //* Hero Text CTA 2
  $wp_customize->add_setting( 'wps_cta_text_two', array(
      'default'         => '<i class="fa fa-comments-o"></i><h3>24/7 Customer service</h3><p>Call us at 026-4464-920</p>',
      'type'            => 'theme_mod',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_text',
  ) );

  $wp_customize->add_control( 'wps_cta_text_two', array(
      'label'           => __( 'Text Box 2', 'seasons-pro' ),
      'section'         => 'wps_cta_boxes',
      'type'            => 'textarea',
  ) );

  //* Text color CTA 2
  $wp_customize->add_setting( 'wps_cta_color_two', array(
    'default'           => '#3f3f3f',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_color_2', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_color_two',
  ) ) );

  //* BG Color Box 2
  $wp_customize->add_setting( 'wps_cta_bgcolor_two', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_bgcolor_2', array(
    'label'             => __( 'Background color', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_bgcolor_two',
  ) ) );

  //* Link Box 2
  $wp_customize->add_setting( 'wps_cta_link_two', array(
    'default'           => home_url(),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'cta_link_2', array(
    'label'             => __( 'Link', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_link_two',
    'type'              => 'text',
  ) );

  //* Hero Text CTA 3
  $wp_customize->add_setting( 'wps_cta_text_three', array(
      'default'         => '<i class="fa fa-refresh"></i><h3>Money Back Guarantee</h3><p>Send within 21 days</p>',
      'type'            => 'theme_mod',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_text',
  ) );

  $wp_customize->add_control( 'wps_cta_text_three', array(
      'label'           => __( 'Text Box 3', 'seasons-pro' ),
      'section'         => 'wps_cta_boxes',
      'type'            => 'textarea',
  ) );

  //* Text color CTA 3
  $wp_customize->add_setting( 'wps_cta_color_three', array(
    'default'           => '#3f3f3f',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_color_3', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_color_three',
  ) ) );

  //* BG Color Box 3
  $wp_customize->add_setting( 'wps_cta_bgcolor_three', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cta_bgcolor_3', array(
    'label'             => __( 'Background color', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_bgcolor_three',
  ) ) );

  //* Link Box 3
  $wp_customize->add_setting( 'wps_cta_link_three', array(
    'default'           => home_url(),
    'sanitize_callback' => 'sanitize_text_field',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'cta_link_3', array(
    'label'             => __( 'Link', 'seasons-pro' ),
    'section'           => 'wps_cta_boxes',
    'settings'          => 'wps_cta_link_three',
    'type'              => 'text',
  ) );

  //* SETTINGS TESTIMONIALS

  //* Create Hero Unit Panel 1 Section
  $wp_customize->add_section( 'wps_testimonials', array(
    'title'             => 'Testimonials', 'seasons-pro',
    'description'       => 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.',
    'panel'             => 'wps_homepage',
  ) );

  //* Background Testimonials
  $wp_customize->add_setting( 'wps_bg_testimonials', array(
    'type'              => 'theme_mod',
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw',
  ) );

  //* Background Trstimonials fixed
  $wp_customize->add_setting( 'wps_testimonials_fixed', array(
    'default'           => 'yes',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'wps_testimonials_fixed', array(
    'label'             => __( 'Background Fixed', 'seasons-pro' ),
    'section'           => 'wps_testimonials',
    'settings'          => 'wps_testimonials_fixed',
    'type'              => 'select',
    'choices'           => array( 'yes' => __( 'Yes', 'seasons-pro' ), 'no' => __( 'No', 'seasons-pro' ) ),
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wps_bg_testimonials', array(
    'label'             => __( 'Background image', 'seasons-pro' ),
    'section'           => 'wps_testimonials',
    'settings'          => 'wps_bg_testimonials',
  ) ) );

  //* SETTINGS WEBSHOP PAGE

  //* Webshop background
  $wp_customize->add_setting( 'wps_hero_bg_shop', array(
    'type'              => 'theme_mod',
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw',
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wps_hero_bg_shop', array(
    'label'             => __( 'Background image', 'seasons-pro' ),
    'section'           => 'wps_webshop',
    'settings'          => 'wps_hero_bg_shop',
  ) ) );

  //* Webshop text
  $wp_customize->add_setting( 'wps_hero_text_webshop', array(
    'default'           => '<p>Set your subtitle true the customizer</p>',
    'sanitize_callback' => 'wps_sanitize_text',
    'type'              => 'theme_mod',
    'transport'         => 'postMessage',
  ) );

  $wp_customize->add_control( 'wps_hero_text_webshop', array(
    'label'             => __( 'Subtitle', 'seasons-pro' ),
    'section'           => 'wps_webshop',
    'settings'          => 'wps_hero_text_webshop',
    'type'              => 'textarea',
  ) );

  //* Webshop Text color 1
  $wp_customize->add_setting( 'wps_hero_color_webshop', array(
    'default'           => '#fff',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wps_sanitize_color_hex',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_color_webshop', array(
    'label'             => __( 'Text color', 'seasons-pro' ),
    'section'           => 'wps_webshop',
    'settings'          => 'wps_hero_color_webshop',
  ) ) );

}

function wps_sanitize_color_hex( $value )
{
  if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
    $value = '#ffffff';
  }

  return $value;
}

function wps_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

add_action( 'customize_register', 'wps_customizer' );