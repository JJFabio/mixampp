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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "inearslocal" );

/** MySQL database username */
define( 'DB_USER', "Fabiolocal" );

/** MySQL database password */
define( 'DB_PASSWORD', "wRLXehhgUBtl20d2" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'NMa9rQ&2ktvXubbn4?ag8h3]nK#~O-#Rm(^->yi]*g$GC)6NFnQ+teud+?N_Th8,' );
define( 'SECURE_AUTH_KEY',   '?.p<E=y~O2HFS;`xsfh0u$Nlum*Iayk%s5?qw1E]/#}X%Fm;?|x$#c![BU#>kwnE' );
define( 'LOGGED_IN_KEY',     '++XV<5J(SKtljp>o~b3xq~t-h!V ^N4o_i`->FInoj|Vd}: HCg8}!,Ed*v8qWMJ' );
define( 'NONCE_KEY',         '!}<f+Z&JM`AIvxO(I-w{M>6vEF KU*r|F[PoRWN%C,)w<iaI],d%YeC)tIFds52V' );
define( 'AUTH_SALT',         'pP]m$6;c>pd[8Ll4k P--8lZ7I &,Z8pk4fj1|to_V8g~o*_TZjAV7i~/u5k=iig' );
define( 'SECURE_AUTH_SALT',  'unjn$<945h(aXAS_H,O8S`^BcY%.h[-8,M9v.|!pj[j,3`8.7!{Ov$Y|DIi}C$.-' );
define( 'LOGGED_IN_SALT',    '{SqYIL-+ZB1ezd9F7A.k_)/~cDf0xNNmhzOp#T>,tmTa:|0ef+vu/R~-O-pXgLv3' );
define( 'NONCE_SALT',        'A+*X;327]j4C>ZH`3s`ey5tSv>%/Sp;skEEPufT2$q!pTmT_PhbeROgtz^LMV:;j' );
define( 'WP_CACHE_KEY_SALT', '2 q0=%_<-OZ_Dp@gZ1&^GXCIkMZyT,-<z594off(&rECdsg4ao:ifOfh=M O#xk>' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );

@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

