<?php

/**
 *
 * @package     Seasons Pro
 * @author      WPStudio
 * @link        https://www.wpstud.io/themes
 */

//* Customize the credits
add_filter( 'genesis_footer_creds_text', 'wps_footer_creds_text' );
function wps_footer_creds_text() {

	$creds = '[footer_copyright]  [footer_childtheme_link before ="&middot; "] &middot; made with <i class="fa fa-heart"></i> by <a href="https://www.wpstud.io" title="WPStudio Genesis Themes and Plugins">WPStud.io</a>';
	return $creds;

}