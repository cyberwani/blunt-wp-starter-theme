<?php 
	
	/* 
		
		this file contains functions I find useful
		use them or not
		
	*/
	
	// the function blunt_get_terms will return terms that are not empty
	// or have child terms that are not empty
	// get terms with hide_empty set to true and hierarchical set to true is supposed
	// to do this, but i've never gotten it to work, this bug has been known and uncorrected 
	// for a very long time. Since they don't seem in a hurry to fix it we have this function
	// sometimes I really hate WP, anyway, the function follows, please follow the rules here
	// this function is called just like get_terms, howeveryour if you set hide_empty to false 
	// then this simply calls get_terms and returns the unaltered results.
	// This function serves only one purpose:
	//		 to get a list of terms that are not empty or have any non-empty descendants
	//		 this will only work if 'fields' is not set to count fields must be all
	//					i can only do so much
	function blunt_get_terms($taxonomies, $args) {
		// this is a recursive function
		$default_args = array('orderby'			 => 'name', 
													'order'				 => 'ASC',
													'hide_empty'		=> true, 
													'exclude'			 => array(), 
													'exclude_tree'	=> array(), 
													'include'			 => array(),
													'number'				=> '', 
													'fields'				=> 'all', 
													'slug'					=> '', 
													'parent'				=> '',
													'hierarchical'	=> true, 
													'child_of'			=> 0, 
													'get'					 => '', 
													'name__like'		=> '',
													'pad_counts'		=> false, 
													'offset'				=> '', 
													'search'				=> '', 
													'cache_domain'	=> 'core');
		$args = array_merge($default_args, $args);
		if (!$args['hide_empty'] == false || $args['fields'] != 'all') {
			return get_terms($taxonomies, $args);
		}
		$args['hide_empty'] = false;
		$terms = get_terms($taxonomies, $args);
		if (!count($terms) || is_wp_error($terms)) {
			return $terms;
		}
		// this is where we do the checking to see if the term
		// or any of its decendants has any posts
		// first reset all args to defaults
		$args = $default_args;
		$term_count = count($terms);
		for ($index=0; $index<$term_count; $index++) {
			// check to see if there are any posts in the term
			// if not get children of this term and check it
			// if empty unset the index
			$taxonomy = $term->taxonomy;
			$term_id = $term->term_id;
			$count_args = array('hide_empty'		=> true, 
													'include'			 => array($term_id),
													'fields'				=> 'count'); 
			$term_count = intval(get_terms(array($taxonomy), $args));
			if (!$term_count) {
				// empty term, check children of this term
				$args['parent'] = $term->parent;
				$taxonomies = array($taxonomy);
				$children = blunt_get_terms($taxonomies, $args);
				if (!count($children)) {
					unset($terms[$index]);
				}
			}
		} // end foreach term
		if (count($terms)) {
			$terms = array_values($terms);
		}
		return $terms;
	} // end function blunt_get_terms
	
	function blunt_sort_object($a, $b) {
		// custom sort function to sort by a custom field
		// this function expects that items to be sorted are objects and
		// that the element to sort by is $object->sort_order
		// usage: usort($object, blunt_sort_object)
		// there is a bug in WP query, you can either sort by a meta field or
		// select by a meta field but if you try to do both the entire query is broken
		if ($a->sort_order == $b->sort_order) {
			return 0;
		} elseif ($a->sort_order < $b->sort_order) {
			return -1;
		} else {
			return 1;
		}
	} // end function blunt_sort_object
	
	function blunt_sort_array($a, $b) {
		// custom sort function to sort by a custom field
		// this function expects that items to be sorted are arrays and
		// that the element to sort by is $object['sort_order']
		// usage: usort($array, blunt_sort_array)
		// there is a bug in WP query, you can either sort by a meta field or
		// select by a meta field but if you try to do both the entire query is broken
		if ($a['sort_order'] == $b['sort_order']) {
			return 0;
		} elseif ($a['sort_order'] < $b['sort_order']) {
			return -1;
		} else {
			return 1;
		}
	} // end function blunt_sort_array
	
?>