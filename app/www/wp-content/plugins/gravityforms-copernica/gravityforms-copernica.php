<?php
/*
	Plugin Name: Gravity Forms Copernica Add-On
	Plugin URI: http://www.florisplof.nl/
	Description: Integrates Gravity Forms with Copernica allowing form submissions to be automatically sent to a specific Copernica Database in your Copernica Account.
	Author: Floris P. Lof <floris@florisplof.nl> and Arjan Snaterse <arjan@uprise.nl>
	Version: 0.2
	Author URI: http://www.florisplof.nl/
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // exit if accessed directly
}

//define some handy dandy constants
define( 'GFCA_DIRNAME', dirname( plugin_basename( __FILE__ ) ) );
define( 'GFCA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'GFCA_LANGUAGE_PATH', GFCA_DIRNAME . '/languages' );
define( 'GFCA_PLUGIN_URL', WP_PLUGIN_URL . '/' . GFCA_DIRNAME );
define( 'GFCA_TEXTDOMAIN', 'gfca' );

# Include classes
require_once( 'classes/class-core.php' );
require_once( 'classes/class-api.php' );

# Load classes
add_action( 'plugins_loaded', function () {
    $gf_copernica_addon_core = Gravity_Forms_Copernica_Addon_Core::get_instance();
    $gf_copernica_addon_api = Gravity_Forms_Copernica_Addon_API::get_instance();
} );