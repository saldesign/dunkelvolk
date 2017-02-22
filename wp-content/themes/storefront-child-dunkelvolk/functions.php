<?php



//Cant remember :( 

if ( ! function_exists( 'storefront_primary_navigation_wrapper' ) ) {
	/**
	 * The primary navigation wrapper
	 */
	function storefront_primary_navigation_wrapper() {
		echo '<div class="storefront-primary-navigation"><span>';
	}
}


//Add Slider
add_action( 'woocommerce_before_main_content', 'add_slider', 5 );
function add_slider() {
	if ( is_product_category( 'ropa' ) ){
		echo do_shortcode("[metaslider id=52]"); 
	} elseif ( is_product_category( 'accesorios' )){
		echo do_shortcode("[metaslider id=199]"); 
	} elseif ( is_product_category( 'calzado' )){
		echo do_shortcode("[metaslider id=200]"); 
	}else{
		//do nothing
	}
}
add_action( 'homepage', 'add_front_slider' );
function add_front_slider() {
	if  ( is_front_page()){
		echo do_shortcode("[metaslider id=201]"); 
	}else{
		//do nothing
	}
}






function remove_sf_actions() {
// Move Product Search between primary and secondary navigation
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
	add_action( 'storefront_header', 'storefront_product_search', 55 );

// Move Home Content under products
	remove_action( 'homepage', 'storefront_homepage_content', 10 );
	add_action( 'homepage', 'storefront_homepage_content', 90 );

// Move secondary nav below main content
	remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
	add_action( 'storefront_footer', 'storefront_secondary_navigation', 6 );

// Move sub category links up

	function run_woocommerce_product_subcategories() {
		?><section class="storefront-product-section storefront-product-categories" aria-label="Product Categories"><ul class="products"><?php woocommerce_product_subcategories();?>
</ul></section><?php
	}
	add_action('woocommerce_before_main_content', 'run_woocommerce_product_subcategories', 9  );

// Move sale badge below price
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 11 );


// Remove Storefront Defaults
	remove_action( 'storefront_footer', 'storefront_credit', 20 );
	remove_action( 'homepage', 'storefront_popular_products', 50 );
	remove_action( 'homepage', 'storefront_featured_products', 40 );
	remove_action( 'after_setup_theme','custom_header_setup');

// Move category description and title up
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	add_action( 'woocommerce_before_main_content', 'add_cat_title', 7);
	function add_cat_title() {
		if ( is_product_category() ){
			?><section class="hentry"><h1 class="page-title"><?php woocommerce_page_title(); ?></h1><?php	
		}
	}
	add_action( 'woocommerce_before_main_content', 'add_woocommerce_taxonomy_archive_description', 8 );
	function add_woocommerce_taxonomy_archive_description(){
		if ( is_product_category() ){
			woocommerce_taxonomy_archive_description(); ?></section><?php
		}
	}


}add_action( 'init', 'remove_sf_actions' );


// Adding Wrapper for categories
if ( ! function_exists( 'storefront_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_product_categories( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_product_categories_args', array(
				'limit' 			=> 3,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				// 'title'				=> __( 'Shop by Category', 'storefront' ),
			) );

			echo '<span class="category-container"><section class="storefront-product-section storefront-product-categories" aria-label="Product Categories">';

			do_action( 'storefront_homepage_before_product_categories' );

			do_action( 'storefront_homepage_after_product_categories_title' );

			echo storefront_do_shortcode( 'product_categories', array(
				'number'  => intval( $args['limit'] ),
				'columns' => intval( $args['columns'] ),
				'orderby' => esc_attr( $args['orderby'] ),
				'parent'  => esc_attr( $args['child_categories'] ),
			) );

			do_action( 'storefront_homepage_after_product_categories' );

			echo '</section></span>';
		}
	}
}

// Remove product count within categories
add_filter( 'woocommerce_subcategory_count_html', 'jk_hide_category_count' );
function jk_hide_category_count() {
	// No count
}
// Remove All Nav Generated h1s
if ( ! function_exists( 'storefront_page_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function storefront_page_header() {
		?>
		<header class="entry-header">
			<?php
			storefront_post_thumbnail( 'full' );
			?>
		</header><!-- .entry-header -->
		<?php
	}
}


if ( ! function_exists( 'storefront_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function storefront_product_search() {
		if ( storefront_is_woocommerce_activated() ) { ?>
			<span class="search-button"></span>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}


//Moving Branding into navigation
if ( ! function_exists( 'storefront_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_site_branding() {
	}
}
if ( ! function_exists( 'storefront_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
		<div class="site-branding">
			<?php storefront_site_title_or_logo(); ?>
		</div>
		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
					)
			);

			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
					)
			);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}




// Add a custom user role

$result = add_role( 'client', __('Client' ),
	array(
		'edit_themes' => false, // false denies this capability. User can’t edit your theme
	)
);











add_action('wp_enqueue_scripts', 'attach_scripts', PHP_INT_MAX);
function attach_scripts(){
	//attach script.js
	$js_url =  get_stylesheet_directory_uri().'/js/script.js';
	wp_enqueue_script('main_js', $js_url, array('jquery'));

	//attach parent theme stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	//attach beetroot.css
	$icons_url = get_stylesheet_directory_uri().'/style/dunkelvolk.css';
	wp_enqueue_style('icons', $icons_url );
	
	//attach style.css
	$style_url = get_stylesheet_uri();
	wp_enqueue_style('main_style', $style_url );
}
//No Close PHP!