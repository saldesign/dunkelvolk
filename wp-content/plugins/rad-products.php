<?php 
/*
Plugin Name: Rad Products
Description: Adds a custom post type for our product catalog
Author: Melissa Cabral
License: GPLv3
Version:0.1
Plugin URI: 
Author URI: http://melissacabral.com
*/

add_action( 'init', 'rad_products_cpt' );
function rad_products_cpt(){
	register_post_type( 'product', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'label' 		=> 'Products',
		'menu_icon'		=> 'dashicons-cart',
		'menu_position'	=> 5,
		'supports'		=> array('title', 'editor', 'excerpt', 'thumbnail', 
								'custom-fields', 'revisions'),
		'rewrite'		=> array( 'slug' => 'shop' ), //change the url to /shop/
		//These labels are for the Admin panel UI
		'labels' 		=> array(
 			'name' 			=> 'Products',
 			'singular_name' => 'Product',
 			'add_new_item' 	=> 'Add New Product',
 			'not_found'		=> 'No Products Found',
		),
	) );

	register_taxonomy( 'brand', 'product', array(
		'hierarchical' 		=> true,  //behave like categories - checkbox interface
		'show_admin_column' => true,
		'label'				=> 'Brands',  //human-friendly admin nav label
		'labels' 			=> array(
			'add_new_item' 		=> 'Add New Brand',
			'search_items'		=> 'Search Brands',
			'not_found' 		=> 'No Brands Found',
		),

	) );

	//non-hierarchical taxo, like tags
	register_taxonomy( 'feature', 'product', array(
 		'show_admin_column' => true,
		'label'				=> 'Features',  //human-friendly admin nav label
		'labels' 			=> array(
			'add_new_item' 		=> 'Add New Feature',
			'search_items'		=> 'Search Features',
			'not_found' 		=> 'No Features Found',
			'popular_items'		=> 'Popular Features',
			'edit_item'			=> 'Edit Feature',
		),
	) );
}


/**
 * Automatically flush the permalinks when this plugin is activated
 */
register_activation_hook( __FILE__ , 'rad_products_flush' );
function rad_products_flush(){
	rad_products_cpt();
	flush_rewrite_rules();
}