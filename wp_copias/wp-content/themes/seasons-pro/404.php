<?php

/**
 *
 * @package      WPStudio
 * @subpackage   Structure
 * @link         https://www.wpstud.io/themes
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

//* Force full width layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add 404 message
add_action( 'genesis_loop', 'genesis_404' );
function genesis_404() {

	echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

	echo '<div class="entry-content">';

	echo '<p>' . sprintf( __( 'OOPS! - Could not Find it', 'seasons-pro'  )) . '</p>';

	echo '<h3>4<span>0</span>4</h3>';

	echo '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form above.', 'seasons-pro' ), home_url() ) . '</p>';

	echo '<p>' . get_search_form() . '</p>';

	echo '</div>';


	echo '</article></div>';

}

genesis();