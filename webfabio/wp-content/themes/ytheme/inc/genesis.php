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

//* Add support for 4-column footer widgets
add_theme_support('genesis-footer-widgets', 4);

//* Add support for after entry widget
add_theme_support('genesis-after-entry-widget-area');

//* Remove secondary menu
remove_action('genesis_after_header', 'genesis_do_subnav');

//* Move navigation to header
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header_right', 'genesis_do_nav');

add_action('wp', 'asitheme_genesis_wp');

function asitheme_genesis_wp() {

    if (is_home() || is_author() || is_archive() || is_search() || is_page_template('page_blog.php')) {

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
}

function asitheme_genesis_do_post_image() {

    global $post;

    $image = false;
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large');
    if ($img && isset($img[0]) && $img[0]) {
        $image = $img[0];
    }
    if (!$image) {
        $image = ASITHEME_CDN . '/assets/images/default-post.jpg';
    }
    if (!$image) {
        return;
    }
    ?>
    <a class="entry-image-link" href="<?php echo get_permalink($post->ID); ?>">
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)) ?>">
    </a>
    <?php
}

function asitheme_genesis_do_post_content_start_wrap() {
    echo '<div class="entry-content-wrap">';
}

function asitheme_genesis_do_post_content_end_wrap() {
    echo '</div>';
}

//* Add Blog title
add_action('genesis_before_content', 'asitheme_genesis_before_content');

function asitheme_genesis_before_content() {
    if (!is_home()) {
        return;
    }
    $blog_title = get_theme_mod(ASITHEME_SLUG . '_blog_title');
    if ($blog_title) {
        echo '<div class="blog-title"><h1>' . apply_filters('the_content', $blog_title) . '</h1></div>';
    }
}

//* Footer Genesis_Simple_Edits full
add_filter('genesis_markup_site-footer_open', 'asitheme_genesis_markup_site_footer_open');

function asitheme_genesis_markup_site_footer_open($open) {

    if (class_exists('Genesis_Simple_Edits')) {
        $settings = Genesis_Simple_Edits()->settings_field;
        if (genesis_get_option('footer_output_on', $settings)) {
            $open = str_replace('class="site-footer"', 'class="site-footer g-simple-edits-full"', $open);
        }
    }

    return $open;
}

//* Footer copyright shortcode
add_shortcode(ASITHEME_SLUG . '_footer_copyright', function ($atts) {
    return sprintf(date('Y') . ' © <a href="' . CHILD_THEME_THEMEURI . '" rel="nofollow" target="_blank">' . CHILD_THEME_NAME . '</a> by <a href="' . CHILD_THEME_AUTHORURI . '" rel="nofollow" target="_blank">' . CHILD_THEME_AUTHOR . '</a>');
});

//* Footer replace <p> with <div>
add_filter('genesis_footer_output', 'asitheme_genesis_footer_wrap', 1);

function asitheme_genesis_footer_wrap($output) {
    if (!$output) {
        return $output;
    }
    $output = preg_replace('/<p>/', '', $output, 1);
    $output = strrev($output);
    $output = preg_replace('/>p\/</', '', $output, 1);
    $output = strrev($output);
    $output = '<div>' . $output . '</div>';
    return $output;
}

//* Footer social
add_filter('genesis_footer_output', 'asitheme_genesis_footer_social');

function asitheme_genesis_footer_social($output) {
    if (!$output) {
        return $output;
    }

    $social_footer = get_theme_mod(ASITHEME_SLUG . '_social_footer', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_social_footer']);
    if (!$social_footer) {
        return $output;
    }

    $class = $output ? 'm' : '';
    $output .= '<div class="social-wrapper social-footer ' . $class . '">';
    foreach (CHILD_THEME_DEFAULTS_NETWORKS as $key => $value) {
        $social_link = get_theme_mod(ASITHEME_SLUG . '_social_' . $value, false);
        if ($social_link) {
            $output .= '<a class="social ' . str_replace('_', '-', $value) . '" href="' . $social_link . '" title="' . $key . '" target="_blank">';
            $output .= '<i class="fab fa-' . str_replace('_', '-', $value) . '"></i>';
            $output .= '</a>';
        }
    }
    $output .= '</div>';

    return $output;
}

//* Modify search icon widtget header

function asitheme_genesis_markup_search_form_submit_open($open) {
    $open = str_replace('<input ', '<button ', $open);
    return $open;
}

function asitheme_genesis_markup_search_form_submit_close($close) {
    $close = '</button>';
    return $close;
}

function asitheme_genesis_markup_search_form_submit_content($content) {
    $content .= '<i class="fas fa-search"></i>';
    return $content;
}

add_filter('dynamic_sidebar_before', 'asitheme_dynamic_sidebar_before');

function asitheme_dynamic_sidebar_before($sidebar) {
    add_filter('genesis_markup_search-form-submit_open', 'asitheme_genesis_markup_search_form_submit_open');
    add_filter('genesis_markup_search-form-submit_close', 'asitheme_genesis_markup_search_form_submit_close');
    add_filter('genesis_markup_search-form-submit_content', 'asitheme_genesis_markup_search_form_submit_content');
}

add_filter('dynamic_sidebar_after', 'asitheme_dynamic_sidebar_after');

function asitheme_dynamic_sidebar_after($sidebar) {
    remove_filter('genesis_markup_search-form-submit_open', 'asitheme_genesis_markup_search_form_submit_open');
    remove_filter('genesis_markup_search-form-submit_close', 'asitheme_genesis_markup_search_form_submit_close');
    remove_filter('genesis_markup_search-form-submit_content', 'asitheme_genesis_markup_search_form_submit_content');
}

function asitheme_genesis_search_button_text() {
    return __('Search', ASITHEME_SLUG);
}

add_filter('genesis_search_text', 'asitheme_genesis_search_text');

function asitheme_genesis_search_text() {
    return __('Search', ASITHEME_SLUG);
}

//* Add menu responsive button
add_action('genesis_header', 'asitheme_genesis_header');

function asitheme_genesis_header() {
    echo '<a id="menu-btn" href="#">';
    echo '<div class="line"></div>';
    echo '<div class="line"></div>';
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
        echo '<div class="sizer"></div>';
        echo '<div class="gutter"></div>';
        echo '</div>';
    }
}

add_filter('genesis_search_form', 'asitheme_genesis_search_form');

function asitheme_genesis_search_form($form) {
    $form = str_replace('type="search" name="s"', 'type="search" required="required" name="s"', $form);
    return $form;
}

add_filter('genesis_attr_site-header', 'asitheme_genesis_attr_site_header');

//* Add classes for the relative or absolute header into site_header
function asitheme_genesis_attr_site_header($attributes) {
    if (isset($attributes['class']) && $attributes['class']) {
        $header_position = get_theme_mod(ASITHEME_SLUG . '_header_position', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_header_position']);
        $attributes['class'] = 'site-header ' . $header_position;
    }
    return $attributes;
}

add_filter('genesis_attr_site-inner', 'asitheme_genesis_attr_site_inner');

//* Add classes for the relative or absolute header into site_inner
function asitheme_genesis_attr_site_inner($attributes) {
    if (isset($attributes['class']) && $attributes['class']) {
        $header_position = get_theme_mod(ASITHEME_SLUG . '_header_position', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_header_position']);
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
add_action('customize_controls_print_styles', 'asitheme_genesis_admin_head');

function asitheme_genesis_admin_head() {
    wp_enqueue_style('admin-genesis-style', ASITHEME_CDN . '/assets/css/admin-genesis-style.css', array(), CHILD_THEME_VERSION);
}

//* 404
add_action('genesis_loop', 'asitheme_genesis_404');

function asitheme_genesis_404() {
    if (!is_404()) {
        return;
    }
    remove_filter('genesis_search_button_text', 'asitheme_genesis_search_button_text_icon');
    add_filter('genesis_search_button_text', 'asitheme_genesis_search_button_text');
    add_action('genesis_pre_get_sitemap', '__return_false');
}
