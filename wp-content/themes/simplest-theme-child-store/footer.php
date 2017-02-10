	<footer id="colophon">
		<?php dynamic_sidebar( 'footer-widgets' ); ?>
	</footer>
<?php wp_nav_menu(array(
	'theme_location' => 'mobile_menu',
	'container' => 'nav',
	'container_class' => 'mobile-menu',
	'fallback_cb' => '',
) ); ?>
<?php wp_footer();  //hook. necessary for plugins to work. ?>
</body>
</html>