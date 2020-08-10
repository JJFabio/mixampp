<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Settings Sanitizer
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

/**
 * Registers an option sanitization filter.
 *
 * If the option is an "array" option type with "sub-options", you have to use the third param to specify the
 * sub-option or sub-options you want the filter to apply to. DO NOT call this without the third parameter on an option
 * that is an array option, because in that case it will apply that filter to the array(), not each member.
 *
 * Use the 'genesis_settings_sanitizer_init' action to be notified when this function is safe to use
 *
 * @since 1.7.0
 *
 * @param string       $filter    The filter to call (see Genesis_Settings_Sanitizer::$available_filters for options).
 * @param string       $option    The WordPress option name.
 * @param string|array $suboption Optional. The sub-option or sub-options you want to filter.
 * @return true True when complete.
 */
function genesis_add_option_filter( $filter, $option, $suboption = null ) {

	return Genesis_Settings_Sanitizer::$instance->add_filter( $filter, $option, $suboption );

}

add_action( 'admin_init', 'genesis_settings_sanitizer_init' );
/**
 * Instantiate the Sanitizer.
 *
 * @since 1.7.0
 */
function genesis_settings_sanitizer_init() {

	new Genesis_Settings_Sanitizer( new Genesis_Sanitizer );

}
