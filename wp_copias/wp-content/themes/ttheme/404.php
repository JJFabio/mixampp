<?php

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'genesis_404');

function genesis_404() {

    genesis_markup(array(
        'open' => '<article class="entry">',
        'context' => 'entry-404',
    ));

    printf('<h1 class="entry-title">%s</h1>', apply_filters('genesis_404_entry_title', __('Typical error 404', ASITHEME_SLUG)));
    echo '<div class="entry-content">';

    if (genesis_html5()) {
        echo apply_filters('genesis_404_entry_content', '<p>' . __("It seems this page doesn't exist, or you've followed an incorrect link. Please, try to use this search feature to find what you're looking for:", ASITHEME_SLUG) . '</p>');
        remove_filter('genesis_search_button_text', 'asitheme_genesis_search_button_text_icon');
        add_filter('genesis_search_button_text', 'asitheme_genesis_search_button_text');
        get_search_form();
    } else {
        echo apply_filters('genesis_404_entry_content', '<p>' . __("It seems this page doesn't exist, or you've followed an incorrect link. Please, try to use this search feature to find what you're looking for:", ASITHEME_SLUG) . '</p>');
    }

    echo '</div>';

    genesis_markup(array(
        'close' => '</article>',
        'context' => 'entry-404',
    ));
}

genesis();
