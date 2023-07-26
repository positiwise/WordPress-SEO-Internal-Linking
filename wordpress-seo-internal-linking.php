<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://buywp.com
 * @since             1.0.0
 * @package           Wordpress_Seo_Internal_Linking
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress SEO Internal Linking
 * Plugin URI:        https://buywp.com/plugins/wordpress-seo-internal-linking
 * Description:       Generate internal links for your WordPress content that has 0 downfall on Google Penguin Update.
 * Version:           1.0.0
 * Author:            buyWP
 * Author URI:        https://buywp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-seo-internal-linking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WORDPRESS_SEO_INTERNAL_LINKING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-seo-internal-linking-activator.php
 */
function activate_wordpress_seo_internal_linking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-seo-internal-linking-activator.php';
	Wordpress_Seo_Internal_Linking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-seo-internal-linking-deactivator.php
 */
function deactivate_wordpress_seo_internal_linking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-seo-internal-linking-deactivator.php';
	Wordpress_Seo_Internal_Linking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpress_seo_internal_linking' );
register_deactivation_hook( __FILE__, 'deactivate_wordpress_seo_internal_linking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-seo-internal-linking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordpress_seo_internal_linking() {

	$plugin = new Wordpress_Seo_Internal_Linking();
	$plugin->run();

}
run_wordpress_seo_internal_linking();
