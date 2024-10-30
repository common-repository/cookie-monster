<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.2.2
 * @package           Cookie Monster
 *
 * @wordpress-plugin
 * Plugin Name:       Cookie Monster
 * Plugin URI:        http://www.ohayoweb.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress dashboard.
 * Version:           1.2.2
 * Author:            Ohayo
 * Author URI:        http://www.ohayoweb.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cookie-monster
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookie-monster-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookie-monster-deactivator.php';

/** This action is documented in includes/class-cookie-monster-activator.php */
register_activation_hook( __FILE__, array( 'Cookie_Monster_Activator', 'activate' ) );

/** This action is documented in includes/class-cookie-monster-deactivator.php */
register_deactivation_hook( __FILE__, array( 'Cookie_Monster_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookie-monster.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Cookie_Monster();
	$plugin->run();

}
run_plugin_name();
