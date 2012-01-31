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
define('DB_NAME', 'housebeach');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'A{6aF+@2? je|83eYJp#h><KkbLzLPxT:J:WzKmF_)]}s_6UToy?&S9-i4_4VjAR');
define('SECURE_AUTH_KEY',  '$FVZ<*ZfX<@+-K<YK>~$0Y!r(uI7LZJa(_V!sH3!eOmXs#^-+XAy2+D-9S,h|AJB');
define('LOGGED_IN_KEY',    '9/b|2B|$|a|$eHU-K}/zb<k~`x9I;CCe|=41kz@gg]|d9U%OlneMj;wN8hiKU8@x');
define('NONCE_KEY',        'UD5&;nk:y5aV?i@E&W^NX./L3Sv)ofjc*-7%BG >@R`+`[,JCmfE~{}J,|M|zEs$');
define('AUTH_SALT',        '`C8D}9+.al~Z^04tLstV/n@lj=b9m+0M_5~Z9%d<s4+YS ,H8d5dF) {qSI`!;n)');
define('SECURE_AUTH_SALT', 'TWdKr$hjQtKv:7}ti#e7i{OR|iG,?-N+0XkU~S{q8Yv,2!>5LyK!9]WlQ+u|`8D7');
define('LOGGED_IN_SALT',   'p@^[mb~h3)M!drJNY4H^_oRB+wz6&+]l_-+0h~_GuGE+;YEVT-f};@p|c>L%wUeN');
define('NONCE_SALT',       '&0lcCrv.7?<v+Iy-0EQV})|@C:yb./XCt(5T3eV0{v+m1GF*+V ~S,fUpj.j#~Ua');

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
