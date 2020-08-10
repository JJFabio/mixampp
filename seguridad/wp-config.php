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
define( 'DB_NAME', 'seguridad_trt' );

/** MySQL database username */
define( 'DB_USER', 'fabio_seguridad' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Fabio' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'FkdTKXrxE[t,/JGaAM^>AKU8?ph+/^04|po*pKG/-$O{B@u6Bjg_RLotR(6/g4#=' );
define( 'SECURE_AUTH_KEY',  'X5Q^,FGgBbyP?uR!1R<94}Qlv*Eub<qh!_T3:f?CK7;;L&~(Ix]],D i@wnd&+-1' );
define( 'LOGGED_IN_KEY',    '4oZDlO)T#P/EsqX&2r%9fP`5TW+>uEBmJ4<Mgl-gh3$9u85!1SOVgwO/N7tb+dE$' );
define( 'NONCE_KEY',        '&M`2cpUz ]k|.<[=A)|<pzOWb55>_g|T5>o]L1Lcz:{d;-!T4UzHbn>,]RKn%yG#' );
define( 'AUTH_SALT',        'q&>_}CZtc+QY6:@qBacMh{H?mgGjXCMwp$oL~*)WL=}MOwk#T^*h3.>CAe?6DjlK' );
define( 'SECURE_AUTH_SALT', 'Jdayd#|FRJW~g#Js!bB7o-pCk?23deLOA]lku9^[1ArW~SKL3AK/2,q~p} %X7[5' );
define( 'LOGGED_IN_SALT',   'IR{}5t3G)jbrT+(w$Q*tLPduIthQnp<`1Z3iAI{ Kq?Z89}iK4GSOJ@a^fbk!zr!' );
define( 'NONCE_SALT',       ':b;aGGb(~L.9EwKw/>! ^oh7~BdMtA/k} 60[X,mN,)P muWa-q>9*|6sV1mc <j' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
