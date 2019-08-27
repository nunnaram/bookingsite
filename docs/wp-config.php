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
define('DB_NAME', 'eyeworx2_hotel');

/** MySQL database username */
define('DB_USER', 'eyeworx2_hotel');

/** MySQL database password */
define('DB_PASSWORD', 'UoeXG2j7');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'hChx(Dmw*$R)<LN?++l_@D1eV)FH,Q!PQ|+MJMkF.-1k{3~R76e1jKxZUkAqs]WP');
define('SECURE_AUTH_KEY',  'NhKw~<[g6MbrzC`;xti:sf&+Uu60L346XdW=Pkc]>RU7iW..xHM[+2Q+r-UB0?Ux');
define('LOGGED_IN_KEY',    '<,j(UxOEQZR?ip[T2Zpp,cLU;,nHBT:~%pScd.|1)~{&xUz79~H#g@NTSN>cm+<1');
define('NONCE_KEY',        'b|5 K`l.Ai}DgIk~BKz+8Y|0:G9=/bJUjsoLwM#Af{n-=aB^YO#B?f#?}%[im 7D');
define('AUTH_SALT',        'Ze{%Ksr*#Z:7&{Y~7cFDnVb0^E}>yY3WS/B,|h,Lo@-S[LEZFq+6aG-nm|4?7uat');
define('SECURE_AUTH_SALT', '@g;??QH.pvk|Dp{GhOUtE/iFGfZ&AwF(#!Md}n>kI!Whbe9`/g,+#v-u;=xT;:Dv');
define('LOGGED_IN_SALT',   'ljjp0<m@y>[-;slw`ALoW;`%7JT-gp*2hQ 2`b(QBJ+J%mbL=[o~Q+s9$U#}VX+=');
define('NONCE_SALT',       'iC7!Ce%{O^)F:w7+-K-T-N- 9cB4YhK).&lK_Kh:}M,dbaMn/_:VThJKW5+*j[k-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
