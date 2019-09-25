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
define( 'DB_NAME', 'wp_personal_page' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin5' );

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
define( 'AUTH_KEY',         '7&C#)72Qi^C+s[pta-f)>-a5*2?(IMVU `*q&T0b^%v F[@>|~W1Z9LR:H?C=2LF' );
define( 'SECURE_AUTH_KEY',  'nbf(8o8mJuaqjwy[q$_vI(N?3ZF4g/]UxV~S/7Xfu/(>YX-OO>UFRy+Hd#;X hZa' );
define( 'LOGGED_IN_KEY',    '`eb@,+:?M;2dN^ixLgFf~Tr,8.a}g9GK$$h7C}WeU%3f#@^Qv61muOA7WD%F^{ZS' );
define( 'NONCE_KEY',        'Z^(qb~lgp/pOk]*[Nw4;2ncnwpq)~5)(98g7?gJ*dp-%L+Et.L.VVFi&|T)ChU,|' );
define( 'AUTH_SALT',        'QZ!t@XH_YeATkD@bz[g0`|]!&s:_N U^|^X1-IFBD-.Nj4K<T17rZ_#2h@my+Ry[' );
define( 'SECURE_AUTH_SALT', ';J$!TNqVu$6V|,GiiD8)UNR+Qb82mW7h]llsUG).F/}QZG7jEGB44w18!=or3UI@' );
define( 'LOGGED_IN_SALT',   'esudzy:U$f5wy2ygyb#+bQ-jgsJiGZ/g8u4t4[P&0&.u&_dI(@}skBGwl~g@Mpm%' );
define( 'NONCE_SALT',       'O#4`c7meRG}e~>.Jc&vH2(#JFPLar(GfcfUWNgeqIGm8Q?w=*jZHy??7K{,20xX!' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wppersonalpage_';

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
