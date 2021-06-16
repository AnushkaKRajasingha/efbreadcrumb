<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.upwork.com/fl/anushkakrajasingha
 * @since      1.0.0
 *
 * @package    Efbreadcrumb
 * @subpackage Efbreadcrumb/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Efbreadcrumb
 * @subpackage Efbreadcrumb/includes
 * @author     Anushka Rajasingha <anudevscs@gmail.com>
 */
class Efbreadcrumb_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'efbreadcrumb',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
