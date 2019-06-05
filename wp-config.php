<?php

// If a local config file exists
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
	// Use these settings on the local server
 	include( dirname( __FILE__ ) . '/wp-config-local.php' );
} else {
	// Otherwise use the settings below on staging/production
	define('WP_HOME', 'http://royal-rewards.ftscorch.com');
	define('WP_SITEURL', WP_HOME);

	// ** MySQL settings ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'db_royal-rewards');

	/** MySQL database username */
	define('DB_USER', 'forge');

	/** MySQL database password */
	define('DB_PASSWORD', '4S0acP0xO3YZM8T1kGnP');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Define the environment, for Roots/Sage */
	define('WP_ENV', 'production');
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don\'t change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'O8+79zMKzHi8xANswOiqKr4hGqg6yt1lW0pbWJo6USYJ1ICpjk90HJh1W8LIPGTcL1Z4K4qp7dmhUpDxnKR/jg==');
define('SECURE_AUTH_KEY',  'vMBOpFCzD17Mb284JgvZFY1IZqklJTYJ2okUJa87xzrudn5pYXpHgs9QqKSQmkpB6NVL4dyMI6VTFkNUU4omWQ==');
define('LOGGED_IN_KEY',    'badfGGV4sS4V9DhiAQemoHfMXy0p2JCNE0g6c79cATStpggpbli7SXg/fD/x8CkPTNy5Pjjrj/j4VD9H00RUaA==');
define('NONCE_KEY',        '82pCwGXg8RKHiWiUuJvgY1JKrIdEuQW1pfWn4WVmWdw9fxNvDJ7XIqRhs1+3r3U4uUbVvY0IUpDsMdnR1tSK6w==');
define('AUTH_SALT',        'M+Wafdj0uG5JcocfD4SaAkrHm6yaWrV+VaIfb3YCWLnAt6TT1C9tBuuEA7Agazf3DeL6qZAr6FGI8BPyr/sNJw==');
define('SECURE_AUTH_SALT', '69gbQO9FEViycwQVplP7U4Ah/qdi0DqSH7lAQuWc+gXI1GXGmWp8t7gJJGQNy5UJHK9UeEBBED3YnUNUd+L+Og==');
define('LOGGED_IN_SALT',   'mX1B5YE6BvCS3OokzFA9aKuszbwg6ym25klzYPbRCUSqZafDNqRRlRD2GUiAMlkOy2I1GAtZnk1QN4mRusC+Lw==');
define('NONCE_SALT',       '7k2ajHrFQV8pNIAd0kXxScK+OWu0WqVmcZ/TRWmFDOmmDqsHyjKFyWI4bCa8eenW3L0zM3+pDXETmbfSVTlQSw==');

$table_prefix = 'ft_';

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'AUTOMATIC_UPDATER_DISABLED', false );
define( 'WP_AUTO_UPDATE_CORE', true );
// define( 'WPCF7_AUTOP', false );

// JWT
define('JWT_AUTH_SECRET_KEY', 'Ad0kXxScKOWu0WqVmcZTRWmFDOmmDqsHy');
define('JWT_AUTH_CORS_ENABLE', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
