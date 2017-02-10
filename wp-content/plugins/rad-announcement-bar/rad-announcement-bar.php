<?php 
/*
Plugin Name: Rad Announcement Bar
Description: A very simple plugin for learning
Author: Melissa Cabral
License: GPLv3
Version: 0.1 
*/

/**
 * HTML output of the bar
 */
add_action( 'wp_footer', 'rad_ab_html' );
function rad_ab_html(){
	$values  = get_option('rad_bar');
	?>
	<!-- Rad Announcement Bar by Melissa Cabral -->
	<div id="rad-bar">
		<p><?php echo $values['bartext'] ?>
			<a href="<?php echo $values['url'] ?>">Click Me!</a>
		</p>
	</div>
	<!-- End of Rad Announcement Bar by Melissa Cabral -->
	<?php

}

/**
 * Attach a stylesheet & JS
 */
add_action( 'wp_enqueue_scripts', 'rad_ab_style' );
function rad_ab_style(){
	//get the url of the stylesheet
	$url = plugins_url( 'css/rad-bar-style.css', __FILE__ );
	//tell WP about it and put it on the page
	wp_enqueue_style( 'rad-bar-style', $url );

	//attach jquery (built in to WP)
	wp_enqueue_script( 'jquery' );
	//attach our custom js
	$js = plugins_url( 'js/rad_ab.js', __FILE__ );
	wp_enqueue_script( 'rad-bar-script', $js, array('jquery') );
}

/**
 * Bonus Round! Options API
 * store the bar's settings in the database and 
 * make an admin panel page to control them
 */
add_action( 'admin_menu', 'rad_ab_admin_page' );
function rad_ab_admin_page(){
	// add a page under "settings"
	//  				$page_title, $menu_title, $capability, $menu_slug, $function
	add_options_page( 'Rad Announcement Bar Settings', 'Announcement Bar', 'manage_options', 'rad-announcement-bar', 'rad_ab_admin_content'  );
}

//callback function for the content of the admin page
function rad_ab_admin_content(){
	//include an external file for the content
	include( plugin_dir_path(__FILE__) ) . 'admin-form.php';
}

//"whitelist" the group of settings so WP will allow them in the DB
add_action( 'admin_init', 'rad_ab_setting' );
function rad_ab_setting(){
	// $option_group, $option_name, $sanitize_callback
	register_setting( 'rad_ab_group', 'rad_bar', 'rad_ab_cleaner' );
}

//callback func for sanitizing all fields
function rad_ab_cleaner($dirty){
	//KSES = Strips Evil Scripts
	$clean['bartext'] = wp_kses( $dirty['bartext'] );
	$clean['url'] = wp_kses( $dirty['url'] );

	return $clean;
}

//no close php