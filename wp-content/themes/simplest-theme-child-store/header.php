<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="A description about your site" />
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen" />

<!--[if IE]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php wp_head(); //hook. necessary for plugin css and js to work. ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
		<h2><?php bloginfo('description'); ?></h2>

		<?php get_search_form() ?>
		
		<?php wp_nav_menu( array(
			'theme_location' => 'utilities',				
			'container' => false,				
			'fallback_cb' => '',				
		)); ?>

		<?php wp_nav_menu( array(
			'theme_location' => 'main_menu',				
			'container' => 'nav',				
			'fallback_cb' => '',				
		)); ?>
	</header>