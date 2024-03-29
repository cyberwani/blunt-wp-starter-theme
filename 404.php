<?php 
	/*
		The template for displaying 404 pages (Not Found).
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		?>
			<div id="primary" class="site-content">
				<div id="content" role="main">
					<h1 class="page-title"><?php __('This is somewhat embarrassing, isn\'t it?'); ?></h1>
					<p><?php __('It seems we can\'t find what you\'re looking for.'); ?></p>
				</div>
			</div>
		<?php 
		get_footer();
	}
	if (BLUNT_CACHE_FULL_PAGE) {
		do_action('blunt_cache_frag_output_save', $key);
	}
?>