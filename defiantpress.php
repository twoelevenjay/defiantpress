<?php
/**
 * The plugin init file.
 *
 * @package DefiantPress
 * @version 1.0.0
 *
 * Plugin Name: DefiantPress
 * Plugin URI:  https://github.com/twoelevenjay/defiantpress
 * Description: This is not just a plugin, it symbolizes the hope that Defiant will find the developer they need, and that developer would be me. When activated you will randomly see a Defiant team member in the upper right of your admin screen on every page. Although I took inspiration from the first WordPress plugin ever, "Hello Dolly", every line of code is original and authored by me***. *** I used 3rd party dependencies for the web crawler. These are all located in the dependencies directory.
 * Author:      Leon Shelhamer
 * Version:     1.0.0
 * Author URI:  https://211j.com/
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 **/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'DEFIANTPRESS_VERSION', time() /*'1.0.0'*/ );
/**
 * Current plugin name.
 */
define( 'DEFIANTPRESS_NAME', 'defiantpress' );
/**
 * Plugin directory URL.
 */
define( 'DEFIANTPRESS_URL', plugin_dir_url( __FILE__ ) );
/**
 * Plugin directory path.
 */
define( 'DEFIANTPRESS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Set transient used for conditionally showing welcome tutorial on plugin activation.
 */
function add_welcome_transient() {
	set_transient( 'defiantpress_welcome_message', array() );
}

/**
 * Remove transient used for conditionally showing welcome tutorial on plugin deactivation.
 */
function remove_welcome_transient() {
	delete_transient( 'defiantpress_welcome_message' );
}

register_activation_hook( __FILE__, 'add_welcome_transient' );
register_deactivation_hook( __FILE__, 'remove_welcome_transient' );


/**
 * Run all dependancies and the main plugin class.
 */
require DEFIANTPRESS_PATH . 'dependencies/Goutte/vendor/autoload.php';
require DEFIANTPRESS_PATH . 'dependencies/Goutte/Goutte/Client.php';
require DEFIANTPRESS_PATH . 'includes/class-defiantpress.php';

use DefiantPress\DefiantPress;

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_defiantpress() {

	$plugin = new DefiantPress();
}

add_action( 'plugins_loaded', 'run_defiantpress', 1000 );
