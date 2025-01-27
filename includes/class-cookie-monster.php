<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://example.com
 * @since      1.2.0
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.2.0
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/includes
 * @author     Your Name <email@example.com>
 */
class Cookie_Monster {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.2.0
	 * @access   protected
	 * @var      Cookie_Monster_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.2.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.2.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	protected $config;
	protected $cookie_name;
	
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.2.0
	 */
	public function __construct() {

		$this->plugin_name = 'Cookie Monster';
		$this->version = '1.2.0';
		
		$this->cookie_name = 'cookie-monster';
		
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cookie_Monster_Loader. Orchestrates the hooks of the plugin.
	 * - Cookie_Monster_i18n. Defines internationalization functionality.
	 * - Cookie_Monster_Admin. Defines all hooks for the dashboard.
	 * - Cookie_Monster_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.2.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cookie-monster-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cookie-monster-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cookie-monster-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cookie-monster-public.php';

		$this->loader = new Cookie_Monster_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cookie_Monster_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.2.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cookie_Monster_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		//$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		$this->loader->add_action( 'init', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Cookie_Monster_Admin( $this->get_plugin_name(), $this->get_version() , $this->get_cookie_name());

		$this->loader->add_action('admin_menu',$plugin_admin,'config_page');
		

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action('wp_ajax_cookie_monster_alert_type', $plugin_admin, 'alert_type_callback');
		$this->loader->add_action('wp_ajax_nopriv_cookie_monster_alert_type', $plugin_admin, 'alert_type_callback');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cookie_Monster_Public( $this->get_plugin_name(), $this->get_version() , $this->get_cookie_name());

		$this->loader->add_action('wp_footer', $plugin_public, 'display_advertising');
		
		$this->loader->add_action('wp_ajax_cookie_monster', $plugin_public, 'monster_action_callback');
		$this->loader->add_action('wp_ajax_nopriv_cookie_monster', $plugin_public, 'monster_action_callback');
		
		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.2.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.2.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.2.0
	 * @return    Cookie_Monster_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.2.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the cookie name of the plugin.
	 *
	 * @since     1.2.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_cookie_name() {
		return $this->cookie_name;
	}
	
	
	
}
