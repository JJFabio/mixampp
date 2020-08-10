<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'genesis_404');

function genesis_404() {

    genesis_markup(array(
        'open' => '<article class="entry">',
        'context' => 'entry-404',
    ));

    printf('<h1 class="entry-title">%s</h1>', apply_filters('genesis_404_entry_title', __('Típico error 404', 'ftheme')));
    echo '<div class="entry-content">';

    if (genesis_html5()) :

        echo apply_filters('genesis_404_entry_content', '<p>' . __('Parece ser que has llegado a una página que no existe, o te han enlazado mal. Prueba de buscar el contenido que quieres encontrar usando este buscador:', 'ftheme') . '</p>');

        remove_filter('genesis_search_button_text', 'ftheme_genesis_search_button_text_icon');
        add_filter('genesis_search_button_text', 'ftheme_genesis_search_button_text');
        get_search_form();

    else :

        echo apply_filters('genesis_404_entry_content', '<p>' . __('Parece ser que has llegado a una página que no existe, o te han enlazado mal. Prueba de buscar el contenido que quieres encontrar usando este buscador:', 'ftheme') . '</p>');
        ?>

    <?php

    endif;

    echo '</div>';

    genesis_markup(array(
        'close' => '</article>',
        'context' => 'entry-404',
    ));
}

genesis();
