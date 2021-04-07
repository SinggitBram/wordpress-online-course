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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'online_course' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** INI SUPAYA BISA INSTALL THEME KETIK INI DI WP-CONFIG.PHP*/
define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'RtFqR/SGaTXS%CO$Ciob7^2X7xDx0t^zu/1#7]=5~(He5d8KZS{~^C8eRg+{Qq,2' );
define( 'SECURE_AUTH_KEY',  'cR4%Kz-}I+bW@0jCG7&Z^,VJ5%VcgLLBa2tE{[)}?!a.nQ;^M4U-oE8|:Ycsy_Y>' );
define( 'LOGGED_IN_KEY',    '800yfo8f.d]V5KRINRD|z}^|.z5dMrS=um}NG|#%K,-#$*hR3F3yE>pKt1IA_pev' );
define( 'NONCE_KEY',        '7qYj&rhB@NJ]iXG`q&;5:I[=aAX}2kNk,z.}8#O%u,m]$3u@<-*20mpIyaEL_${K' );
define( 'AUTH_SALT',        ' Ja-g?n?ect^r %<Hl8qJ{G-#Sbl q k<Jx?rDa_Z6wU3qNPZ&Z(uR/av{G0qd#Z' );
define( 'SECURE_AUTH_SALT', 'C/?d@b@)i6f78`lQq!Rep1fm2t^?sTpYoO5]ix03jL 0@TqLzDX[x_/7d,Q^7|l-' );
define( 'LOGGED_IN_SALT',   'm^Jc~.Ulo}mkYFuqUMkxAZha0PhoqUbJx0hw6BVkyI%n:K#[0COVxo*ReQ_P%:kO' );
define( 'NONCE_SALT',       's<:8y2;O#I,$hFMRJWjpOpQWr[SjtB=<l6o0P#B$e5;TZA)09D2UI{(Y?(4:=h?{' );

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
