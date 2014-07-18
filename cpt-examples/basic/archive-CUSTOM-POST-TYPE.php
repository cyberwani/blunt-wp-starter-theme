<?php
	/*
			The template for showing a custom post type archive
			copy this file and replace "CUSTOM-POST-TYPE" with your custom post type slug
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		?>
			<div id="sidebar-before-content">
				[Sidebar Before Content]
			</div>
			<div id="content">
				<h1 id="page-title">CUSTOM POST TYPE ARCHIVE PAGE HEADING</h1>
				<?php 
					if (have_posts()) {
						blunt_archive_nav('before');
						?>
							<div class="articles">
								<?php 
									while (have_posts()) {
										the_post();
										?>
											<div class="article">
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												<p><?php the_excerpt(); ?></p>
												<p><a href="<?php the_permalink(); ?>">Continue Reading</a></p>
											</div>
										<?php 
									} // end while have posts
								?>
							</div>
						<?php 
						blunt_archive_nav('before');
					} else {
						// no posts
						?>
							<p>No results were found.</p>
						<?php 
					}
				?>
			</div>
			<div id="sidebar-after-content">
				[Sidebar After Content]
			</div>
		<?php	
		get_footer();
	}
	if (BLUNT_CACHE_FULL_PAGE) {
		do_action('blunt_cache_frag_output_save', $key);
	}
?>