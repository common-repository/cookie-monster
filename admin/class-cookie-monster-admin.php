<?php
/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.2.0
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/admin
 */
/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Cookie_Monster
 * @subpackage Cookie_Monster/admin
 * @author     Your Name <email@example.com>
 */
class Cookie_Monster_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $message    The message from the update config process.
	 */
	
	private $message;
	private $cookie_name;
	public $config;
	
	
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.2.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $cookie_name= 'cookie_monster' ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->cookie_name = $cookie_name;
		
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.2.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookie_Monster_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookie_Monster_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'wp-color-picker' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cookie-monster-admin.css', array( 'wp-color-picker'), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-tabs', plugin_dir_url( __FILE__ ) . 'css/cookie-monster-tabs.css', array( ), $this->version, 'all' );
		
		# Estilos para los switchers
		wp_enqueue_style( 'toogle-switch', plugin_dir_url( __FILE__ ) . 'css/cookie-monster-toogle-switch.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.2.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookie_Monster_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookie_Monster_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cookie-monster-admin.js', array( 'jquery','wp-color-picker' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-tabs-js', plugin_dir_url( __FILE__ ) . 'js/cookie-monster-tabs.js', array(  ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'cookie_monster_alert_type', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) ); #ajax_object -> cookie_monster

	}
	/**
	 * Save the config for Cookie Monster.
	 *
	 * @since    1.2.0
	 */
	public function save_setup($data){

		if (!isset($plugin))
			$plugin = new stdClass();
		
		$plugin->config = array(
				'cookie_monster_version' => $this->version,
				'cookie_monster_active' => (isset($data['cookie_monster_active'])) ? $data['cookie_monster_active'] : 'off' ,
				# 'cookie_monster_alert_type' => $data['cookie_monster_alert_type'], #DEPRECATED
				'cookie_monster_hide' => $data['cookie_monster_hide'],
				'cookie_monster_hide_time' => $data['cookie_monster_hide_time'],
				'cookie_monster_fixedbar_background' => $data['cookie_monster_fixedbar_background'],
				'cookie_monster_fixedbar_color' => $data['cookie_monster_fixedbar_color'],
				'cookie_monster_show_registered_users' => $data['cookie_monster_show_registered_users'],
				'cookie_monster_position_bar' => $data['cookie_monster_position_bar'],
				'cookie_monster_text' => (!is_array($data['cookie_monster_text']) ) ? esc_textarea($data['cookie_monster_text']) : serialize($data['cookie_monster_text']),
				'cookie_monster_accept' => (!is_array($data['cookie_monster_accept'])) ? sanitize_text_field($data['cookie_monster_accept']) : serialize($this->sanitize_array($data['cookie_monster_accept'])),
				'cookie_monster_info' => (!is_array($data['cookie_monster_info'])) ? sanitize_text_field($data['cookie_monster_info']): serialize($this->sanitize_array($data['cookie_monster_info'])),
				'cookie_monster_info_url' => (!is_array($data['cookie_monster_info_url'])) ? sanitize_text_field($data['cookie_monster_info_url']) : serialize($data['cookie_monster_info_url']),
				'cookie_monster_css' => esc_textarea($data['cookie_monster_css']),
				'cookie_monster_accept_background' => sanitize_text_field($data['cookie_monster_accept_background']),
				'cookie_monster_accept_color' => sanitize_text_field($data['cookie_monster_accept_color']),
				'cookie_monster_info_background' => sanitize_text_field($data['cookie_monster_info_background']),
				'cookie_monster_info_color' => sanitize_text_field($data['cookie_monster_info_color']),
				'cookie_monster_opacity_bar' => $data['cookie_monster_opacity_bar'],
		);
		
		$this->config  = $plugin->config;
		
		if(update_option( 'cookie-monster-settings', serialize($plugin->config) )){
			# success
			$this->message = array('text' => __('Updated!',$this->plugin_name), 'class' => 'updated '); #cookie-monster-updated

		}else{
			# error
			$this->message = array('text' => __('Opps... something happens!',$this->plugin_name), 'class' => 'error'); #cookie-monster-updated
		}
		
		$this->render_alert();
		
	}
	
	
	public function config_page(){
		
		$page = add_menu_page( __( 'Cookie Monster' ,$this->plugin_name), $this->plugin_name, 'manage_options', 'cookie-monster', array($this,'render_config_page'), plugins_url('img/cookie-monster-wp-icon.png', __FILE__ ), 115 );
		
	}

	public function render_config_page(){

		if(isset($_POST['_wp_http_referer']) && ( $_POST['_wp_http_referer']==$_SERVER['REQUEST_URI'])) {
			$this->save_setup($_POST); # guardamos la informacion
		}
		
		$options = unserialize(get_option('cookie-monster-settings', $this->get_default_config()) );
		$this->config = $options;
		
		include('partials/cookie-monster-admin-display.php');
		
	}

	public function render_alert(){

		?>
			<div class="<?php echo $this->message['class']; ?>">
				<p><?php echo $this->message['text']; ?></p>
			</div>
		<?php
		
	}
	
	public function get_wpml_support(){
	
		if(defined('ICL_LANGUAGE_CODE')){
			return true;
		}else{
			return false;
		}
	
	
	}

	private function sanitize_array($array){
		
		$sanitized =  array();
		
		foreach ($array as $key => $value){
			
			$sanitized[$key] = sanitize_text_field($value);
			
		}
		
		return $sanitized;
	}
	
	public function get_default_config(){

		$textos_wpml = 'a:5:{s:2:"es";s:280:"Este Sitio Web utiliza cookies propias y de terceros para asegurar la mejor experiencia al usuario. Si no cambias esta configuración, entendemos que aceptas el uso de las mismas. Puedes cambiar la configuración de tu navegador u obtener más información aquí.";s:2:"en";s:276:"This Website uses own and third-party cookies to guarantee the best experience for Users. If you do not change this configuration, we understand that you accept the use thereof. You can change the configuration of your browser or obtain more information here.";s:2:"fr";s:342:"Ce site web utilise des cookies propres et de tiers pour assurer la meilleure expérience possible à l’usager ; si vous ne modifiez pas cette configuration, nous considérons que vous en acceptez l’utilisation. Vous pouvez cependant modifier la configuration de votre navigateur ou obtenir ici davantage d’information.";s:2:"ca";s:278:"Aquest Lloc web fa servir galetes pròpies i de tercers per assegurar una millor experiència a l\'usuari. Si no canvies aquesta configuració, entendrem que n’acceptes l’ús. Pots canviar la configuració del teu navegador o obtenir més informació aquí.";s:2:"ru";s:64:"Donec sodales sagittis magna. Praesent blandit laoreet nibh.";}';
		$texto = 'Este Sitio Web utiliza cookies propias y de terceros para asegurar la mejor experiencia al usuario. Si no cambias esta configuración, entendemos que aceptas el uso de las mismas. Puedes cambiar la configuración de tu navegador u obtener más información aquí.';
		$acepto_wpml = 'a:5:{s:2:"es";s:7:"Acepto4";s:2:"en";s:7:"I Agree";s:2:"fr";s:17:"Je suis d\'accord";s:2:"ca";s:7:"Accepto";s:2:"ru";s:0:"";}';
		$acepto = 'Acepto';
		
		$default = array(
		'cookie_monster_version' => $this->version,
		'cookie_monster_active' => 'off' ,
		'cookie_monster_hide' => 'false',
		'cookie_monster_hide_time' => '20',
		'cookie_monster_fixedbar_background' => '#5582dd',
		'cookie_monster_fixedbar_color' => '#ffffff',
		'cookie_monster_show_registered_users' => 'yes',
		'cookie_monster_position_bar' => 'bottom',
		'cookie_monster_text' => ( $this->get_wpml_support() ) ? $textos_wpml : $texto,
		'cookie_monster_accept' => ( $this->get_wpml_support() ) ? $acepto_wpml : $acepto,
		'cookie_monster_info' => null,
		'cookie_monster_info_url' => null,
		'cookie_monster_css' => null,
		'cookie_monster_accept_background' => '#efefef',
		'cookie_monster_accept_color' => '#5582dd',
		'cookie_monster_info_background' => '#efefef',
		'cookie_monster_info_color' => '#5582dd',
		'cookie_monster_opacity_bar' => '.9',

		);

		return serialize($default);

	}
	
	public function me_want_cookies(){
		echo '<p><strong>'.__('We are using the following cookies',$this->plugin_name).':</strong><br>';
		foreach ($_COOKIE as $key=>$val){
	
			echo $key."<br>\n";
	
		}
		echo '</p>';
	}

	
	public function alert_type_callback(){

		if(isset($_POST['type']) && !empty($_POST['type']) ){
			$file = plugin_dir_path( __FILE__ ).'/partials/cookie-monster-config-'.$_POST['type'].'.php';
			
			$options = unserialize(get_option('cookie-monster-settings'));
			
			#if(WP_DEBUG == true)
				#echo '<pre>'.print_r($options,1).'</pre>';
			
			if(file_exists($file)){
				include($file);
			}else{
				echo "Error ".$file ;
			}
		}
		//echo '<pre>'.print_r($_POST,1).'</pre>';
		die;
	}	
	
	
	public function get_pages(){
		global $sitepress;
		$result= array();
		$args=array(
				'post_type' => array('page'),
				'perm' => 'readable',
				//'post_status' => 'publish',
				'posts_per_page' => -1,
				//'post__in' => $postids,
				'orderby'=>'title',
				'order' => 'asc',
				'suppress_filters' => 1
		);

		$pages = null;
		$pages = new WP_Query( $args );
		if ( $pages->have_posts() ) :
			while ($pages->have_posts()) : $pages->the_post();
				//$lang_post_id = icl_object_id( $post_id , 'page', true, $sitepress->get_current_language() );
				$result[get_permalink()] = get_the_title();
			endwhile;
			wp_reset_postdata();
			return $result;
		else:
			wp_reset_postdata();
			return false;
		endif;

	}	
}
