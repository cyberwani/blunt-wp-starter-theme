<?php
	/*
		Template Name: 3 Column Page Layout
		
		sidebars before and after content
		
		This is just an example custom template, remove it, alter it or copy it
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