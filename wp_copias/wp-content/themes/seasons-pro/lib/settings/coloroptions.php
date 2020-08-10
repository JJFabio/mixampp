<?php

/**
 *
 * @author       Frank Schrijvers || WPStudio
 * @subpackage   Customizations
 * @link         https://www.wpstud.io/themes
 */

add_action( 'customize_register', 'wps_colors' );
function wps_colors( $wp_customize ) {

    $wp_customize->add_section(
        'wpstudio_theme_colors',
        array(
            'title' => 'Accent colors',
            'description' => 'Change the default accent color.',
            'priority' => 35,
        )
    );

	//* add color picker setting
	$wp_customize->add_setting( 'accent_color',
		array(
			'default' => '#42a781'
		)
	);

	//* add color picker control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label' 	=> 'Accent Color',
				'section' 	=> 'wpstudio_theme_colors',
				'settings' 	=> 'accent_color',
			)
		)
	);

}

add_action( 'wp_head', 'wps_customizer_head_styles' );
function wps_customizer_head_styles() {

	$accent_color = get_theme_mod( 'accent_color' );

	if ( $accent_color != '#42a781' ) :
	?>
					<style type="text/css">
				a,
				.entry-title a:hover, .entry-title a:focus,
				.genesis-nav-menu a:focus, .genesis-nav-menu a:hover,
				.genesis-nav-menu .current-menu-item > a,
				.genesis-nav-menu .sub-menu a:hover,
				.genesis-nav-menu .highlight a:hover,
				.menu-toggle:hover, .menu-toggle:focus,
				#front-intro .fp-section-4 .inner i.fa,
				#front-intro .fp-section-5 .inner i.fa,
				#front-intro .fp-section-6 .inner i.fa,
				.entry-header .entry-meta .entry-categories:before,
				.entry-header .entry-meta .entry-author-link:before,
				.entry-header .entry-meta .entry-comments-link a:before,
				.entry-header .entry-meta .entry-tags:before,
				.entry-header .entry-meta .post-edit-link:before,
				.entry-header .entry-meta .entry-time:before,
				.gridlist-toggle a.active,
				.star-rating span:before,
				.shop_table td.actions .button,
				.widget_shopping_cart .total .amount,
				.woocommerce-message .wc-forward:hover,
				.woocommerce-info .wc-forward:hover,
				.woocommerce-account .shop_table td.order-actions .button,
				.widget a:hover:not(.more-link),
				.home .woocommerce li:hover h3,
				.genesis-nav-menu .sub-menu .current-menu-item > a:hover,
				.genesis-nav-menu .sub-menu .current-menu-item > a:focus {
					color: <?php echo $accent_color; ?>;
				}

				.site-header .wrap .widget-area .mini-cart .cart-count,
				#front-intro .fp-section-3,
				#front-section-3,
				.prev-next-navigation a:before,
				.prev-next-navigation a:before,
				.comments input[type="submit"],
				.more-link:before,
				.onsale,
				.widget_price_filter .ui-slider .ui-slider-range,
				#front-intro .fp-section-2 .button:after,
				.before_footer .enews input[type="submit"] {
					background-color: <?php echo $accent_color; ?>;
				}

				#front-intro .fp-section-3:after,
				.front-section h2.widget-title:after,
				.front-section h2.widget-title:after,
				#front-section-3:after,
				.single .entry-title:before,
				.entry-comments h3:before,
				.entry-comments #reply-title:before,
				.comment-respond h3:before,
				.comment-respond #reply-title:before,
				.sidebar .widget .widget-title:after,
				.archive-pagination li a:hover,
				.archive-pagination li a:focus,
				.archive-pagination .active a,
				button, input[type="button"],
				input[type="reset"],
				input[type="submit"], .button,
				nav.woocommerce-pagination ul.page-numbers li .current,
				.related h2:after,
				.shop-header .inner h1::after,
				.shop_table td.actions .button:hover,
				.single .entry-title:before, .page .entry-title:before,
				.home .woocommerce li .product-title:after,
				.home .woocommerce li .desc h3:after,
				.woocommerce #genesis-content ul.products li.product .desc h3:after,
				.woocommerce .related ul.products li.product .desc h3:after,
				.full-width-content #genesis-content ul.products li.product .desc h3:after,
				.full-width-content .related ul.products li.product .desc h3:after{
					background: <?php echo $accent_color; ?>;
				}
				#front-intro .fp-section-3:after {
					opacity: 0.8;
				}

				.shop-header,
				.shop_table td.actions .button,
				.checkout_coupon .form-row-last .button,
				#front-intro .fp-section-1 .inner a:not(.button),
				#front-intro .fp-section-2 .inner a:not(.button),
				#front-intro .fp-section-3 .inner a:not(.button),
				.site-header .sub-menu,
				#front-intro .fp-section-1 .inner a:not(.button):not(.box-link) {
					border-color: <?php echo $accent_color; ?>;
				}

				.genesis-nav-menu .sub-menu:before {
					border-bottom: 5px solid <?php echo $accent_color; ?>;
				}


			</style>
	<?php
	endif;

}