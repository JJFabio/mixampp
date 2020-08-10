<?php

if (!class_exists('Updater_Admin')) {
    include(dirname(__FILE__) . '/updater-admin.php');
}

$theme_info = wp_get_theme();

$config = array(
    'remote_api_url' => $theme_info->get('AuthorURI'),
    'item_name' => $theme_info->get('Name'),
    'theme_slug' => ASITHEME_SLUG,
    'version' => $theme_info->get('Version'),
    'author' => $theme_info->get('Author'),
    'download_id' => '',
    'renew_url' => '',
    'beta' => false,
);

$strings = array(
    'error_message' => __('Error', ASITHEME_SLUG),
    'error_try_again' => __('An error occurred, please try again.', ASITHEME_SLUG),
    'error_license_expired' => __('Your license key expired on %s.', ASITHEME_SLUG),
    'error_license_revoked' => __('Your license key has been disabled.', ASITHEME_SLUG),
    'error_license_missing' => __('Invalid license.', ASITHEME_SLUG),
    'error_license_invalid' => __('Your license is not active for this URL.', ASITHEME_SLUG),
    'error_license_mismatch' => __('This appears to be an invalid license key for %s.', ASITHEME_SLUG),
    'error_license_no_activations_left' => __('Your license key has reached its activation limit.', ASITHEME_SLUG),
    'theme-license' => __('Así Themes License', ASITHEME_SLUG),
    'enter-key' => __('Enter your license key.', ASITHEME_SLUG),
    'license-key' => __('License Key', ASITHEME_SLUG),
    'license-action' => __('License Action', ASITHEME_SLUG),
    'license-information' => __('License information', ASITHEME_SLUG),
    'deactivate-license' => __('Deactivate License', ASITHEME_SLUG),
    'activate-license' => __('Activate License', ASITHEME_SLUG),
    'license-active-url-%s' => __('Active license for "%s"', ASITHEME_SLUG),
    'status-unknown' => __('License status is unknown.', ASITHEME_SLUG),
    'renew' => __('Renew?', ASITHEME_SLUG),
    'unlimited' => __('unlimited', ASITHEME_SLUG),
    'license-key-is-active' => __('License key is active.', ASITHEME_SLUG),
    'expires%s' => __('Expires %s.', ASITHEME_SLUG),
    'expires-never' => __('Lifetime License.', ASITHEME_SLUG),
    '%1$s/%2$-sites' => __('You have %1$s / %2$s sites activated.', ASITHEME_SLUG),
    'license-key-expired-%s' => __('License key expired %s.', ASITHEME_SLUG),
    'license-key-expired' => __('License key has expired.', ASITHEME_SLUG),
    'license-keys-do-not-match' => __('License keys do not match.', ASITHEME_SLUG),
    'license-is-inactive' => __('License is inactive.', ASITHEME_SLUG),
    'license-key-is-disabled' => __('License key is disabled.', ASITHEME_SLUG),
    'site-is-inactive' => __('Site is inactive.', ASITHEME_SLUG),
    'license-status-unknown' => __('License status is unknown.', ASITHEME_SLUG),
    'update-notice' => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", ASITHEME_SLUG),
    'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', ASITHEME_SLUG),
);

$updater = new Updater_Admin($config, $strings);

function asitheme_updater_database() {
    $option = ASITHEME_SLUG . '_version';
    $db_version = (string) get_option($option);
    $theme_version = (string) CHILD_THEME_VERSION;

    if ($db_version === $theme_version) {
        return;
    }

    update_option($option, $theme_version);

    if (version_compare($db_version, '1.3', '<')) { //front-page.php
        $frontpage_id = get_option('page_on_front');
        if (!$frontpage_id) {
            $page_data = array(
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
                'post_name' => 'homepage',
                'post_title' => __('Homepage', ASITHEME_SLUG),
                'post_content' => '',
                'comment_status' => 'closed',
            );
            $frontpage_id = wp_insert_post($page_data);
        }
        if ($frontpage_id) {
            update_post_meta($frontpage_id, '_wp_page_template', 'templates/front-page.php');
            update_option('show_on_front', 'page');
            update_option('page_on_front', $frontpage_id);
        }
    }
}

asitheme_updater_database();
