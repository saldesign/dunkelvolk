<?php
/*
Plugin Name: Rad Slider
Plugin URI: http://wordpress.melissacabral.com
Description: Adds a Slider based on Custom Post Types
Author: Melissa Cabral
Version: 1.0
License: GPLv2
Author URI: http://melissacabral.com
*/

/**
 * Register a Custom Post Type (Slide) 
 * Since ver. 1.0
 */
add_action('init', 'slide_init');
function slide_init() {
	$args = array(
		'labels' => array(
			'name' => 'Slides', 
			'singular_name' => 'Slide', 
			'add_new' => 'Add New', 'slide',
			'add_new_item' => 'Add New Slide',
			'edit_item' => 'Edit Slide',
			'new_item' => 'New Slide',
			'view_item' => 'View Slide',
			'search_items' => 'Search Slides',
			'not_found' => 'No slides found',
			'not_found_in_trash' => 'No slides found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => 'Slides'
		),
		'public' => true,
		'exclude_from_search' => true,
		'show_in_menu' => true, 
		'rewrite' => true,
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title', 'editor', 'thumbnail')
	); 
	register_post_type('slide', $args);
}

/**
 * Put  little help box at the top of the editor 
 * Since ver 1.0
 */
add_action('contextual_help', 'slide_help_text', 10, 3);
function slide_help_text($contextual_help, $screen_id, $screen) {
	if ('slide' == $screen->id) {
		$contextual_help ='<p>Things to remember when adding a slide:</p>
		<ul>
		<li>Give the slide a title. The title will be used as the slide\'s headline</li>
		<li>Attach a Featured Image to give the slide its background</li>
		<li>Enter text into the Visual or HTML area. The text will appear within each slide during transitions</li>
		</ul>';
	}
	elseif ('edit-slide' == $screen->id) {
		$contextual_help = '<p>A list of all slides appears below. To edit a slide, click on the slide\'s title</p>';
	}
	return $contextual_help;
}


/**
 * This prevents 404 errors when viewing our custom post archives
 * always do this whenever introducing a new post type or taxonomy
 * Since ver 1.0
 */
function rad_slider_rewrite_flush(){
	slide_init();
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'rad_slider_rewrite_flush');

/**
* Add the image size for the slider 
* Since ver 1.0
*/
function rad_slider_image(){
	add_image_size( 'rad-slider', 1120, 330, true );	
}
add_action('init', 'rad_slider_image');

/**
 * Add the featured image column to the admin panel
 */
add_filter('manage_posts_columns', 'rad_slider_column');
function rad_slider_column($defaults){
	//add our column onto the existing defaults
	$defaults['rad_thumbnail'] = 'Thumbnail';
	return $defaults;
}

//content for the table cell
add_action('manage_posts_custom_column', 'rad_slider_column_content', 0, 2);
function rad_slider_column_content($column_name, $id){
	if($column_name == 'rad_thumbnail'){
		the_post_thumbnail( 'thumbnail' );
	}
}

/**
 * HTML output for the slideshow
 */
function rad_slider(){
	//get up to 5 slides
	$slides = new WP_Query(array(
		'post_type' 		=> 'slide', //registered post type from above
		'posts_per_page' 	=> 5,
	));
	if( $slides->have_posts() ){
	?>
	<div id="rad-slider">
		<ul class="slideshow">

		<?php 
		while($slides->have_posts()){
				$slides->the_post();
		 ?>
		<li>
			<?php the_post_thumbnail( 'rad-slider' ); ?>
			<div class="slide-text">
				<h2><?php the_title(); ?></h2>
				<p><?php the_excerpt(); ?></p>
			</div>
		</li>
		<?php } //end while ?>
	</ul>
	</div>
	<?php
	} //end if
	wp_reset_postdata();
}

/**
 * Attach Styles and Javascript
 */
add_action( 'wp_enqueue_scripts', 'rad_slider_scripts' );
function rad_slider_scripts(){
	//attach the CSS
	$css = plugins_url( 'css/style.css', __FILE__ );
	wp_enqueue_style( 'rad_slider_style', $css );

	//attach jQuery
	wp_enqueue_script( 'jquery');

	//attach responsiveslides plugin
	$rs = plugins_url( 'js/responsiveslides.js', __FILE__ );
						//handle 			url   dependencies 	ver     footer?
	wp_enqueue_script( 'responsiveslides', $rs, array('jquery'), '1.54', true );
	//attach custom js
	$custom = plugins_url( 'js/custom.js', __FILE__ );
	wp_enqueue_script( 'slider_custom', $custom, array('responsiveslides'), '0.1', true );
}