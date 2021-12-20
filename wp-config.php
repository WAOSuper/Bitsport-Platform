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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitsport_arise' );

/** MySQL database username */
define( 'DB_USER', 'bitsport_arise' );

/** MySQL database password */
define( 'DB_PASSWORD', 'TapTap123@#' );

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
define( 'AUTH_KEY',         'ny3:sY(DFQ.6)S6}U3iI|*m(Skr*o[9fZAwBZCe1GaK.1vg2;[@X!H>U`gCfU6jS' );
define( 'SECURE_AUTH_KEY',  '*YV`]e6nn?Q&aVY|]o6FH in27HBtAn^{ZK#g2i5fbocf3Rkcg$0_bw`aWF[?_V_' );
define( 'LOGGED_IN_KEY',    'n4xEPP?Ais/OM|Y{|Ve7cYM91`Wz&KQ+j}!_Qh$@R;fp<>4EN0?+D+&lp$JKSyfo' );
define( 'NONCE_KEY',        'cJ)<!Gsxas1%68?pE4%!T71Xv]22`?2zj[l~r(ya6&l_Pn-jiU(_<P|d1I5ToS$?' );
define( 'AUTH_SALT',        'jH6=Hi~dMM?L2X,wU~`VM7 8bx03]O[o;tSt~9gdr|]?mJ+wjByFUE90dgl(b_q0' );
define( 'SECURE_AUTH_SALT', '!v})RR)I7{_#T@l+bhYiY-]!?l:Lr,|j|q;jNc,WEIofr|%Su_O!u8CfO}0P;z(K' );
define( 'LOGGED_IN_SALT',   ',T_ LB&mq^vlynm!NuEgTq,yQ02<O^&>*/+eR`%)<O}?}oC[1VTvYDO2@mlI-X0q' );
define( 'NONCE_SALT',       '+(D8oHk*uzjt=e=FqvCSo`jPG[YJq:bG@!g_ho,iTo8S%Mc!=Y6ca@A8*1/_*GFt' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
