<?php 
	
	/*
			This file contains my standard additions to wp-config.php
	*/
	
	define('WP_AUTO_UPDATE_CORE', false);
	define('DISALLOW_FILE_MODS', true);
	
	define('WP_DEBUG', false);
	define('WP_DEBUG_DISPLAY', false);
	
	define('AUTOSAVE_INTERVAL', 86400); // 24 hours, efectively turns off autosave
	
	// dynamically set domain name to the currenly requested host
	define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
	define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
	define('WP_CONTENT_URL', '/wp-content');
	define('DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST']);
	
?>