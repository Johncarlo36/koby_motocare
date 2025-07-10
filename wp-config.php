<?php
define('WP_CACHE', true); // WP-Optimize Cache
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
define('DB_NAME', 'ktvybhmy_kmc');
/** MySQL database username */
define('DB_USER', 'ktvybhmy_kmc');
/** MySQL database password */
define('DB_PASSWORD', '[58p4I3S[H');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'WP_MEMORY_LIMIT', '256M' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'f7801150d29e5ff3974898e6ada27bcf9956782fa6a06dd7fdf0272b555b3c93');
define('SECURE_AUTH_KEY', 'dc4c626003f7153e8fe1de5a8a5912228db2b815e6137f9ee4a44dab3e04df36');
define('LOGGED_IN_KEY', '28847ce546cc95eaa95db00ff2e78afd9d961b2bfec7a393d130c68c5e73de57');
define('NONCE_KEY', 'de23317c9dea7bf3da804dcfa35a6bda2665ccabe1f2fc5df07a5ade95633186');
define('AUTH_SALT', '791b4b053055e0846e6c035c671f242b88ec196894f1e6c91ff4e8e481c6fadc');
define('SECURE_AUTH_SALT', 'b25721ae814b5b474b60a247176fa71639688b9e475269201dd017080225e8dd');
define('LOGGED_IN_SALT', 'a5201e90fa807bb22e0c2478129cca546b2b00c1339ec4ea2b2ed2743e28c6f0');
define('NONCE_SALT', '46133d411903fd907f662c6a3029cf4f72d062a290469e8e0471f7c3767b7ef0');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'S8B_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);
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