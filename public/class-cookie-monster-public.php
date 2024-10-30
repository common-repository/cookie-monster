<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/public
 * @author     Your Name <email@example.com>
 */
class Cookie_Monster_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	
	private $config;
	
	private $public_path;
	
	private $cookie_name;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version , $cookie_name = 'cookie-monster') {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->cookie_name = $cookie_name;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookie_Monster_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookie_Monster_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cookie-monster-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookie_Monster_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookie_Monster_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cookie-monster-public.js' , array('jquery'), 1.0, true);
		
		wp_localize_script( $this->plugin_name, 'cookie_monster', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) ); #ajax_object -> cookie_monster
		
		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cookie-monster-public.js', array( 'jquery' ), $this->version, false );

	}

	public function display_advertising(){
		
		$this->config = unserialize(get_option('cookie-monster-settings',null));
		
		/** si esta desactivado, salimos **/
		if ( ($this->config['cookie_monster_active']=='off') || empty($this->config)) return;
		
		/** si ya existe y esta aceptada no mostramos **/
		#if ( (isset($_COOKIE['cookie_monster'])) && ( $_COOKIE['cookie_monster']== '1') ) return;
		if ( (isset($_COOKIE[$this->cookie_name])) && ( $_COOKIE[$this->cookie_name]== '1') ) return;
		
		/** si el usuario esta logeado y no se ha de mostrar, salimos **/
		//if( ($this->config['cookie_monster_show_registered_users']=='no') && (is_user_logged_in()) && ( $_COOKIE['cookie_monster']== 1) ) return;
		if( ($this->config['cookie_monster_show_registered_users']=='no') && (is_user_logged_in()) ) return;
		
		include('partials/cookie-monster-public-display.php');
		
		
	} 

	public function monster_action_callback(){
		
		if ($_POST['accept'] == 1) {
			setcookie($this->cookie_name, 1, strtotime('+30 day'),'/');
		
			/*
			if (function_exists ('wp_cache_clear_cache')) {
				$GLOBALS["super_cache_enabled"]=1;
				wp_cache_clear_cache();
			}
			*/
		}
		
		die;
		
	}

}
