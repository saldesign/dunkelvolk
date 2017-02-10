<aside id="sidebar">
	<?php if( ! dynamic_sidebar( 'sidebar' ) ): ?> 
	<section id="categories" class="widget">
		<h2 class="widget-title"> Categories </h2>
		<ul>
			<?php wp_list_categories( array(
				'orderby' => 'count',
				'order' => 'desc',
				'title_li' => '',
				'number' => 10,
				'show_count' => 1,
			) ); ?>               
		</ul>
	</section>
	<section id="archives" class="widget">
		<h2 class="widget-title"> Archives </h2>
		<ul>
			<?php wp_get_archives( array(
				'type' => 'yearly',
			) ); ?>
		</ul>
	</section>
	<section id="tags" class="widget">
		<h2 class="widget-title"> Tags </h2>
		<ul>
			<?php wp_list_categories( array(
				'taxonomy' => 'post_tag',
				'orderby' => 'count',
				'order' => 'desc',
				'title_li' => '',
				'number' => 10,
				'show_count' => 1,
			) ); ?>
		</ul>
	</section>
	<section id="meta" class="widget">
		<h2 class="widget-title"> Meta </h2>
		<ul>
			<?php wp_register(); //show admin link if logged in ?>
			<li><?php wp_loginout(); ?></li>
		</ul>
	</section>
	<?php endif; ?>
</aside><!-- end #sidebar -->