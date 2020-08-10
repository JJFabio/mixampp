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

function ftheme_wp() {

    if (is_front_page() || is_archive()) {
        ftheme_genesis_filters_actions_loop();
    }
}

add_action('wp', 'ftheme_wp');

function ftheme_genesis_filters_actions_loop() {

    //* Remove title blog template
    remove_action('genesis_before_loop', 'genesis_do_blog_template_heading');

    //* Remove the entry meta in the entry header (requires HTML5 theme support)
    remove_action('genesis_entry_header', 'genesis_post_info', 12);

    //* Remove the entry meta in the entry footer (requires HTML5 theme support)
    remove_action('genesis_entry_footer', 'genesis_post_meta');

    remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
    add_action('genesis_entry_header', 'ftheme_genesis_do_post_image', 4);

    remove_action('genesis_entry_content', 'genesis_do_post_content');
    add_action('genesis_entry_header', 'ftheme_genesis_do_post_content_1', 12);
    add_action('genesis_entry_header', 'genesis_do_post_content', 13);
    add_action('genesis_entry_header', 'ftheme_genesis_do_post_content_2', 14);

    add_filter('genesis_pre_get_option_content_archive', 'ftheme_genesis_pre_get_option_content_archive');

    //* Ajax load more
    add_action('genesis_before_loop', 'ftheme_genesis_before_loop', 20);
    add_action('genesis_after_loop', 'ftheme_genesis_after_loop');
    //* Remove Archive Pagination
    remove_action('genesis_after_endwhile', 'genesis_posts_nav');
}

function ftheme_genesis_do_post_image() {

    global $post;

    $featured = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    ?>

    <div class="entry-image-link-wrapper">
        <a class="entry-image-link" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url('<?php echo $featured[0] ?>');"></a>
    </div>

    <?php
}

function ftheme_genesis_pre_get_option_content_archive() {
    return 'excerpts';
}

function ftheme_genesis_do_post_content_1() {
    printf('<div %s>', genesis_attr('entry-content'));
}

function ftheme_genesis_do_post_content_2() {
    echo '</div>';
}

function ftheme_genesis_before_loop() {
    echo '<div class="post-listing">';
}

function ftheme_genesis_after_loop() {
    echo '<button class="load-more">' . __('Más episodios', 'ftheme') . '</button></div>';
    echo '<img class="ajax-loader" src="' . FTHEME_CDN . '/images/ajax-loader.gif"/>';
    echo '</div>';
}

//* Add secondary menu to footer
function ftheme_genesis_footer_output($output, $backtotop_text, $creds_text) {

    $text = get_theme_mod('ftheme_footer_text', '[footer_copyright before="%s "]');
    $menu = get_theme_mod('ftheme_footer_menu');

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

add_filter('genesis_footer_output', 'ftheme_genesis_footer_output', 10, 3);

//* Modify search icon
function ftheme_genesis_search_button_text_icon() {
    return esc_attr('&#xf002;');
}

add_filter('genesis_search_button_text', 'ftheme_genesis_search_button_text_icon');

function ftheme_genesis_search_button_text() {
    return __('Buscar', 'ftheme');
}

function ftheme_genesis_search_text() {
    return __('Buscar en la web...', 'ftheme');
}

add_filter('genesis_search_text', 'ftheme_genesis_search_text');

//* Add Cart icon and count to header if WC is active
function ftheme_genesis_header_right() {

    echo '<section class="widget widget_search"><div class="widget-wrap">';
    get_search_form(true);
    echo '</div></section>';
}

add_action('genesis_header_right', 'ftheme_genesis_header_right');

//* Add menu responsive button
function ftheme_genesis_header() {
    echo '<a id="menu-btn" href="#">';
    echo '<div class="line"></div>';
    echo '</a>';
}

add_action('genesis_header', 'ftheme_genesis_header');

add_theme_support('custom-logo', array(
    'height' => 40,
    'width' => 135,
    'flex-height' => true,
    'flex-width' => true,
));

function ftheme_genesis_seo_title($title, $inside, $wrap) {

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

add_filter('genesis_seo_title', 'ftheme_genesis_seo_title', 10, 3);

function ftheme_genesis_search_form($form) {
    $form = str_replace('type="search" name="s"', 'type="search" required="required" name="s"', $form);
    return $form;
}

add_filter('genesis_search_form', 'ftheme_genesis_search_form');
