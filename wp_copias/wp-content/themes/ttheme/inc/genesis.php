<?php
//* Add Accessibility support
add_theme_support('genesis-accessibility', array('headings', 'drop-down-menu', 'search-form', 'skip-links', 'rems'));

//* Add viewport meta tag for mobile browsers
add_theme_support('genesis-responsive-viewport');

//* Remove genesis layouts
genesis_unregister_layout('content-sidebar');
genesis_unregister_layout('sidebar-content');
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');
genesis_unregister_layout('sidebar-content-sidebar');
genesis_unregister_layout('full-width-content');

//* Remove sidebars
unregister_sidebar('sidebar');
unregister_sidebar('sidebar-alt');
unregister_sidebar('header-right');

//* Remove secondary menu
remove_action('genesis_after_header', 'genesis_do_subnav');

//* Remove site description header
remove_action('genesis_site_description', 'genesis_seo_site_description');

//* Move navigation to header
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header_right', 'genesis_do_nav');

add_action('wp', 'asitheme_genesis_wp');

function asitheme_genesis_wp() {

    if (is_home() || is_author() || is_archive() || is_search() || is_page_template('page_blog.php')) {
        asitheme_genesis_filters_actions_loop();
    }
}

function asitheme_genesis_filters_actions_loop() {

    //* Remove the entry meta in the entry header (requires HTML5 theme support)
    remove_action('genesis_entry_header', 'genesis_post_info', 12);

    //* Remove the entry meta in the entry footer (requires HTML5 theme support)
    remove_action('genesis_entry_footer', 'genesis_post_meta');

    remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
    remove_action('genesis_entry_content', 'genesis_do_post_content');
    add_action('genesis_entry_header', 'asitheme_genesis_do_post_image', 1);

    add_action('genesis_entry_header', 'asitheme_genesis_do_post_content_start_wrap', 2);
    add_action('genesis_entry_footer', 'asitheme_genesis_do_post_content_end_wrap', 100);

    add_filter('genesis_pre_get_option_content_archive', 'asitheme_genesis_pre_get_option_content_archive');
}

function asitheme_genesis_do_post_image() {

    global $post;

    $featured = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large');
    if ($featured) {
        ?>
        <a class="entry-image-link" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url('<?php echo $featured[0] ?>');"></a>
        <?php
    }
}

function asitheme_genesis_do_post_content_start_wrap() {
    echo '<div class="entry-content-wrap">';
}

function asitheme_genesis_do_post_content_end_wrap() {
    echo '</div>';
}

//* Add secondary menu to footer
add_filter('genesis_footer_output', 'asitheme_genesis_footer_output', 10, 3);

function asitheme_genesis_footer_output($output, $backtotop_text, $creds_text) {

    $text = get_theme_mod(ASITHEME_SLUG . '_footer_text', '[footer_copyright]');
    $menu = get_theme_mod(ASITHEME_SLUG . '_footer_menu');
    $social_footer = get_theme_mod(ASITHEME_SLUG . '_social_footer', false);

    $string = '';
    if ($text) {
        $string = sprintf('<span>' . $text . '</span>', get_bloginfo('name'));
    }
    if ($menu) {
        if ($string) {
            $string .= '  <span>&#x000B7;</span>  ';
        }
        $string .= sprintf('<div class="menu-footer-wrapper">%s</div>', wp_nav_menu(array('menu' => $menu, 'echo' => false)));
    }

    if ($social_footer) {

        $class = '';
        if ($string) {
            $class = 'm';
        }

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

        $string .= '<div class="social-wrapper social-footer ' . $class . '">';
        foreach ($networks as $key => $value) {
            $social_link = get_theme_mod(ASITHEME_SLUG . '_social_' . $value, false);
            if ($social_link) {
                $string .= '<a class="social ' . str_replace('_', '-', $value) . '" href="' . $social_link . '" title="' . $key . '" target="_blank">';
                $string .= '<i class="fa fa-' . str_replace('_', '-', $value) . '"></i>';
                $string .= '</a>';
            }
        }
        $string .= '</div>';
    }

    return '<div>' . $string . '</div>';
}

//* Modify search icon
add_filter('genesis_search_button_text', 'asitheme_genesis_search_button_text_icon');

function asitheme_genesis_search_button_text_icon() {
    return esc_attr('&#xf002;');
}

function asitheme_genesis_search_button_text() {
    return __('Search', ASITHEME_SLUG);
}

add_filter('genesis_search_text', 'asitheme_genesis_search_text');

function asitheme_genesis_search_text() {
    return __('Search in the web...', ASITHEME_SLUG);
}

//* Add Cart icon and count to header if WC is active
add_action('genesis_header_right', 'asitheme_genesis_header_right');

function asitheme_genesis_header_right() {
    echo '<section class="widget widget_search"><div class="widget-wrap">';
    get_search_form(true);
    echo '</div></section>';
}

//* Add menu responsive button
add_action('genesis_header', 'asitheme_genesis_header');

function asitheme_genesis_header() {
    echo '<a id="menu-btn" href="#">';
    echo '<div class="line"></div>';
    echo '</a>';
}

function asitheme_genesis_pre_get_option_content_archive() {
    return 'excerpts';
}

add_theme_support('custom-logo', array(
    'height' => 80,
    'width' => 270,
    'flex-height' => true,
    'flex-width' => true,
));

add_filter('genesis_seo_title', 'asitheme_genesis_seo_title', 10, 3);

function asitheme_genesis_seo_title($title, $inside, $wrap) {

    if (function_exists('has_custom_logo') && has_custom_logo()) {
        $inside = sprintf('%s', get_custom_logo());
    } else {
        $inside = sprintf('<a href="%s" title="%s">%s</a>', trailingslashit(home_url()), esc_attr(get_bloginfo('name')), esc_attr(get_bloginfo('name')));
    }

    $wrap = is_front_page() && 'title' === genesis_get_seo_option('home_h1_on') ? 'h1' : 'p';
    $wrap = is_front_page() && !genesis_get_seo_option('home_h1_on') ? 'h1' : $wrap;
    $wrap = genesis_html5() && genesis_get_seo_option('semantic_headings') ? 'h1' : $wrap;
    $title = sprintf('<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr('site-title'), $inside);

    return $title;
}

add_action('genesis_before_while', 'asitheme_genesis_before_while', 20);

function asitheme_genesis_before_while() {
    if (is_home() || is_author() || is_archive() || is_search() || is_page_template('page_blog.php')) {
        echo '<div class="asi-posts-wrapper">';
    }
}

add_action('genesis_after_endwhile', 'asitheme_genesis_after_endwhile', 5);

function asitheme_genesis_after_endwhile() {
    if (is_home() || is_author() || is_archive() || is_search() || is_page_template('page_blog.php')) {
        echo '</div>';
    }
}

add_filter('genesis_search_form', 'asitheme_genesis_search_form');

function asitheme_genesis_search_form($form) {
    $form = str_replace('type="search" name="s"', 'type="search" required="required" name="s"', $form);
    return $form;
}

add_filter('genesis_attr_site-header', 'asitheme_genesis_attr_site_header');

function asitheme_genesis_attr_site_header($attributes) {
    if (isset($attributes['class']) && $attributes['class']) {
        $header_position = get_theme_mod(ASITHEME_SLUG . '_header_position', 'relative');
        $attributes['class'] = 'site-header ' . $header_position;
    }
    return $attributes;
}

add_filter('genesis_attr_site-inner', 'asitheme_genesis_attr_site_inner');

function asitheme_genesis_attr_site_inner($attributes) {
    if (isset($attributes['class']) && $attributes['class']) {
        $header_position = get_theme_mod(ASITHEME_SLUG . '_header_position', 'relative');
        $attributes['class'] = 'site-inner ' . $header_position;
    }
    return $attributes;
}

//* Remove metaboxes of Genesis Theme Settings
add_action('genesis_admin_before_metaboxes', 'asitheme_genesis_admin_before_metaboxes');

function asitheme_genesis_admin_before_metaboxes() {
    remove_meta_box('genesis-theme-settings-header', 'toplevel_page_genesis', 'main');
}

//* Add admin custom css
add_action('admin_head', 'asitheme_genesis_admin_head');

function asitheme_genesis_admin_head() {
    wp_enqueue_style('admin-genesis-style', ASITHEME_CDN . '/assets/css/admin-genesis-style.css', array(), CHILD_THEME_VERSION);
}
