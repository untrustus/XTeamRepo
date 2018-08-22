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
define('DB_NAME', 'lapizzeria');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'uuXiW9![.TFF[P<AvNv14D>*;[cPv6S/MyIL3+L!D{m)5iBkQ_I9wn2M`7G>pK4;');
define('SECURE_AUTH_KEY',  '#GFz,R~%]2Gg,Jwx U~mEtXoIE3K3zK]F#GhLfMBu(5KX+=3@ww$0vND*^9PwPAs');
define('LOGGED_IN_KEY',    'b;)P$PGm~{w]7Lf{E{Ii0?HKytYH|rL2HpyD6CI</P.AY~:)*U;P]:rl3{OL@^(p');
define('NONCE_KEY',        'KPw7^bEhIW~hFNZAF7<%H 8BX0pJNM>u/MPp]kGv9[Dr4n:@x3mt5(v_fw]-xAY,');
define('AUTH_SALT',        '3ZdhqPyK9`ht!k6n `?Y@c[;0+L%?}|oa,7l5HT8b55pgZo^`K+-#J2, 1_=rd*)');
define('SECURE_AUTH_SALT', 'WyQg^w@~]Y^vjwB74aPS!7 6c1ei;% c>M@n;JtL>SbX_9^.0znQI}6lI>UOc^x%');
define('LOGGED_IN_SALT',   '/3d~g _MV/3-E8;hT+j:][brrV2@| 3E NDD%`vo2r*H24eDs]u@({L`O2l>e*7N');
define('NONCE_SALT',       'm=C=hm9jtv1q:nFyK-r8bNmHiR}je&6rMnCJU;MJv4~@;-4X@c`BrM?=<#;P-N2A');

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
