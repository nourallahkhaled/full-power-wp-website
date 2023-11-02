<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'ZlxX(h5nS2[nuQM7jRN{sQa#eV,}YhppBGJZTg^Cv1B`fr6!7L/eLTVj(e9D/r&!' );
define( 'SECURE_AUTH_KEY',   '3s3$`U;Zcaaqnyl)9<2s7<WSE}a_7RdR=}Vt]jJ-u[A=%O$7E3kNFv(W-Py TS#d' );
define( 'LOGGED_IN_KEY',     ')~i~*NLx`RT/R`m:10HCuutlB$e=(zWyB)fFY)Jr(sR2EB)0LxP:<Sqja0N@=]2)' );
define( 'NONCE_KEY',         'dlR!G6gTJ.L_l_0).fQ(pwRey~9!KT1:]EJ_=ouNa}k#;X;0g;svER{K:1XI>4e#' );
define( 'AUTH_SALT',         'Ya_{Zo|j~DusN`hbgm^ZTwD8w2M]-SaLcdLV+mx-ZaND~7Em?$XXAt wD:4Vt_K[' );
define( 'SECURE_AUTH_SALT',  'e^)2.MKiG*(IeUu;w>oR~x0w$^ag:nFw[6<{julxZ&(FFrx,,Q<6mJjq5@cwTRg&' );
define( 'LOGGED_IN_SALT',    'OX@&.i_w%JW.!*n},|MadZ35VZW{kx*O ^`-[7HM2NIU/sI.Uu)<<F9aMr:gJ*N2' );
define( 'NONCE_SALT',        '+c6mSI}};II9Hf8s/W=w<Gw,IdHR}ydOx;;mfaZ3jmQ%5WV$r3,wN$L{{tnPnpmz' );
define( 'WP_CACHE_KEY_SALT', 't_f??969xi5i;%]BcWu8Q-=fR]N*4%:e>Tw8s;J{xp3p0f }xB6OF.qSJ~;mLM1e' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
