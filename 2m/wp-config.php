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
define( 'DB_NAME', 'db_2m' );

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
define( 'AUTH_KEY',         '-e{!nI@gHnr?(4qlz}6ELVN)Z]nkv<2ty`$LA~`iP7p=&5Te$?*P-|cL4n9qj$$]' );
define( 'SECURE_AUTH_KEY',  'e=8Gun#+?#;~voCkbT%f*tP5-}RrUF/H3F?U.0lXX=<Ljq7mR;K&LEq?B{k32.Pw' );
define( 'LOGGED_IN_KEY',    'c6t19YYanura@|?s4r^]>5ewP>rNSLpORs4h_~#,8CFmI![cxBh;5ew7<emo<#vi' );
define( 'NONCE_KEY',        ':4~?b;)-5]U[~Db`3[45r6-#^F>aI {)aZe^|>St+LS#P-,D_~Bx|rSa&HrD 83a' );
define( 'AUTH_SALT',        '`oVbIar/*8v]$4w=4HLu.pJOSgc2]RCYViEw9hXWL*&H{Wuol0s9dBOl`lZr&=>F' );
define( 'SECURE_AUTH_SALT', 'p{+f0.fp nQ{,`b+m{G8<lro>:F3S6^mn8dVK[R=tbGr6;orPya1q$6Is+|`K~PL' );
define( 'LOGGED_IN_SALT',   'LNA-V0Mi8Ps/_5A0Re~nln}d4&jhxN k3yC]DPS}z{_4$4>^&Q^dsZ@okj&fD~>j' );
define( 'NONCE_SALT',       'Tu</g?fCCjKknW:n47[&=#L0K>G=uN6]x_*wGp-ihwF*dm5k[52x3y9u ,stRmAt' );

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
