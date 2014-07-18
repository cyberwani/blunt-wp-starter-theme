<?php
	/*
		The template for displaying all pages using default template
		can include different template for front or inner page
		see page-front.php and page-inner.php
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		if (is_front_page()) {
			get_template_part('page', 'front');
		} else {
			get_template_part('page', 'inner');
		}
		get_footer();
	}
	if (BLUNT_CACHE_FULL_PAGE) {
		do_action('blunt_cache_frag_output_save', $key);
	}
?>