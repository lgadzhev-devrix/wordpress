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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'lgadzhev');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'e+nqyT5Hv7vJUIuA+U%I>)l?pU[}[hZQ20N,kd?oc*_iJ1iFMJIn a(Pu-2(vKEh');
define('SECURE_AUTH_KEY',  ';d#V@a9 y.!OL@w=Kk`wJHLff_!u8+!kj%e2Ctfr?#4VaB#3FQ/iHZSVnOQqh^[F');
define('LOGGED_IN_KEY',    '):QU/+IuwvjG^Owf:mSaNrS!bh`#)f`oS@Ag `i$=U<0?Rp:tt%y5R! NTEP`U0F');
define('NONCE_KEY',        'F[[FdUm6iOJErN%z)H5Zo^JFOU/wP8]/NA%SMN=BP-(3HZ^X:xXWhfl0C,8wmnU-');
define('AUTH_SALT',        'jY-C5qLkRA:lL]+Q9o) G>`P0Sa&P.X];,D<a!t#@r=l3|oit,2hxQ{I34=qrh!k');
define('SECURE_AUTH_SALT', 'z)n8H6b`7qMj*]>Jy`=k]f7m+;Va#,Kq>b,?[Tz`Bog%|=9+FHz;L7eyyE@V!UQO');
define('LOGGED_IN_SALT',   '4Z[.SSPNxH|31!aI,P_`HC_ln vjtpgr^]$9/nxPzL`7?JYU1H<-ZlVP&lMg`a#<');
define('NONCE_SALT',       ',hOQL![#|Ay@3*-!9}jD%+[}7@RB_<s1S|tPo0_Jg6t_Ca*iXbN,yR+{keT*i0)N');

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

