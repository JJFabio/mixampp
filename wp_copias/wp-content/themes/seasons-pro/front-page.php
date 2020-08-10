<?php

/**
 *
 * @author      WPStudio
 * @package     Seasons Pro
 * @link        https://www.wpstud.io/themes
 */

if( !defined( 'ABSPATH' ) ) exit;

//* Force full width page layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add intro widget area
add_filter('wps_content_area', 'wps_front_intro', 20);
function wps_front_intro() {

    $wps_show_hero_button1 = get_theme_mod( 'wps_hero_button1_show', 'yes' );
    $wps_show_hero_button2 = get_theme_mod( 'wps_hero_button2_show', 'yes' );
    $wps_show_hero_button3 = get_theme_mod( 'wps_hero_button3_show', 'yes' );
    $wps_show_hero_banner  = get_theme_mod( 'wps_cta_show', 'yes' );
    $wps_cta_link_one      = get_theme_mod( 'wps_cta_link_one' );
    $wps_cta_link_two      = get_theme_mod( 'wps_cta_link_two' );
    $wps_cta_link_three    = get_theme_mod( 'wps_cta_link_three' );

    echo '<div id="front-intro">';
    echo '<div class="fp-section-1">';
    echo '<div class="inner fadeup"><div class="wrap">';
    echo '<h2>' . get_theme_mod( 'wps_hero_title_one' ) . '</h2>';
    echo '<div class="text">' . get_theme_mod( 'wps_hero_text_one' ) .'</div>';

    if ( $wps_show_hero_button1 === 'yes' ) {

        echo '<a href="' . esc_url( get_theme_mod( 'wps_hero_button1_link', '#' ) ) . '" class="button">' . esc_html( get_theme_mod( 'wps_hero_button1_text' ) ) . '</a>';

    }

    echo '</div></div></div>';
    echo '<div class="fp-section-2">';
    echo '<div class="inner fadeup"><div class="wrap">';
    echo '<h2>' . get_theme_mod( 'wps_hero_title_two' ) . '</h2>';
    echo '<div class="text">' . get_theme_mod( 'wps_hero_text_two' ) .'</div>';

    if ( $wps_show_hero_button2 === 'yes' ) {

        echo '<a href="' . esc_url( get_theme_mod( 'wps_hero_button2_link', '#' ) ) . '" class="button">' . esc_html( get_theme_mod( 'wps_hero_button2_text' ) ) . '</a>';

    }

    echo '</div></div></div>';
    echo '<div class="fp-section-3">';
    echo '<div class="inner fadeup"><div class="wrap">';
    echo '<h2>' . get_theme_mod( 'wps_hero_title_three' ) . '</h2>';
    echo '<div class="text">' . get_theme_mod( 'wps_hero_text_three' ) .'</div>';

    if ( $wps_show_hero_button3 === 'yes' ) {

        echo '<a href="' . esc_url( get_theme_mod( 'wps_hero_button3_link', '#' ) ) . '" class="button">' . esc_html( get_theme_mod( 'wps_hero_button3_text' ) ) . '</a>';

    }

    echo '</div></div></div>';

    if ( $wps_show_hero_banner === 'yes' )  {

        echo '<div class="front-section fp-section-4">';
        echo '<div class="inner"><div class="wrap">';
        if ( '' !== get_theme_mod( 'wps_cta_link_one' ) ) {

            echo '<a class="box-link" href="' . $wps_cta_link_one . '">';
            echo get_theme_mod( 'wps_cta_text_one' );
            echo '</a>';

        }

        else {

            echo get_theme_mod( 'wps_cta_text_one' );

        }

        echo '</div></div></div>';

        echo '<div class="front-section fp-section-5">';
        echo '<div class="inner"><div class="wrap">';
        if ( '' !== get_theme_mod( 'wps_cta_link_two' ) ) {

            echo '<a class="box-link"href="' . $wps_cta_link_two . '">';
            echo get_theme_mod( 'wps_cta_text_two' );
            echo '</a>';

        }

        else {

            echo get_theme_mod( 'wps_cta_text_two' );

        }

        echo '</div></div></div>';

        echo '<div class="front-section fp-section-6">';
        echo '<div class="inner"><div class="wrap">';
        if ( '' !== get_theme_mod( 'wps_cta_link_three' ) ) {

            echo '<a class="box-link" href="' . $wps_cta_link_three . '">';
            echo get_theme_mod( 'wps_cta_text_three' );
            echo '</a>';

        }

        else {

            echo get_theme_mod( 'wps_cta_text_three' );

        }

        echo '</div></div></div>';

    }

    echo '</div></div>';


}

//* Add widget area one
add_filter('wps_content_area', 'wps_widget_front_one', 30);
function wps_widget_front_one() {

    genesis_widget_area( 'widget_after_header_one', array(
    'before' => '<div id="front-row-one" class="front-section">',
    'after'  => '</div>',
    ) );

}

//* Add widget area two
add_filter('genesis_before_footer', 'wps_widget_front_two', 5);
function wps_widget_front_two() {

    genesis_widget_area( 'widget_after_header_three', array(
    'before' => '<div id="front-section-2" class="front-section"><div class="wrap">',
    'after'  => '</div></div>',
    ) );

}

//* Add widget area three
add_filter('genesis_before_footer', 'wps_widget_front_three', 4);
function wps_widget_front_three() {

     genesis_widget_area( 'widget_after_header_two', array(
     'before' => '<div id="front-section-3"><div class="wrap">',
     'after'  => '</div></div>',
    ) );

}

//* Add widget area four
add_filter('genesis_before_footer', 'wps_widget_front_four', 5);
function wps_widget_front_four() {

     genesis_widget_area( 'widget_home_four', array(
     'before' => '<div id="front-section-4"><div class="wrap' . wps_widget_area_class( 'widget_home_four' ) .'">',
     'after'  => '</div></div>',
    ) );

}

//* Add widget area five
add_filter('genesis_before_footer', 'wps_widget_front_five', 5);
function wps_widget_front_five() {

     genesis_widget_area( 'widget_home_five', array(
     'before' => '<div id="front-section-5"><div class="wrap">',
     'after'  => '</div></div>',
    ) );

}

//* Build the page
get_header();
do_action('wps_content_area');
get_footer();