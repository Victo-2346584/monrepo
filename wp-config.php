<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
define('HEBERGEMENT_LOCAL', true);
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if ('HEBERGEMENT_LOCAL'){
    define( 'DB_NAME', 'wordpress2024_nadeauhugo' );
    /** Database username */
    define( 'DB_USER', 'wordpresshugo' );
    /** Database password */
    define( 'DB_PASSWORD', 'qwerty1234' );
    /** Database hostname */
    define( 'DB_HOST', '127.0.0.1' );
    /** Database charset to use in creating database tables. */
    define( 'DB_CHARSET', 'utf8mb4' );
    /** The database collate type. Don't change this if in doubt. */
    define( 'DB_COLLATE', '' );
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', dirname(__FILE__, 2) . '/debug-' . date('Y-m-d') . '.log' );
	define( 'WP_DEBUG_DISPLAY', true );


}
else {
    define('DB_NAME', 'uk_wordpress2024_nadeauhugo');
    /** Database username */
    define('DB_USER', 'uk_wordpresshugo');
    /** Database password */
    define('DB_PASSWORD', 'Sololeveling');
    /** Database hostname */
    define('DB_HOST', '127.0.0.1');
    /** Database charset to use in creating database tables. */
    define('DB_CHARSET', 'utf8mb4');
    /** The database collate type. Don't change this if in doubt. */
    define('DB_COLLATE', '');
	define( 'WP_DEBUG_LOG', dirname(__FILE__, 2) . '/debug-' . date('Y-m-d') . '.log' );
	define( 'WP_DEBUG', false );
	define( 'WP_DEBUG_DISPLAY', false );
}

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
define( 'AUTH_KEY',         '>2o63kkB|bBN$peL|{`$8^MZ8$}./7oYQx|;d7S|j9Fd~oXoQeB q-}~Xi29vL5`' );
define( 'SECURE_AUTH_KEY',  '+Nzh8?}1s9{v+.AnqBW |LM!$2#l~2M4p@0UC~]EJ!<[K0{b{]>L%USpdR!H)2lO' );
define( 'LOGGED_IN_KEY',    'fGn9G+^.d]#!0YWr8Ghr#I.iM2.tu|NX }(^w[d3+lsd2k_]OL;+ai9C9++(B0P7' );
define( 'NONCE_KEY',        '3oqgcgR gJKv]wB6E-%(8Z fo^/!xS=Y,cW3q]Z!6dMSxY)Ip_x?_Z)befLh/b.5' );
define( 'AUTH_SALT',        '}~5UQ4WCn_aSYH)f.~fc)qWOz7<%`/kI_;#Gh<y01r_N+po-a{xMY]%B=2Bg1=ke' );
define( 'SECURE_AUTH_SALT', ']y|lvl|.yyihI(z>!82^WI%K;YJ9Z7D:HRvmU0j>-t^IK^jn5V%s}D~8d[a.JmM7' );
define( 'LOGGED_IN_SALT',   '/[/$2QZOytzUKI~!9t4$&6$FoN,(.2L/%`2=7B!KuK2=>SR~B0k-,t~|`c;@}Od|' );
define( 'NONCE_SALT',       'RB4f*z0t{`3!@$7>|ry6cZK:`!f,QW?twL||/d7r&(2Ao>g{Rnag2.I_Z:ClgTo8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dcf227_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */

/* Add any custom values between this line and the "stop editing" line. */
// Active (true) ou désactive (false) le mode débogage


// Pendant le débogage, lorsqu'une erreur est rencontrée, n'affiche pas de message d'erreur à l'écran.
// Plutôt, WordPress enverra un codes d'état HTTP 500 au navigateur.

// Pendant le débogage, WordPress enregistrera les messages d'erreur dans un fichier daté situé un niveau au-dessus de la racine du site Web.
// Note : si la constante est simplement initialisée à true, les messages seront enregistrés dans le fichier wp-content/debug.log.

// En production (lorsque WP_DEBUG est à false), n'affiche pas les erreurs à l'écran.
@ini_set( 'display_errors', '0' );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
