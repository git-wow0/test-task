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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test_task' );

/** Database username */
define( 'DB_USER', 'mysql' );

/** Database password */
define( 'DB_PASSWORD', 'mysql' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'En:~usnS 490JFJ.QpSw!zNf6bSP1NyT1*,n~IW6IAfUtg#Q^mga=gun,noUxn61' );
define( 'SECURE_AUTH_KEY',  'P#:6R,Ma^5!4l,sVw|X(&PY|+=#I(tF4jS|`:)hZEYSj:j]5mH{hd;9J}$liqAwe' );
define( 'LOGGED_IN_KEY',    'oQ:te9tI|`q(z[:l><jg.2g/XxPqe~9|oK^F-0NG+)VwU)H2~{Z[IoK~~M3O=tf+' );
define( 'NONCE_KEY',        'mJ}gV1w1zxYJ_fx)~K>!WEqL9]0v_cva]EmMnCNzzMQXG?3b=G^(44ePJE+r#!g9' );
define( 'AUTH_SALT',        '%8HqB+/F}%%mFk[;3s,lAPI;`Dm+I`1J~13t2I@$DhJe[%}fm99ZMur8RJje$7:K' );
define( 'SECURE_AUTH_SALT', '-=Qp<#!~&sM_rdgIYU|j0>bkc9bytoPXiu?][a5*kC6]v McJkytqW&9,.VGV3):' );
define( 'LOGGED_IN_SALT',   '[obFegam:QC-p^$0;>2&][WblHSB}XPw!i6mB?1 >vm4x$;WFKp*#gw2 J*$/S<8' );
define( 'NONCE_SALT',       '+36xgcu<Q$U{1X{[W0!JI@nZ@7b@T]2<(JYFmU25k}!^|Bsd(}!Y$0`x!1%DGyj;' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
