<?php 
	
	/* 
		
		this file contains functions that add columns to admin pages
		some examples are given
		I like to keep them all together in one file
		If you're creating custom columns for a custom post type you should
		create a plugin to do it so they remain even if the theme changes
		but it's easier to add them in functions.php when your in a hurry
		at least if you put them all in one file you can find them when you decide
		to move them to a plugin or the next developer can see what you added
		
		you'll notice that I like to add my columns after the title 
		and sometimes remove the post date, these are just examples so modify as needed
		you'll also need to remove the comments from the hook calls
		
	*/
	
	// the next 2 functions add columns and column content to the page admin page
	// add columns to Pages admin
	function blunt_page_columns($columns) {
		$new_columns = array();
		foreach ($columns as $index => $column) {
			if (strtolower($column) == __('title')) {
				$new_columns[$index] = $column;
				// add new columns after the title here
				// array key is the name for your field and value is the actual label for the column
				//$new_columns['label'] = __('New Column Heading');
			} else {
				if ($column != __('Date')) {
					// this removes the date column
					$new_columns[$index] = $column;
				}
			}
		}
		return $new_columns;
	} // end function blunt_page_columns
	//add_filter('manage_edit-page_columns', 'blunt_page_columns');
	
	// add content to Page admin columns
	function blunt_page_columns_content($columnName, $columnID) {
		global $post;
		switch ($columnName) {
			case 'label':
				echo get_post_meta($post->ID, '_csi_page_label', true);
				break;
		}
	} // end function blunt_page_columns_content
	//add_action('manage_page_posts_custom_column', 'blunt_page_columns_content', 10, 2 );
	
	// the next 2 functions can add columsn and content to the media admin page
	// add columns to media admin
	function blunt_media_columns($columns) {
		// this is an example, it adds the ID column and shows the media post id
		$new_columns = array();
		foreach ($columns as $index => $column) {
			if (strtolower($column) == __('file')) {
				$new_columns['colID'] = __('ID');
			}
			$new_columns[$index] = $column;
		}
		$columns['colID'] = __('ID');
		return $new_columns;
	} // end function blunt_media_columns
	//add_filter('manage_media_columns', 'blunt_media_columns');
	
	// add content to Media admin columns
	function blunt_media_columns_content($columnName, $columnID) {
		if($columnName == 'colID'){
			echo $columnID;
		}
	} // end function blunt_media_columns_content
	//add_action('manage_media_custom_column', 'blunt_media_columns_content', 10, 2 );
	
	// these next to functions can be used to add columns and content to Post admin page
	// add columns to Posts admin
	function blunt_posts_columns($columns) {
		// this example function adds the post id to the post
		$new_columns = array();
		foreach ($columns as $index => $column) {
			if (strtolower($column) == __('file')) {
				$new_columns['colID'] = __('ID');
			}
			$new_columns[$index] = $column;
		}
		$columns['colID'] = __('ID');
		return $new_columns;
	} // end function blunt_posts_columns
	//add_filter('manage_posts_columns', 'blunt_posts_columns');
	
	// add contnet to Posts admin columns
	function blunt_posts_columns_content($columnName, $columnID) {
		if($columnName == 'colID'){
			echo $columnID;
		}
	} // end function blunt_posts_columns_content
	//add_action('manage_posts_custom_column', 'blunt_posts_columns_content');
	
	// the next 2 functions can be used to add columns 
	// and column content to a custom post admin page
	// the example functions given add several custom field columns, inlcuding an image
	// replace {CUSTOM-POST-TYPE-SLUG} with your custom post type slug
	// replace CUSTOM_POST_TYPE in the function name with your custom post type
	// add columns to a custom post type
	function blunt_CUSTOM_POST_TYPE_columns($columns) {
		$new_columns = array();
		foreach ($columns as $index => $column) {
			if (strtolower($column) == __('title')) {
				$new_columns[$index] = $column;
				$new_columns['location'] = __('Location');
				$new_columns['url'] = __('URL');
				$new_columns['text'] = __('Text');
				$new_columns['image'] = __('Image');
				$new_columns['order'] = __('Order');
			} else {
				$new_columns[$index] = $column;
			}
		}
		return $new_columns;
	} // end function blunt_CUSTOM_POST_TYPE_columns
	//add_filter('manage_edit-{CUSTOM-POST-TYPE}_columns', 'blunt_CUSTOM_POST_TYPE_columns');
	
	function blunt_CUSTOM_POST_TYPE_columns_content($columnName, $columnID) {
		global $post;
		switch ($columnName) {
			case 'location':
				echo get_post_meta($post->ID, '_custom_location', true);
				break;
			case 'url':
				echo get_post_meta($post->ID, '_custom_url', true);
				break;
			case 'text':
				echo get_post_meta($post->ID, '_custom_text', true);
				break;
			case 'image':
				$attachment_id = get_post_meta($post->ID, '_custom_image', true);
				if ($attachment_id) {
					$image = wp_get_attachment_image_src($attachment_id, 'thumbnail');
					if ($image) {
						?>
							<img src="<?php 
								echo $image[0]; ?>" width="<?php 
								echo $image[1]; ?>" height="<?php 
								echo $image[2]; ?>" />
						<?php 
					}
				}
				break;
			case 'order':
				echo '<strong style="font-size: 1.2em;">',$post->menu_order,'</strong>';
				break;
		}
	} // end blunt_CUSTOM_POST_TYPE_columns_content
	//add_action('manage_action-button_posts_custom_column', 'blunt_CUSTOM_POST_TYPE_columns_content', 10, 2 );
	
?>