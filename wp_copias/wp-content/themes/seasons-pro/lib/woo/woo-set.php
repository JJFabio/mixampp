<?php

/**
 *
 * @package      Seasons Pro
 * @author       WPStudio
 * @subpackage   Customizations WooCommerce
 * @link         https://www.wpstud.io/themes
 */

//* Remove default woo stying
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

//* Remove Woo breadcrumbs so we can use the Genesis bread crumbs on all pages
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0 );

//* Remove Page titles Woo
add_filter( 'woocommerce_show_page_title' , 'wps_hide_page_title' );
function wps_hide_page_title() {

	return false;

}

//* Add cart to primary nav
add_action( 'genesis_header_right', 'wps_add_cart', 30 );
function wps_add_cart() {

	echo '<section class="mini-cart">';;
	echo '<a class="cart-count" href="' . WC()->cart->get_cart_url() .'" title="View your shopping cart">';
	echo WC()->cart->cart_contents_count  . '</a>';
	echo '<div class="cart-dropdown">';
	woocommerce_mini_cart();
	echo '</div></section>';

}

//* Add featured image header on shop page
add_action( 'genesis_after_header', 'wps_shop_header', 30 );
function wps_shop_header() {

    if ( is_shop() ) {
        echo '<div class="wrap"><div class="shop-header">';
        $shop = get_option( 'woocommerce_shop_page_id' );
        echo '<div class="inner fadeup">';
        echo '<h1>' . get_the_title( $shop ) . '</h1>';
        echo '<div class="text">' . get_theme_mod( 'wps_hero_text_webshop' ) .'</div>';
        echo '</div></div></div>';
    }

}

//* Remove default sidebar, add WooCommerce sidebar
add_action( 'genesis_before', 'wps_add_woo_sidebar', 20 );
function wps_add_woo_sidebar() {

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        if( is_woocommerce() ) {
            remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
            remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
            add_action( 'genesis_sidebar', 'wps_woo_sidebar' );
        }
    }

}

//* Display the WooCommerce sidebar
function wps_woo_sidebar() {

    if ( ! dynamic_sidebar( 'woo_primary_sidebar' ) && current_user_can( 'edit_theme_options' )  ) {
        genesis_default_widget_area_content( __( 'WooCommerce Primary Sidebar', 'seasons-pro' ) );
    }

}

//* Add sidebar abvoe footer webshop
add_action( 'genesis_before_footer', 'wps_add_woo_widget_above_footer', 8 );
function wps_add_woo_widget_above_footer() {

    if ( is_shop() ) {
		genesis_widget_area( 'woo_footer_widget', array(
		'before' => '<div class="before_footer"> <div class="wrap">',
		'after'  => '</div></div>',
    ) );
    }

}

//* Add exra span around sale badge
add_filter( 'woocommerce_sale_flash', 'wps_custom_replace_sale_text' );
function wps_custom_replace_sale_text( $html ) {

    return str_replace( __( 'Sale!', 'seasons-pro' ), __( '<span>Sale!</span>', 'seasons-pro' ), $html );

}

//* Position the Genesis Simple Share buttons on Single product page
add_action( 'woocommerce_single_product_summary', 'wps_reposition_simple_share_product', 30 );
function wps_reposition_simple_share_product() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active('genesis-simple-share/plugin.php') ) {
 		global $Genesis_Simple_Share;
 		echo genesis_share_icon_output( 'product', $Genesis_Simple_Share->icons );
	}

}

//* Woo custom layout productoverview
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//* Open div description
add_action( 'woocommerce_before_shop_loop_item_title', 'wps_open_product_desc', 20 );
function wps_open_product_desc() {

	echo '<div class="desc">';

}

//* Close div description
add_action( 'woocommerce_after_shop_loop_item', 'wps_close_product_desc', 35 );
function wps_close_product_desc() {

	echo '</div>';

}

//* Close div top single product open div last part
add_action( 'woocommerce_after_single_product_summary', 'wps_close_product_top', 0 );
function wps_close_product_top() {

	echo '</div><div class="after-product">';

}

//* Close div
add_action( 'woocommerce_after_single_product', 'wps_close_product', 0 );
function wps_close_product() {

	echo '</div>';

}

//* Move price above rating single product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );


//*  Set related product to max four
function woo_related_products_limit() {

  	global $product;
	$args['posts_per_page'] = 4;
	return $args;

}

add_filter( 'woocommerce_output_related_products_args', 'wps_related_products_args' );
	function wps_related_products_args( $args ) {

	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;

}

//* Define image sizes
add_action( 'after_switch_theme', 'wps_woocommerce_image_dimensions', 1 );
function wps_woocommerce_image_dimensions() {

	global $pagenow;
	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '680',	// px
		'height'	=> '680',	// px
		'crop'		=> 1 		// true
	);
	$thumbnail = array(
		'width' 	=> '300',	// px
		'height'	=> '300',	// px
		'crop'		=> 1		// false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs

}

//* Change number or products per row to 3
add_filter('loop_shop_columns', 'wps_loop_columns');
if (!function_exists('loop_columns')) {
	function wps_loop_columns() {

		return 3;

	}
}

//* remove "Add to Cart" button on product listing page in WooCommerce
add_action( 'woocommerce_after_shop_loop_item', 'wps_remove_add_to_cart_buttons', 1 );
function wps_remove_add_to_cart_buttons() {

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

}

//* Removes products count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

//* Place related product before footer
add_action('genesis_before_loop', 'wps_move_featured_products' );
function wps_move_featured_products() {

	if (  is_product() ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20 );
		add_action( 'genesis_before_footer', 'woocommerce_output_related_products',7 );
	}

}

//* Remove cross sales from cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' , 10 );

//* Add sold out badge on archive pages
add_action( 'woocommerce_before_shop_loop_item_title', function() {
    global $product;

    if ( !$product->is_in_stock() ) {
        echo '<span class="onsale"><span>' .__('Sold out', 'seasons-pro') . '</span></span>';
    }

});

//* Add sold out badge on single product pages
add_action( 'woocommerce_before_single_product_summary', function() {
	global $product;

	if ( !$product->is_in_stock() ) {
	echo '<span class="onsale"><span>' .__('Sold out', 'seasons-pro') . '</span></span>';
	}

});