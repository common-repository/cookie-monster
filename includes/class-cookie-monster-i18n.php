<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that its ready for translation.
 *
 * @link       http://example.com
 * @since      1.2.0
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that its ready for translation.
 *
 * @since      1.2.0
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/includes
 * @author     Your Name <email@example.com>
 */
class Cookie_Monster_i18n {

	/**
	 * The domain specified for this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $domain    The domain identifier for this plugin.
	 */
	private $domain;

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.2.0
	 */
	public function load_plugin_textdomain() {

		
		$res = load_plugin_textdomain(
			$this->domain,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
		#$res = load_plugin_textdomain($this->domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	}

	/**
	 * Set the domain equal to that of the specified domain.
	 *
	 * @since    1.2.0
	 * @param    string    $domain    The domain that represents the locale of this plugin.
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
	}

}
