<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
	include( dirname( __FILE__ ) . '/wp-config-local.php' );
} else {
	die('Please create a local config file.');
}

if ( false == defined( 'WP_CACHE' ) ) {
	define( 'WP_CACHE', true ); // Added by WP Rocket
}

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         'Ug`r/yVa5?.k[|!{2y(r| S_htWCf*t,v=eU][s*4-$V%8FY6$QXc]5hU[;~.dxD');
define('SECURE_AUTH_KEY',  'F@,SicXXs{HZ+vFP9_@bg3%up;7fZ*ThgD<s$d y)4D=3|-GT?yFZ~>DC;8/|Se*');
define('LOGGED_IN_KEY',    '4ILT4Dek+ejN;||#9+gO?{CyYt$1P[v*95>/`.2`-Dhz B=ix1)?+y|6g&MS-c{X');
define('NONCE_KEY',        '4*0?r}/a;6eBjHZ&TXb!ZEnfCR>)/x 5S{4t+kJ)xZd+RAVXWP)I-*7/k9p._oL{');
define('AUTH_SALT',        'wt`$GJP3@j&V^^WRXr`8D|?7UbNf3 bRC#Qu+m+%sB]P+u_wX5CN#%<)S9>W+zp~');
define('SECURE_AUTH_SALT', 'O#IK#YGB[7S$J-^X[Glmhl*|HkZCpZy4>bbt1dJd`3Nm1CVvlR^{4J=cH}Pvw:bN');
define('LOGGED_IN_SALT',   ' E]oVb-_K5QDn73D3HzU LG=t6Acu|G)cx`YjWF8KtW!C_&X+7ll^oYbJ<Je )%L');
define('NONCE_SALT',       'siQ{rMcUrOIf+aSa?kjK)|WQ|wnO)bc<+B[VVhb4+{Qr}^f6|ZFY3+4R1`]MxdD/');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix = 'wp_';

// ===========
// Miscellaneous settings
// ===========

// W3TC will otherwise keep nagging because we have changing paths
define( 'DONOTVERIFY_WP_LOADER', true );

// We won't be needing the theme editor :)
define( 'DISALLOW_FILE_EDIT', true );

// ===================
// Bootstrap WordPress
// ===================
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}
require_once( ABSPATH . 'wp-settings.php' );