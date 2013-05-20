<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'r7h3bo10');

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
define('AUTH_KEY',         's>~^*NU2Y7o3w Dk|e/lgAMyNc;D@/v)pgOl@K*)t!n~{5eAv #P#-6.!Ti+8Ue[');
define('SECURE_AUTH_KEY',  'l)`j_LWt^Jn*q^7$q#jIP)Ub@+5jy/rSr|lO4>+@AeJY%i}X(&Z7WDGOjR#nBMt]');
define('LOGGED_IN_KEY',    ',#7CG`BM>mA=O%sd6uNSFzs++Oc]c|[fXtceXLni5$&++E?Qz8]Ul17gM|ncZ]Lq');
define('NONCE_KEY',        '3BGGIyq+{gt?A?[JDXnTh:Y/V@%$`:z])WbN?EcsrM,}gPzgS/#w9Xm*Ir(3@G|=');
define('AUTH_SALT',        'yp.1y?B9<ci4QVnu/OZV%y]c.2rp[3d R94m|}=w@Hk${DX%h--4$p^82s`#|FfZ');
define('SECURE_AUTH_SALT', '9e?odc0J_Xuk4wSWx1%1Gk~=|#AYw=5M|S#vx{+7}!P?+Krgv-n/nuFu]u~ly@L-');
define('LOGGED_IN_SALT',   'X=zf;YK<R$0|OQ7SFkrKAex`T+Bgiv|}C*jpygig!pPH{~$(H]+9-Ywz<kuu8WLJ');
define('NONCE_SALT',       '>x^$<tSB8b[Dt@7o`+D(ExD#BsoaH1;xb@U|bTw~W9!}vV6-!1vI3<wxkQ^O~2+%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
