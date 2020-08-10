<?php
add_action('after_setup_theme', 'asitheme_wc_after_setup_theme');

function asitheme_wc_after_setup_theme() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

//* We put the price next to the Add button
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price');

//* We delete sidebar from woocommerce
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

//* Remove the product rating display
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//* Move single excerpt above add to cart form
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35);

//* Remove add to cart button product list
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

add_filter('woocommerce_price_trim_zeros', '__return_true');

//* Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'asitheme_woocommerce_add_to_cart_fragments');

function asitheme_woocommerce_add_to_cart_fragments($fragments) {
    ob_start();
    $count = WC()->cart->cart_contents_count;
    echo '<a class="cart-contents" href="' . wc_get_cart_url() . '" title="' . __('View cart', ASITHEME_SLUG) . '">';
    echo '<i class="fa fa-shopping-cart"></i>';
    echo '<span class="cart-contents-count">' . esc_html($count) . '</span>';
    echo '</a>';
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

//* Change number or products per row
add_filter('loop_shop_columns', 'asitheme_loop_shop_columns');

function asitheme_loop_shop_columns() {
    return 3;
}

add_filter('woocommerce_output_related_products_args', 'asitheme_woocommerce_output_related_products_args');

function asitheme_woocommerce_output_related_products_args($args) {
    $args['posts_per_page'] = 3;
    $args['columns'] = 3;
    return $args;
}

add_filter('woocommerce_product_single_add_to_cart_text', 'asitheme_woocommerce_product_single_add_to_cart_text', 10, 2);

function asitheme_woocommerce_product_single_add_to_cart_text($text, $product) {
    if ($product->is_type('external') && $product->get_button_text()) {
        return $product->get_button_text();
    }
    $button_text = get_theme_mod(ASITHEME_SLUG . '_woocommerce_buy_button_text', __('Buy', ASITHEME_SLUG));
    if ($button_text) {
        return $button_text;
    }
    return $text;
}

add_action('wp_loaded', 'asitheme_woocommerce_loaded');

function asitheme_woocommerce_loaded() {

    if (did_action('woocommerce_loaded')) {

        if (!get_theme_mod(ASITHEME_SLUG . '_content_wc_set', false)) {

            set_theme_mod(ASITHEME_SLUG . '_content_wc_set', true);
            set_theme_mod(ASITHEME_SLUG . '_woocommerce_buy_button_text', __('Buy', ASITHEME_SLUG));
        }
    }
}

add_filter('woocommerce_pagination_args', 'asitheme_woocommerce_pagination_args');

function asitheme_woocommerce_pagination_args($args) {
    $args['end_size'] = 2;
    $args['mid_size'] = 1;
    return $args;
}

add_action('wp_head', 'asitheme_woocommerce_wp_head', 11);

function asitheme_woocommerce_wp_head() {
    $boton_color = get_theme_mod(ASITHEME_SLUG . '_button_color', '#ffffff');
    $boton_background = get_theme_mod(ASITHEME_SLUG . '_button_background', '#c3251d');
    $boton_border = get_theme_mod(ASITHEME_SLUG . '_button_border_color', $boton_background);
    $boton_color_hover = get_theme_mod(ASITHEME_SLUG . '_button_color_hover', $boton_color);
    $boton_background_hover = get_theme_mod(ASITHEME_SLUG . '_button_background_hover', $boton_background);
    $boton_boder_hover = get_theme_mod(ASITHEME_SLUG . '_button_border_color_hover', $boton_background);
    $link_color = get_theme_mod(ASITHEME_SLUG . '_link_color', '#c3251d');
    ?>
    <style type="text/css">
        .cart-contents span,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button{
            background-color: <?php echo $boton_background; ?> !important;
            color: <?php echo $boton_color; ?> !important;
            border-color: <?php echo $boton_border; ?> !important;
        }
        .woocommerce .woocommerce-cart-form .cart .button{
            background-color: #515151 !important;
            border-color: #515151 !important;
            color: #fff !important;
        }
        .woocommerce #respond input#submit:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button:hover,
        .woocommerce input.button:hover,
        .woocommerce .woocommerce-cart-form .cart .button:hover{
            background-color: <?php echo $boton_background_hover; ?> !important;
            color: <?php echo $boton_color_hover; ?> !important;
            border-color: <?php echo $boton_boder_hover; ?> !important;
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a{
            color: inherit;
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a{
            color: <?php echo $link_color; ?>;
        }
    </style>
    <?php
}

add_action('wp_enqueue_scripts', 'asitheme_woocommerce_wp_enqueue_scripts');

function asitheme_woocommerce_wp_enqueue_scripts() {

    wp_enqueue_style('asitheme-woocommerce', ASITHEME_CDN . '/assets/css/woocommerce.css', array('woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general'), CHILD_THEME_VERSION);
}

add_action('customize_register', 'asitheme_woocommerce_customizer', 21);

function asitheme_woocommerce_customizer($wp_customize) {

    if (!isset($wp_customize)) {
        return;
    }

    //* Add woocommerce setup panel
    $wp_customize->add_section(ASITHEME_SLUG . '_woocommerce', array(
        'title' => __('Woocommerce', ASITHEME_SLUG),
        'priority' => 14,
    ));

    //* Texto footer
    $wp_customize->add_setting(ASITHEME_SLUG . '_woocommerce_buy_button_text', array(
        'default' => __('Buy', ASITHEME_SLUG),
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_woocommerce_buy_button_text', array(
        'label' => __("'Add to cart' button text", ASITHEME_SLUG),
        'description' => __('Leave empty to show default value', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_woocommerce',
        'settings' => ASITHEME_SLUG . '_woocommerce_buy_button_text',
    ));
}

add_action('genesis_header_right', 'asitheme_woocommerce_genesis_header_right', 9);

function asitheme_woocommerce_genesis_header_right() {
    $count = WC()->cart->cart_contents_count;
    echo '<a class="cart-contents" href="' . wc_get_cart_url() . '" title="' . __('View cart', ASITHEME_SLUG) . '">';
    echo '<i class="fa fa-shopping-cart"></i>';
    echo '<span class="cart-contents-count">' . esc_html($count) . '</span>';
    echo '</a>';
}

add_action('pre_get_posts', 'asitheme_woocommerce_pre_get_posts', 11);

function asitheme_woocommerce_pre_get_posts($query) {

    if (is_admin()) {
        return;
    }

    if (is_search() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'page', 'product'));
    }
}
