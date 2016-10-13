<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.tannysoft.com
 * @since      1.0.0
 *
 * @package    Wp_Easy_Grayscale
 * @subpackage Wp_Easy_Grayscale/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Easy_Grayscale
 * @subpackage Wp_Easy_Grayscale/includes
 * @author     Tannysoft <tannysoft@gmail.com>
 */
class Wp_Easy_Grayscale_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-easy-grayscale',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
