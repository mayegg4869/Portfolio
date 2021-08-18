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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xJXJyOXiJxyExD24PZTUZ6/fiWi5LlJLoiELkvZf+8VjBQM74yUVC5cpIy5csfTHnIE9gb59nAU2Tkr1PZlR2g==');
define('SECURE_AUTH_KEY',  'NxVqU2CYF30fceS8LgMCbzpbwD0cqOc0RL1Xc35mnbnfQFPEltHcsBj6gJ8J5Er4nnH87mfU9OJ6FeUn7bVHuQ==');
define('LOGGED_IN_KEY',    '/iuKG54y/0QfogfQSB5l/aiZVOrpqWS1N8k7X8L84I+hNSdm9P3ZnDZRM8/FJZl0wJ1i/Vd7HJitiYsXaU4s4A==');
define('NONCE_KEY',        'kx9HFEwxXoVceHgOtp62vJG42vL2BOkrOC/NDXvN6907IIpdIJxjzHc9HPZ1WsHA1z01JadLn4bV9/6cpNVqrg==');
define('AUTH_SALT',        'f+g9NwTIK6wGi7Hk0B5rY+1Ygbn55ZS58HMY7hlw+Ms5jOOx86JLeUEmYZ1qBAHFf7hWIfl2O6+DdE3qmky1bA==');
define('SECURE_AUTH_SALT', '9YAk0KUnchAI7fr29BfXkVOFabPWSOxmqb55hzzq929UK9SfobDHkbMnCXFT+zQxMLPnzPZrwS/9rve2eGkJ9A==');
define('LOGGED_IN_SALT',   'hTCVeC3PSuDhi2sFLu4Av6kH6o3z5TJl3+Bs9rQafB+i/EMPsoz0SF751f9M3HFE46sA05B7uSJv/NrKXnLGsQ==');
define('NONCE_SALT',       'SC1iyLRPHkfHRZ3rxWknqehqrws8pVkaW60/dC13dYp8v1Q+DkTB6ca6dit5YGGt1TmaLl4A/8M1pMCj5f0xxg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
