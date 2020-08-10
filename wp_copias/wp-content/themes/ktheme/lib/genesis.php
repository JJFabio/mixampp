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

//* Remove Sub navigation
remove_action('genesis_after_header', 'genesis_do_subnav');

//* Move navigation to header
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header_right', 'genesis_do_nav');

function ktheme_genesis_wp() {

    if (is_home() || is_author() || is_archive() || is_search()) {
        ktheme_genesis_filters_actions_loop();
    }

    if (is_singular('post')) {
        ktheme_genesis_filters_actions_single();
    }
}

add_action('wp', 'ktheme_genesis_wp');

function ktheme_genesis_filters_actions_loop() {

    //* Remove title blog template
    remove_action('genesis_before_loop', 'genesis_do_blog_template_heading');

    //* Remove the entry meta in the entry header (requires HTML5 theme support)
    remove_action('genesis_entry_header', 'genesis_post_info', 12);

    //* Remove the entry meta in the entry footer (requires HTML5 theme support)
    remove_action('genesis_entry_footer', 'genesis_post_meta');

    remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
    add_action('genesis_entry_header', 'ktheme_genesis_do_post_image', 1);

    add_action('genesis_entry_header', 'ktheme_genesis_do_post_content_start_wrap', 2);
    add_action('genesis_entry_footer', 'ktheme_genesis_do_post_content_end_wrap', 100);

    add_filter('genesis_pre_get_option_content_archive', 'ktheme_genesis_pre_get_option_content_archive');
}

function ktheme_genesis_filters_actions_single() {

    remove_action('genesis_entry_header', 'genesis_post_info', 12);
    add_action('genesis_entry_header', 'genesis_post_info', 9);
}

//* Add secondary menu to footer
function ktheme_genesis_footer_output($output, $backtotop_text, $creds_text) {

    $text = get_theme_mod('ktheme_footer_text', '[footer_copyright before="%s "]');
    $menu = get_theme_mod('ktheme_footer_menu');

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

    return '<div>' . $string . '</div>';
}

add_filter('genesis_footer_output', 'ktheme_genesis_footer_output', 10, 3);

//* Modify search icon
function ktheme_genesis_search_button_text_icon() {
    return esc_attr('&#xf002;');
}

add_filter('genesis_search_button_text', 'ktheme_genesis_search_button_text_icon');

function ktheme_genesis_search_button_text() {
    return __('Buscar', 'ktheme');
}

function ktheme_genesis_search_text() {
    return __('Buscar en la web...', 'ktheme');
}

add_filter('genesis_search_text', 'ktheme_genesis_search_text');

//* Add Cart icon and count to header if WC is active
function ktheme_genesis_header_right() {

    echo '<section class="widget widget_search"><div class="widget-wrap">';
    get_search_form(true);
    echo '</div></section>';
}

add_action('genesis_header_right', 'ktheme_genesis_header_right');

//* Add menu responsive button
function ktheme_genesis_header() {
    echo '<a id="menu-btn" href="#">';
    echo '<div class="line"></div>';
    echo '</a>';
}

add_action('genesis_header', 'ktheme_genesis_header');

function ktheme_genesis_do_post_image() {

    global $post;

    $featured = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large');
    if ($featured) {
        ?>
        <a class="entry-image-link" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url('<?php echo $featured[0] ?>');"></a>
        <?php
    }
}

function ktheme_genesis_pre_get_option_content_archive() {
    return 'excerpts';
}

function ktheme_genesis_do_post_content_start_wrap() {
    echo '<div class="entry-content-wrap">';
}

function ktheme_genesis_do_post_content_end_wrap() {
    echo '</div>';
}

add_theme_support('custom-logo', array(
    'height' => 40,
    'width' => 135,
    'flex-height' => true,
    'flex-width' => true,
));

function ktheme_genesis_seo_title($title, $inside, $wrap) {

    if (function_exists('has_custom_logo') && has_custom_logo()) :

        $logo = the_custom_logo();

    else :

        $logo = get_bloginfo('name');

    endif;

    $inside = sprintf('<a href="%s" title="%s">%s</a>', trailingslashit(home_url()), esc_attr(get_bloginfo('name')), $logo);
    $wrap = is_front_page() && 'title' === genesis_get_seo_option('home_h1_on') ? 'h1' : 'p';
    $wrap = is_front_page() && !genesis_get_seo_option('home_h1_on') ? 'h1' : $wrap;
    $wrap = genesis_html5() && genesis_get_seo_option('semantic_headings') ? 'h1' : $wrap;
    $title = sprintf('<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr('site-title'), $inside);
    return $title;
}

add_filter('genesis_seo_title', 'ktheme_genesis_seo_title', 10, 3);

function ktheme_genesis_before_loop() {
    if (is_home() || is_author() || is_archive() || is_search()) {
        echo '<div class="asi-posts-wrapper">';
    }
}

add_action('genesis_before_loop', 'ktheme_genesis_before_loop', 20);

function ktheme_genesis_after_endwhile() {
    if (is_home() || is_author() || is_archive() || is_search()) {
        echo '<div class="clear"></div></div>';
    }
}

add_action('genesis_after_endwhile', 'ktheme_genesis_after_endwhile', 5);

function ktheme_genesis_search_form($form) {
    $form = str_replace('type="search" name="s"', 'type="search" required="required" name="s"', $form);
    return $form;
}

add_filter('genesis_search_form', 'ktheme_genesis_search_form');

function ktheme_genesis_attr_entry($attributes) {
    if (isset($attributes['class']) && $attributes['class']) {
        $attributes['class'] .= ' asicolumn';
    }
    return $attributes;
}

add_filter('genesis_attr_entry', 'ktheme_genesis_attr_entry');
