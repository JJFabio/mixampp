<?php

add_action('genesis_loop', 'ftheme_genesis_loop_blog_template', 5);

function ftheme_genesis_loop_blog_template() {

    $content = get_theme_mod('ftheme_frontpage_title_page');

    echo '<div class="page-description">';
    echo apply_filters('the_content', $content);
    echo '</div>';
}

genesis();
