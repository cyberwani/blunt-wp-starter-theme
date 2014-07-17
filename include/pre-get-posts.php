<?php 
	
	/* pre_get_posts is used to alter the main query before it is run
		 so that you only get the post you want to get rather than
		 doing a new query later and slowing down the site
		 I put in here in a separate file so it's easy for me to find
	*/
	
	function blunt_pre_get_posts($query=false) {
		// standard ssi pre get posts function
		// used to alter main wp query
		// only used on main query on front end of site
		if (is_admin() || !$query || !is_a($query, 'WP_Query') ||
			isset($query->query_vars['bypass_pre_get_posts']) ||
			!is_main_query()) {
			return;
		}
		
		// some examples follow
		
		// modfiy a custom post type to show all
		if ($query->query_vars['post_type'] == 'my-custom-post-type-slug') {
			$query->set('posts_per_page', -1);
			$query->set('orderby', 'menu_order title');
			$query->set('order', 'ASC');
		}
		
		// modify a custom taxonomy query to show all
		if (is_tax() && isset($query->query['my-custom-taxonomy-slug'])) {
			$query->set('posts_per_page', -1);
			$query->set('orderby', 'menu_order title');
			$query->set('order', 'ASC');
		}
		
		// modify search to return 10 results and include page and product post types
		if (is_search()) {
			$query->set('posts_per_page', 10);
			$query->set('post_type', array('post', 'page', 'product'));
		}
	} // end function blunt_pre_get_posts
	add_action('pre_get_posts', 'blunt_pre_get_posts', 0);
	
?>