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
define( 'DB_NAME', 'iservice' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Adeniran1255$' );

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
define( 'AUTH_KEY',         '<5AFI!]A4,ys$BIsVrV1aqEcqB2$Hf`Si&#M/[pHx_*4>Gk(eX,nrQNqZ_]S2.a=' );
define( 'SECURE_AUTH_KEY',  '>:y_8ns<9=`e]a Hh4:wz3v45`k7ha<ERoKD^,(9Ot)TR/4QJP*}U`u&JiKGKbJ ' );
define( 'LOGGED_IN_KEY',    'MfFwyr,j]ow`LLQ4hg]~n`X[~yibl_5jFj.V_t2<ZY~fLZ91WDx}nN9JNN3xt$KE' );
define( 'NONCE_KEY',        '/U4NT*Lmt,L7,$x2ex!w:n1*N* 4{t[!,mFjYV`v{gV1<&1SPT=jHc;1=SfF|[(v' );
define( 'AUTH_SALT',        '#S/xvAe[Z$X&LWRuj! <_4JQKQ2&9ae=~.lW/h`q)x6|{aea!AR<_]@v%Tk8 [|<' );
define( 'SECURE_AUTH_SALT', '[DBsqCqqV78Y7$r[h*8n3P3>4YX1:U_%utN{-S>@mJFdzbQ1/E7^r@#%RL*^+pF{' );
define( 'LOGGED_IN_SALT',   '^jnrq2CB-2{qQq!ggX a<CJ,qI+Z`sIBK:A:#vUH;><y@_;P~1nA^JP4sf!eZBUZ' );
define( 'NONCE_SALT',       ']>S@,/vR=T9J98[4~.N,i==lytB<t.Ik1MKvdq(aR9qQI[1fIFhu#o&4&~/9^]v7' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
