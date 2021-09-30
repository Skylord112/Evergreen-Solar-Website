<?php
define( 'WP_CACHE', true );    // Added by WP Rocket.
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
define( 'DB_NAME', 'egnrecom_wp196' );

/** MySQL database username */
define( 'DB_USER', 'egnrecom_wp196' );

/** MySQL database password */
define( 'DB_PASSWORD', '3yW0.p]U9S' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'uhbnbmukthyv07z9n4lctmurxjfyfkpmi0hipjvg8omaeg2ltp2i3commpy9eqxv' );
define( 'SECURE_AUTH_KEY',  'wx015xts5esnzdujbbvio4px42kbowwbmo0fcxrivtizitr62kdqehorwvkuqqai' );
define( 'LOGGED_IN_KEY',    'qwetvuzxed0jr6ugvdc1q2dk0ivzwl51azpkksia7qs1s0ijjnsq1f4oessmhiaa' );
define( 'NONCE_KEY',        's0zfnoahaz7kfhd7tv8n1s4ns9ogr7f4twd1eji2wkj0sc5f5cry2snl2sccr0mm' );
define( 'AUTH_SALT',        'mwkjbk1p9cputaokifothzovwpbwnoaqntjtesjozcv2krib55hdxk02s5hfcq1b' );
define( 'SECURE_AUTH_SALT', '0itzcnmpritlevkaxttb448j2mwfmxfebxk7ifyjdymrigs8rt6jqzlve4i3nv6a' );
define( 'LOGGED_IN_SALT',   'gxsb64gyxup0ou8bzd1gwdu1pe7nz7sbdn5owyqoad4qkh57pf4hwpznncls3jks' );
define( 'NONCE_SALT',       'lwpi9kefpqjhlcy7r1qzcvg1ghwcllyir8qf1zdm41p7trdlpfj87g6gnsrkwfnx' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpww_';

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
