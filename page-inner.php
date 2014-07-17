<?php 
	// home/front page template
	// can't use home.php or page.php isn't loaded
	// this shows an example of a 3 column page
	
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
?>