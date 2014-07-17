<?php
	/*
			The template for displaying Search Results pages
	*/
	
	get_header();
?>
	<div id="content">
		<h1 id="page-title">Search Results for: <?php echo get_search_query(); ?></h1>
		<?php 
			if (have_posts()) {
				$args = array('prev_text' => 'Previous Results',
											'next_text' => 'More Results');
				blunt_archive_nav('before', $args);
				while (have_posts()) {
					the_post();
					?>
						<div class="result">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
							<p><a href="<?php the_permalink(); ?>">Continue Reading</a></p>
						</div>
					<?php 
				} // end while have posts
				blunt_archive_nav('after', $args);
			} else {
				// no posts
				?>
					<p>No results were found.</p>
				<?php 
			}
		?>
	</div>
<?php	 
	get_footer();
?>
