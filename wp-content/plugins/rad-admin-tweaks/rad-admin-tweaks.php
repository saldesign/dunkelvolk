<?php
/*
Plugin Name: Rad Admin Tweaks
Author: Melissa Cabral
Description:  Customize the admin panel and login screens
License: GPLv3
Version: 0.1
 */

/**
 * Attach a stylesheet to the login form
 */
add_action( 'login_enqueue_scripts', 'rad_admin_login' );
function rad_admin_login(){
	$url = plugins_url( 'login.css', __FILE__ );
	wp_enqueue_style( 'login-style', $url );
}

/**
 * Fixing the login logo so it links to the home page
 */
add_filter( 'login_headerurl', 'rad_admin_logo_link' );
function rad_admin_logo_link(){
	return home_url();
}

add_filter( 'login_headertitle', 'rad_admin_logo_title' );
function rad_admin_logo_title(){
	return 'Go back to the home page';
}

/**
 * Customize the Toolbar Nodes
 * @link https://codex.wordpress.org/Toolbar 
 */
add_action( 'admin_bar_menu', 'rad_admin_toolbar', 999);
function rad_admin_toolbar( $bar ){
	$bar->remove_node('wp-logo');  //remove nodes by ID
	// $bar->remove_node('comments'); 
	$bar->add_node( array(
		'id' 	=> 'contact-me',
		'title' => '<span class="ab-icon dashicons dashicons dashicons-email-alt"></span>Contact Melissa',
		'href'	=> 'http://wordpress.melissacabral.com',
		'parent' => 'top-secondary', //right side
	) );
}

/**
 * customize the dashboard
 */
add_action( 'wp_dashboard_setup', 'rad_admin_dashboard' );
function rad_admin_dashboard(){
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );

	wp_add_dashboard_widget( 'rad-help', 'Helpful Videos', 'rad_dashboard_widget' );
}
//callback function for the content of the dashboard widget
function rad_dashboard_widget(){
	echo '<iframe width="300" height="200" src="https://www.youtube.com/embed/videoseries?list=PLn4sZLd2puYgGiLz8xs2LZ5miUCODh-nn" frameborder="0" allowfullscreen></iframe>';
}

// remove welcome panel
remove_action( 'welcome_panel', 'wp_welcome_panel' );
