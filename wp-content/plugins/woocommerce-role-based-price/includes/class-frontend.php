<?php
/**
 * Dependency Checker
 *
 * Checks if required Dependency plugin is enabled
 *
 * @link https://wordpress.org/plugins/woocommerce-role-based-price/
 * @package WooCommerce Role Based Price
 * @subpackage WooCommerce Role Based Price/FrontEnd
 * @since 3.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Role_Based_Price_Functions {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_filter( 'woocommerce_product_object',array($this,'setup_product_prices'));
        add_action( 'wp_enqueue_scripts', array($this,'enqueue_styles') );
        add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts') );
    }
	
	public function setup_product_prices($product){
        if($product == null){return $product;}
		$product->wc_rbp = wc_rbp_get_product_price($product->ID);
		$product->wc_rbp_status = wc_rbp_product_status($product->ID); 
        
		do_action_ref_array('wc_rbp_product_class_attribute',array(&$product));
		return $product;
	}
    
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() { 
		wp_enqueue_style(WC_RBP_NAME.'frontend_style', WC_RBP_CSS. 'frontend.css', array(), WC_RBP_V, 'all' );
	}
    
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() { 
		wp_enqueue_script(WC_RBP_NAME.'frontend_script', WC_RBP_JS.'frontend.js', array( 'jquery' ), WC_RBP_V, false );
	}

}