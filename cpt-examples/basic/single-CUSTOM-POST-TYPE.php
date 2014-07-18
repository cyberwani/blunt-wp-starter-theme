<?php
	/*
			The template for showing a single post from a custom post type
			copy this file and replace "CUSTOM-POST-TYPE" with your custom post type slug
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		while (have_posts()) {
			the_post();
			?>
				<div id="sidebar-before-content">
					[Sidebar Before Content]
				</div>
				<div id="content">
					<h1 id="page-title"><?php the_title(); ?></h1>
					<?php 
						the_content();
					?>
				</div>
				<div id="sidebar-after-content">
					[Sidebar After Content]
				</div>
			<?php 
		}
		get_footer();
	}
	if (BLUNT_CACHE_FULL_PAGE) {
		do_action('blunt_cache_frag_output_save', $key);
	}
?>