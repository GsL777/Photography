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
define( 'DB_NAME', 'photography' );

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
define( 'AUTH_KEY',         '+k%2 dq^BV<6KETa6Z!LlWfg@?-ujD~If RZ<A(4Pr;c5A?Y5 K-x]Wev*F%Bg)G' );
define( 'SECURE_AUTH_KEY',  ' ~2fyOe0b~Sc8}?;Q)yyh94HEG+l^>;Q4_u7UiMx9SPqY*&lo_#E:Z]J4xS{;RA9' );
define( 'LOGGED_IN_KEY',    'K)ac.>gPn.+stRP %j&fZ2?22J<aWFi0RG{l7CueC#|^JNR^1!?_>Pz5OnXj}Oev' );
define( 'NONCE_KEY',        'z?s>&3!GxW97x}Z>8Z63_+!L>lY-$@&q|NG%/qO+(]i=ZR bECM+2iYja/ws-tfh' );
define( 'AUTH_SALT',        'e7O*]mY#M7S_imNUcRiw4E#uZ_yG6al*YtI(]p@7[DDAtfK:0hvJF*aNL #fgeO7' );
define( 'SECURE_AUTH_SALT', 'K[w7&Gi~?<V^BbycR>tE*%I1Chz~KcH }7VacN+Y)TPpG$WM>W[{wOK1~tST  r*' );
define( 'LOGGED_IN_SALT',   '`U^<L~HjL`FwX3-1<GMXH+,wWO4d>14+0(M8QyQu%P]Ycq)JWst#NDD8x5D52*{z' );
define( 'NONCE_SALT',       'f%1~^O1`sB9oS}{V/_yIS`.`~2I%9^f ],ZHHRl5~>E$@0e(/5u6TV8:<X{R9~x5' );

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
