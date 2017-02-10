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
define('FS_METHOD', 'direct');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dunkelvolk');

/** MySQL database username */
define('DB_USER', 'christian_wp');

/** MySQL database password */
define('DB_PASSWORD', 'VpNJVCRw9VsVSxC3');

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
define('AUTH_KEY',         '`QU@_?J_Y~o1CI4LhRx.~`XSD$=mjpJ3pdd(P8]u|f6CH{pt-;PrRtoSntw@,_s@');
define('SECURE_AUTH_KEY',  ';9|2,cmF@}p@h)S67@8yxj(DD`DRD9+[EWI3??msrp!b--`^TSIOw+g<P?s)c<Y6');
define('LOGGED_IN_KEY',    'S4x#j8sA:Y/!?Ckj|j|;Y4^m0Ig;:8t0eR!|e.=LMV=OhY1>&}b&CV4nI`.Ri2bN');
define('NONCE_KEY',        '7O>VSPS-Nd+] -@#QgiV[GU|$e+u564HzZ/*cmZO:D&-XPx}w.;)&/FbH5an.a[Z');
define('AUTH_SALT',        'e_6=i;s|V$9Qh.7t(#+ff~-/7I-kRo%K`P%e+|z/T/A-9`s;*hR8Ur5{& Zn}&G?');
define('SECURE_AUTH_SALT', 'Bo(h9xZ<>_Jp{QEU26(3%+).-tF{|L}fSHej=[l|}aD){5&u40v/-k~X4SG$i<{u');
define('LOGGED_IN_SALT',   'yF!%=u_0y|yb~VBKfG4kd0Kg<3w&dylnjSr3T}T_[Gx>D1GPZ@$!(gTx/]F rX@?');
define('NONCE_SALT',       '.lS[].O+fKB-XXUlQ17`rwRnKh>K-RO|+sLD9YKD7~XZ-V+?N<GG..$j0eCk]I&j');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'iphone_';

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
