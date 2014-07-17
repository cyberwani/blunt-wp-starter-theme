<?php
	/*
			The template for showing a single post from a custom post type
			copy this file and replace "CUSTOM-POST-TYPE" with your custom post type slug
			
			This template also includes the basic schema.org markup for "Product"
	*/
	
	get_header();
	
	while (have_posts()) {
		the_post();
		?>
			<div id="sidebar-before-content">
				[Sidebar Before Content]
			</div>
			<div id="content" itemscope itemtype="http://schema.org/Product">
				<h1 id="page-title" itemprop="name"><?php the_title(); ?></h1>
				<div class="content-body" itemprop="description">
					<?php 
						the_content();
					?>
				</div>
			</div>
			<div id="sidebar-after-content">
				[Sidebar After Content]
			</div>
		<?php 
	} // end while have posts	
	
	get_footer();
?>