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
define( 'DB_NAME', 'db_colombia' );

/** MySQL database username */
define( 'DB_USER', 'FabioEditor' );

/** MySQL database password */
define( 'DB_PASSWORD', 'FabioEditor' );

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
define( 'AUTH_KEY',         '?5Rvw;OhYG(N?z)[{O}zo:u3:=4cO(RHy53HlvgeV4qrej#z:6l[IY8!.Z+}9<a`' );
define( 'SECURE_AUTH_KEY',  '<@u,@JF=m-[=XPnC.m .$5G>`0D0!RM=7&$(krp[^<dZVh6/@dJ&BiA|T PnNp^s' );
define( 'LOGGED_IN_KEY',    '[u}]:b0eNTI.toPV,5I[E`yUSSe,r.A,pD3u5sHd)K8mBZ-RH<yI2to)z9Sx.@On' );
define( 'NONCE_KEY',        '<ah9P;wUYGNz@sgpxjh(lqC1Wg}3sCsK!GF4xvg`/_YoO<|]Z<;*u%Sz!</[N;<O' );
define( 'AUTH_SALT',        'ONQdkp?2kSA<Y&]1.%p?xX#2j55]Pt6#5pV#~~S:$8g-Ub`Fl!+A{_PLo)!rWb=s' );
define( 'SECURE_AUTH_SALT', 'HAj|UKE-MuPNsKSD,%RQm;Ql2}Wuq/I1`<uqI<b7qBL9[V_^:xrNA&mvjhric0hN' );
define( 'LOGGED_IN_SALT',   '5?} Bvis-CeEY<bHLbQiw%z &B`cz}Za.S.!B!_g8+W5%(x&K;LODq52O_||z/m~' );
define( 'NONCE_SALT',       'mS5!Y^RTY6j|Q2@p5z}VN*VS*3OTbpQsLS}k0^_:]a!Ej=VHL9Xc.-xT3Ifn%0/s' );

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
