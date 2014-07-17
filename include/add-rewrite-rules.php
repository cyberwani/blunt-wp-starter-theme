<?php 
	
	/* 
		
		this file gives some examples of rewrite rules and how to add them
		
		see:
			http://codex.wordpress.org/Rewrite_API/add_rewrite_tag
			http://codex.wordpress.org/Rewrite_API/add_rewrite_rule
		
	*/
	
	function blunt_add_rewrite_rules() {
		// the rules in this function are examples
		// if you want to use this function you need to remove the comment on the
		// add_action call below
		
		add_rewrite_tag('%resource-type%', '([.]+)');
		$postition = 'top';
		
		$rule = 'ams-resource/(document|whitepaper|video|software)/?';
		$rewrite = 'index.php?post_type=ams-resource&resource-type=$matches[1]';
		add_rewrite_rule($rule, $rewrite, $position);
		
		$rule = 'ams-resource/(document|whitepaper|video|software)/page/([0-9]{1,})/?';
		$rewrite = 'index.php?post_type=ams-resource&resource-type=$matches[1]&paged=$matches[2]';
		add_rewrite_rule($rule, $rewrite, $position);
		
		$rule = 'ams-resource-category/([^/]+)/(document|whitepaper|video|software)/?';
		$rewrite = 'index.php?ams-resource-category=$matches[1]&resource-type=$matches[2]';
		add_rewrite_rule($rule, $rewrite, $position);
		
		$rule = 'ams-resource-category/([^/]+)/(document|whitepaper|video|software)/page/?([0-9]{1,})/?$';
		$rewrite = 'index.php?ams-resource-category=$matches[1]&resource-type=$matches[2]&paged=$matches[3]';
		add_rewrite_rule($rule, $rewrite, $position);
		
	} // end function ams_rewrite_rules
	//add_action('init', 'blunt_add_rewrite_rules');
	
	/*
			using rewrite rules in pre_get_posts
			you would add your values to your pre_get_posts filter
			of course you also need to write functions and code that output the URLs in the first place
			
			$resource_type = get_query_var('resource-type');	
			if ($resource_type) {
				$meta_query = array(array('key' => '_resource_type',
																	'value' => $resource_type));
				$query->set('meta_query', $meta_query);
			}
		
	*/
	
?>
