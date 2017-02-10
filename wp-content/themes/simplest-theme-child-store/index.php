<?php get_header(); //require header.php ?>

	<main id="content">
		
		<?php 
		//make sure there are some posts to display
		if( have_posts() ):
			//loop through each post
			while( have_posts() ):
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"> <a href="<?php the_permalink(); ?>"> 
				<?php the_title(); ?> </a></h2>			

			<div class="entry-content">
				<?php the_post_thumbnail() ?>
				<?php the_content(); ?>
				<?php wp_link_pages(  ); ?>
			</div>

			<div class="postmeta"> 
				<span class="author"> Posted by: <?php the_author(); ?> </span>
				<span class="date"> <?php the_date(); ?> </span>
				<span class="num-comments"> <?php comments_number(); ?> </span>
				<span class="categories"> <?php the_category(); ?> </span>
				<span class="tags"><?php the_tags(); ?></span> 
			</div><!-- end postmeta -->
		</article>

		 <?php comments_template(); ?>

		<?php endwhile; //have posts ?>
		<section class="pagination">
			<?php next_posts_link();
			 previous_posts_link();  ?>
		</section>

	<?php endif; //have posts ?>

	</main><!-- end #content -->

<?php get_sidebar(); //require sidebar.php ?>	

<?php get_footer(); //require footer.php ?>