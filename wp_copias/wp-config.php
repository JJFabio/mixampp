<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', "fabio");

/** MySQL database username */
define('DB_USER', "fabio");

/** MySQL database password */
define('DB_PASSWORD', "Are8y6ZVn4f57QpH");

/** MySQL hostname */
define('DB_HOST', "localhost");

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lqqkdrkcgvqqdpky7h7wxxuuhformk0bk60nccovpecsqiflttyjtvlr5zlkqfeo');
define('SECURE_AUTH_KEY',  'jrpeckquybpxhbpsq8inkyoczzdyls3e8tymjeey2pqbfu2h5j8pthpfn6w1vksx');
define('LOGGED_IN_KEY',    'fc7uisr0fv3dq1eilxcgv6ltocu3wmbyuov4sxb1tdlwcez49k5qdzsxhhmia23r');
define('NONCE_KEY',        'qvg6cprjdrstviv9wh58lakfsmb5i1ywcesnqoxjylfklu6r4s1fik2muh98nmbw');
define('AUTH_SALT',        'pupamsarht8zbibpwyjpnmtunhcl1vvxgoqkchqbnif6wgn5xxopflroitvljx91');
define('SECURE_AUTH_SALT', 'jp8agkbvze0mwcagn69wsbjlsibaxshrxuaoswnqy5l8r38feyzvx4mgdl4eikwi');
define('LOGGED_IN_SALT',   'llcro690gexxfncwuuemw2trclvgujtdv9x7y8yq63ax3siumgfrmzs0sguwrfeh');
define('NONCE_SALT',       'lxzlo2xmhoknt5pfjnbr4ycrxlmhxklfefphioncw2rcmsupfnqfkdybvafbiidg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp1o_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define( 'WP_MEMORY_LIMIT', '128M' );

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/wp_copias/' );
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

//define('SUNRISE', 'on');
define('SUNRISE', 'on');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );

@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

