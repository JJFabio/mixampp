<?php

include_once get_template_directory() . '/functions/businesspro-functions.php';
$functions_path = get_template_directory() . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($functions_path . 'admin-functions.php');  // Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');  // Admin Interfaces (options,framework, seo)
/* These files build out the theme specific options and associated functions. */
require_once ($functions_path . 'theme-options.php');   // Options panel settings and custom settings
?>
<?php

/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */

/* ----------------------------------------------------------------------------------- */

function businesspro_wp_enqueue_scripts() {
    if (is_singular() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
    if (!is_admin()) {

        wp_enqueue_script('businesspro-ddsmoothmenu', get_template_directory_uri() . '/js/ddsmoothmenu.js', array('jquery'));
        wp_enqueue_script('businesspro-flex-slider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'));
        wp_enqueue_script('businesspro-testimonial', get_template_directory_uri() . '/js/slides.min.jquery.js', array('jquery'));
        wp_enqueue_script('businesspro-prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'));
        wp_enqueue_script('businesspro-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));
        wp_enqueue_script('businesspro-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
    } elseif (is_admin()) {
        
    }
}

add_action('wp_enqueue_scripts', 'businesspro_wp_enqueue_scripts');
/* ----------------------------------------------------------------------------------- */
/* Custom Jqueries Enqueue */
/* ----------------------------------------------------------------------------------- */

function businesspro_custom_jquery() {
    wp_enqueue_script('mobile-menu', get_template_directory_uri() . "/js/mobile-menu.js", array('jquery'));
}

add_action('wp_footer', 'businesspro_custom_jquery');
//Front Page Rename
$get_status = businesspro_get_option('re_nm');
$get_file_ac = get_template_directory() . '/page-templates/front-page.php';
$get_file_dl = get_template_directory() . '/front-page-hold.php';
//True Part
if ($get_status === 'off' && file_exists($get_file_ac)) {
    rename("$get_file_ac", "$get_file_dl");
}
//False Part
if ($get_status === 'on' && file_exists($get_file_dl)) {
    rename("$get_file_dl", "$get_file_ac");
}

//
function businesspro_get_option($name) {
    $options = get_option('businesspro_options');
    if (isset($options[$name]))
        return $options[$name];
}

//
function businesspro_update_option($name, $value) {
    $options = get_option('businesspro_options');
    $options[$name] = $value;
    return update_option('businesspro_options', $options);
}

//
function businesspro_delete_option($name) {
    $options = get_option('businesspro_options');
    unset($options[$name]);
    return update_option('businesspro_options', $options);
}

if (!isset($content_width))
    $content_width = 590;
?>
