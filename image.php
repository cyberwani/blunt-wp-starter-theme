<?php
	/**
		* The template for displaying Images.
		
		For SEO reasons Attachments should not be shown, instead we redirect to either the
		attachment parent or the home page
		
		this template may not be used as the plugin WP SEO can allow you to set this redirect
		
	*/
	
	// redirect to parent or home page
	global $post;
	header ('HTTP/1.1 301 Moved Permanently');
	if ($post->post_parent) {
		header ('Location: '.get_permalink($post->post_parent));
	} else {
		header ('Location: http://'.$_SERVER['HTTP_HOST'].'/');
	}
	exit;

?>