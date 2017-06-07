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
define('DB_NAME', 'schedule2');

/** MySQL database username */
define('DB_USER', 'schedule2');

/** MySQL database password */
define('DB_PASSWORD', '(uo!6K8P5S');

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
define('AUTH_KEY',         'puoidrhij9riswj18bfl8qhckusrefz6himme3juzglczojngod9eawumvxrznt6');
define('SECURE_AUTH_KEY',  'xa8atpaxtbgg8odkbvyxcoh1hsv7xcpqgyoi9ed0unjdozdmgauaqlpkfhcl6tml');
define('LOGGED_IN_KEY',    'u9juaqyvajd7tz2kqqgk3hpsfwavp6ozmbzy4rneykukpg6t1qbtlh4ayq56hpe6');
define('NONCE_KEY',        'mlvydxxjnfe5ptnhwf7ig1qacsbs1do6ncyhwm8bsjhrad6f3gaa1mxaczt23gcv');
define('AUTH_SALT',        'r8is7uqnkaxuk19mhp6hi8lwzwrg7lvaf8raoqfzwlmgkw5mtxokmmsmege7qaw0');
define('SECURE_AUTH_SALT', 'mnyigw5zwnn3d0pdtjcamojexozeqmvhesrzpdqp89zmaucuvzw9zddrokvzhmck');
define('LOGGED_IN_SALT',   'hmfetqjozgjirfh5lm28bsrxtdpzdbwiq2ffw7zvqkkz3t6zcthaa4jvuicndivr');
define('NONCE_SALT',       'r7uf2vwafjn3zj6u824rdrosgl4jbzj8pfbri9zgmbxo77oavhfhw69xlwte28cs');

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
