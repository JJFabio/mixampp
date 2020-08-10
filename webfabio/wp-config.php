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
define( 'DB_NAME', 'web_fabio' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '&6nE$W@i}=,^Y Sn!kvDr J)%q]9AY x/M[lp`iu-N=4LWYU|(T<Z%iTe#x9aZ;b' );
define( 'SECURE_AUTH_KEY',  '|.~bW/9Db8g*&w +SNEzo9Tb|<>``1{N7%09$zR&Ga5W($sg+uUF.a-BIV7&M#H/' );
define( 'LOGGED_IN_KEY',    'Zm.{)8p#%B==CQ~-I6U3*s2#GI(V*)pxdfVnV{H,];rimn*gI/_+AeJw=;INNU9t' );
define( 'NONCE_KEY',        '7:|&}lX2GQ:3LhPhGPqIj9qK<sJjhXNkz<3Xl3:!yXl28VmV~(zaQAH>.)9C?{KJ' );
define( 'AUTH_SALT',        'W^-ySo/&q1%J@j-@ Ycz3HXtQ4}TVDjU/<R8~5-.LELcHe2&A!Ey4^4MYS~tdjC3' );
define( 'SECURE_AUTH_SALT', '{T=,KC )o!0fYKEq2sNGkJpY)A BwgA=sjz:9*U6aKAse:K>#AEZbIi_}G)-Ag=9' );
define( 'LOGGED_IN_SALT',   '#{[WZQRLG]3-G!8N0&5ZZ ;:26bSJX^6o]vl?U0o`QRH#$VY^00VNXm:h!.B,<q*' );
define( 'NONCE_SALT',       'A|MT- skmBam>om*qV[$BVTST9_,.dvLH*YX(yK$Q}VNaH2n) N9z/!SUFRGXa*3' );

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
