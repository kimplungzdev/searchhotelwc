<?php
/**
 * Plugin Name: Searching booking woocommerce
 * Plugin URI: http://www.google.com/
 * Description: searching custom with woocommere.
 * Version: 1.0
 * Author: Abdurrahman Hakim
 * Author URI: http://woothemes.com
 */

class KONSEP_WC_booking_searching {
	/**
	 * main class
	 */
	protected static $_instance = null;

	/** 
	 * load template
	 */
	public $templates;

	/**
	 * Constructor
	 */
	public function __construct() {
		define( 'KONSEP_SEARCH_WC_TEMPLATE_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/' );
		define( 'KONSEP_SEARCH_WC_ASSETS', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/assets/' );
		define( 'KONSEP_SEARCH_WC_INCULDES',  untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/includes/' );
		define( 'KONSEP_SEARCH_WC_VERSION',  '1-HQM-1d' );

		//create include file
		$this->includes();	
	}

	public static function instance() {
		global $wc_bookings;
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		add_action( 'plugins_loaded', array( self::$_instance, 'setup_objects' ) );
		add_action( 'wp_enqueue_scripts', array( self::$_instance, 'load_script_front_end') );
		return self::$_instance;
	}

	/**
	 * Include files
	 */
	private function includes(){
		require_once KONSEP_SEARCH_WC_INCULDES . 'class-wc-template.php';	
		require_once KONSEP_SEARCH_WC_INCULDES . 'class-wc-shortcode.php';			
	}

	/**
	 * Create set up Object
	 */
	public function setup_objects() {
		self::$_instance->templates 	= new KONSEP_WC_Templates;
	}

	/**
	 * Inizialaze plugin
	 */
	public function plugin_url(){
		return untrailingslashit( plugins_url( '/', __FILE__  ) );
	}

	/**
	 * Load script front end
	 */
	public function load_script_front_end()
	{
		// Load Javascript File 
		wp_register_script( 
			'datepicker_konsep_search', 
			$this->plugin_url() . '/assets/datepicker/js/bootstrap-datepicker.js', 
			array(), 
			KONSEP_SEARCH_WC_VERSION, 
			true 
		);
		wp_enqueue_script('datepicker_konsep_search');	
		wp_register_script( 
			'range_konsep_search', 
			$this->plugin_url() . '/assets/js/range-tanggal.js', 
			array(), 
			KONSEP_SEARCH_WC_VERSION, 
			true 
		);
		wp_enqueue_script('range_konsep_search');

		// Load CSS File
		wp_register_style( 
			'datepicker_konsep_search', 
			$this->plugin_url() . '/assets/datepicker/css/datepicker.css', 
			array(), 
			KONSEP_SEARCH_WC_VERSION, 
			true 
		);
		wp_enqueue_style('datepicker_konsep_search');
		
	
	}	

}

function KONSEP_WC_Search(){
	return KONSEP_WC_booking_searching::instance();
}
KONSEP_WC_Search();