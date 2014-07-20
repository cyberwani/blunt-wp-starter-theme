<?php
	/*
		The Header template for our theme
	*/
?><!DOCTYPE html>
	<!--[if IE 7]>
		<html class="ie ie7" <?php language_attributes(); ?>>
	<![endif]-->
	<!--[if IE 8]>
		<html class="ie ie8" <?php language_attributes(); ?>>
	<![endif]-->
	<!--[if !(IE 7) | !(IE 8)	]><!-->
		<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title(); ?></title>
		<?php 
			include (dirname(__FILE__).'/include/before-wp-head.php');
			wp_head();
			include (dirname(__FILE__).'/include/after-wp-head.php');
		?>
	</head>
	<body <?php body_class(); ?>>
		<?php include (dirname(__FILE__).'/include/after-body.php'); ?>
		<div id="main" class="wrapper">
			<div id="site-header">
				<div id="logo"><a href="/"><?php bloginfo('name'); ?></a></div>
				<div id="top-nav">
					<?php 
						$args = array('theme_location' => 'top-menu',
													'container' => false,
													'menu_class' => 'top-menu',
													'echo' => true,
													'fallback_cb' => false,
													'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
													'depth' => -1);
						wp_nav_menu($args);
					?>
				</div>
				<div id="site-search">
					<?php get_search_form(); ?> 
				</div>
				<div id="site-phone">
					<a href="tel:+18005551212">(800) 555-1212</a>
				</div>
			</div>
			<div id="main-nav">
				<?php 
					$args = array('theme_location' => 'main-menu',
												'container' => false,
												'menu_class' => 'main-menu',
												'echo' => true,
												'fallback_cb' => 'wp_page_menu',
												'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
												'depth' => 0);
					wp_nav_menu($args);
				?>
			</div>
			<div id="body">