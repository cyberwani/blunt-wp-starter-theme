<?php
	/*
			The template for showing a single post from a custom post type
			copy this file and replace "CUSTOM-POST-TYPE" with your custom post type slug
	*/
	
	get_header();
	
	while (have_posts()) {
		the_post();
		?>
			<div id="sidebar-before-content">
				[Sidebar Before Content]
			</div>
			<div id="content">
				<?php 
					// include content from home page if it exists
					?><h1 id="page-title"><?php the_title(); ?></h1><?php 
					the_content();
				?>
			</div>
			<div id="sidebar-after-content">
				[Sidebar After Content]
			</div>
		<?php 
	} // end while have posts	
	
	get_footer();
?>