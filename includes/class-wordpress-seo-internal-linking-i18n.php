<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://buywp.com
 * @since      1.0.0
 *
 * @package    Wordpress_Seo_Internal_Linking
 * @subpackage Wordpress_Seo_Internal_Linking/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wordpress_Seo_Internal_Linking
 * @subpackage Wordpress_Seo_Internal_Linking/includes
 * @author     buyWP <plugins@buywp.com>
 */
class Wordpress_Seo_Internal_Linking_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wordpress-seo-internal-linking',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
