<?php
/**
 * The plugin init file.
 *
 * @package DefiantPress
 * @version 1.0.0
 *
 * Plugin Name: DefiantPress
 * Plugin URI:  https://github.com/twoelevenjay/defiantpress
 * Description: This is not just a plugin, it symbolizes the hope that Defiant will find the developer they need, and that developer would be me. When activated you will randomly see a Defiant team member in the upper right of your admin screen on every page. Although I took inspiration from the first WordPress plugin ever, "Hello Dolly", every line of code is original and authored by me.
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
 * Currently plugin version.
 */
define( 'DEFIANTPRESS_VERSION', time() /*'1.0.0'*/ );
/**
 * Plugin directory URL.
 */
define( 'DEFIANTPRESS_URL', plugin_dir_url( __FILE__ ) );
/**
 * Plugin directory path.
 */
define( 'DEFIANTPRESS_PATH', plugin_dir_path( __FILE__ ) );
