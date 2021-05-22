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
set_time_limit(300);


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'supersapiens_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'supersapiens' );

/** MySQL database password */
define( 'DB_PASSWORD', 'supersapiens' );

/** MySQL hostname */
define( 'DB_HOST', '166.62.28.140' );

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
define( 'AUTH_KEY',         '_zvpY@J_^EG4i?h;~;XnPm,UF[Jci#]dlJWyE]b73/{8/TMoB2RY3}VPRwPE+(t:' );
define( 'SECURE_AUTH_KEY',  'djaTK(r1f[1[IORp!9w#E$wGo71hu9>G3|JC;g~]<.PWkV&@<BzQatRxzE`@V}k7' );
define( 'LOGGED_IN_KEY',    '{T>`@KJdm0|/J23+DB6|v0Qw-srWMSTA6FOU V1V.z@~vd{ipyN(U|:p_[y~R(k2' );
define( 'NONCE_KEY',        'x7!ilSl}}kvmoU#.YoZQI$M2HGTGlfa@V4d?$c0lw?`.qpyxMu;NtQ>,;U%AUR5T' );
define( 'AUTH_SALT',        '>lc0x#6ITC)B5+osWdB{!a$j^QJ>>9lbnZW0{+1[bJD@CbrIeA?58+N,6%,GS=ww' );
define( 'SECURE_AUTH_SALT', 'wQdwzi]Q@[]>k1xpVu` }*3E4q2*>yF^/n)6`l;Z`r)^sw2 )+l`a5@pf> AD+v;' );
define( 'LOGGED_IN_SALT',   'DDa]cL?#pH{>a_({mzCe-ob~3z:7$/*UdM{]NBt=Sm6<h=sJa-MB0o24QR_.v(%,' );
define( 'NONCE_SALT',       'WhGSm(J{*HFt%(uP|gt*{vCc29F?XzwGsZds`n~La[ -JbM8=Kmk7]Cda-/qxD[$' );

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

define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);