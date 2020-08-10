<?php
add_action('after_setup_theme', 'asitheme_wc_after_setup_theme');

function asitheme_wc_after_setup_theme() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

//* We delete sidebar from woocommerce
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

//* Remove add to cart button product list
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

//* Remove the product rating display
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//* Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'asitheme_woocommerce_add_to_cart_fragments');

function asitheme_woocommerce_add_to_cart_fragments($fragments) {
    ob_start();
    $count = WC()->cart->cart_contents_count;
    echo '<a class="cart-contents" href="' . wc_get_cart_url() . '" title="' . __('View cart', ASITHEME_SLUG) . '">';
    echo '<i class="fas fa-shopping-cart"></i>';
    echo '<span class="cart-contents-count">' . esc_html($count) . '</span>';
    echo '</a>';
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

add_filter('woocommerce_product_single_add_to_cart_text', 'asitheme_woocommerce_product_single_add_to_cart_text', 10, 2);

function asitheme_woocommerce_product_single_add_to_cart_text($text, $product) {
    if ($product->is_type('external') && $product->get_button_text()) {
        return $product->get_button_text();
    }
    $button_text = get_theme_mod(ASITHEME_SLUG . '_woocommerce_buy_button_text', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_woocommerce_buy_button_text']);
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
            set_theme_mod(ASITHEME_SLUG . '_woocommerce_buy_button_text', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_woocommerce_buy_button_text']);
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
    $boton_color = get_theme_mod(ASITHEME_SLUG . '_button_color', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_color']);
    $boton_background = get_theme_mod(ASITHEME_SLUG . '_button_background', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_background']);
    $boton_border = get_theme_mod(ASITHEME_SLUG . '_button_border_color', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_border_color']);
    $boton_color_hover = get_theme_mod(ASITHEME_SLUG . '_button_color_hover', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_color_hover']);
    $boton_background_hover = get_theme_mod(ASITHEME_SLUG . '_button_background_hover', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_background_hover']);
    $boton_boder_hover = get_theme_mod(ASITHEME_SLUG . '_button_border_color_hover', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_border_color_hover']);
    $link_color = get_theme_mod(ASITHEME_SLUG . '_link_color', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_link_color']);
    $button_border_width = get_theme_mod(ASITHEME_SLUG . '_button_border_width', CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_button_border_width']);

    $boton_background = !$boton_background ? 'transparent' : $boton_background;
    $boton_color = !$boton_color ? '#000' : $boton_color;
    $boton_border = !$boton_border ? 'transparent' : $boton_border;
    $boton_background_hover = !$boton_background_hover ? 'transparent' : $boton_background_hover;
    $boton_color_hover = !$boton_color_hover ? '#000' : $boton_color_hover;
    $boton_boder_hover = !$boton_boder_hover ? 'transparent' : $boton_boder_hover;
    ?>
    <style type="text/css">
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button{
            background-color: <?php echo $boton_background; ?> !important;
            color: <?php echo $boton_color; ?> !important;
            border-color: <?php echo $boton_border; ?> !important;
            border-width: <?php echo $button_border_width; ?>px;
            border-style: solid;
        }
        .cart-contents span{
            background-color: <?php echo $boton_background; ?> !important;
            color: <?php echo $boton_color; ?> !important;
            border-color: <?php echo $boton_border; ?> !important;
        }
        <?php if (in_array($boton_background, array('#ffffff', '#fff', 'transparent'))): ?>
        .cart-contents span{
            border-width: 1px;
            border-style: solid;
            background-color: #fff !important;
        }
        <?php endif; ?>
        .woocommerce #respond input#submit:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button:hover,
        .woocommerce input.button:hover,
        .woocommerce .woocommerce-cart-form .cart .button:hover,
        .woocommerce #respond input#submit:focus,
        .woocommerce a.button:focus,
        .woocommerce button.button:focus,
        .woocommerce input.button:focus,
        .woocommerce .woocommerce-cart-form .cart .button:focus,
        .woocommerce #respond input#submit:active,
        .woocommerce a.button:active,
        .woocommerce button.button:active,
        .woocommerce input.button:active,
        .woocommerce .woocommerce-cart-form .cart .button:active{
            background-color: <?php echo $boton_background_hover; ?> !important;
            color: <?php echo $boton_color_hover; ?> !important;
            border-color: <?php echo $boton_boder_hover; ?> !important;
        }
        <?php if($link_color): ?>
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a{
            color: <?php echo $link_color; ?>;
        }
        <?php endif; ?>
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

    //* Add woocommerce setup panel _buy_button section
    $wp_customize->add_section(ASITHEME_SLUG . '_woocommerce_buy_button', array(
        'title' => __("'Add to cart' button", ASITHEME_SLUG),
        'priority' => 14,
        'panel' => 'woocommerce',
    ));

    //* Buy button text
    $wp_customize->add_setting(ASITHEME_SLUG . '_woocommerce_buy_button_text', array(
        'default' => CHILD_THEME_DEFAULTS[ASITHEME_SLUG . '_woocommerce_buy_button_text'],
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(ASITHEME_SLUG . '_woocommerce_buy_button_text', array(
        'label' => __("'Add to cart' button text", ASITHEME_SLUG),
        'description' => __('Leave empty to show default value', ASITHEME_SLUG),
        'section' => ASITHEME_SLUG . '_woocommerce_buy_button',
        'settings' => ASITHEME_SLUG . '_woocommerce_buy_button_text',
    ));
}

//* My account
add_action('woocommerce_before_account_navigation', 'asitheme_woocommerce_before_account_navigation');

function asitheme_woocommerce_before_account_navigation() {
    wc_get_template('myaccount/dashboard.php', array(
        'current_user' => get_user_by('id', get_current_user_id()),
    ));
}

add_filter('woocommerce_account_menu_items', 'asitheme_woocommerce_account_menu_items', 999);

function asitheme_woocommerce_account_menu_items($items) {
    unset($items['dashboard']);
    unset($items['customer-logout']);
    return $items;
}

add_action('wp', 'asitheme_wc_wp');

function asitheme_wc_wp() {

    $current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $dashboard_url = get_permalink(get_option('woocommerce_myaccount_page_id'));

    if (is_user_logged_in() && is_account_page() && $dashboard_url == $current_url) {
        wp_redirect(wc_get_endpoint_url('orders'));
        die();
    }
}

//* Modify search icon
add_filter('get_product_search_form', 'asitheme_woocommerce_get_product_search_form');

function asitheme_woocommerce_get_product_search_form($form) {
    $form = preg_replace('/\>.+\<\/button\>/i', ">&#xf002;</button>", $form);
    return $form;
}

//* Add widgets
include_once(ASITHEME_CDN_PATH . '/inc/woocommerce/class-asi-widget-woocommerce-cart.php');

add_action('widgets_init', 'asitheme_woocommerce_register_widgets');

function asitheme_woocommerce_register_widgets() {
    register_widget('ASI_Widget_WooCommerce_Cart');
}