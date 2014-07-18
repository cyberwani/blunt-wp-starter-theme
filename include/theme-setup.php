<?php 
	
	/* Theme Setup Functions */
	
	// function that sets up full page caching
	// using Blunt Cache
	// for this theme
	function blunt_cache_full_page_setup() {
		$full_page_cache = true; // set to false if you want to completely disable full page caching
		// turn full page caching of for specific templates
		// add the templates you want to turn off caching for 
		// to the array $do_not_cache_templates
		// do not include path or extension
		// example $do_not_cache_templates = array('page', 'tag', 'single');
		// for this to work you must set the value of $full_page_cache above to true
		$do_not_cache_templates = array();
		if ($full_page_cache) {
			global $template;
			$file = basename(strtolower($template), '.php'); // strtolower just a precaution
			if (in_array($file, $do_not_cache_templates)) {
				$full_page_cache = false;
			}
		} // end if full_page_cache
		define('BLUNT_CACHE_FULL_PAGE', $full_page_cache);
	} // end function blunt_cache_full_page_setup
	add_action('template_redirect', 'blunt_cache_full_page_setup');
	
	// when this is set to false, certain main items are hidden
	// see function blunt_remove_menus()
	define('BLUNT_DEV', false);
	
	// set your default content width here
	// 0 for no setting
	// see function blunt_content_width()
	// you should set some default content width
	define('BLUNT_CONTENT_WIDTH', 1000);
	
	// set up blunt-cache default ttl
	function set_blunt_cache_ttl($ttl) {
		// change the value to what you need, I like 6 hours
		$ttl = 60 * 60 * 6; // 6 hours
		return $ttl;
	}
	add_filter('blunt_cache_ttl', 'set_blunt_cache_ttl');
	
	// set jpeg image resize quality, the default WP quality is 90
	function blunt_jpeg_quality($arg) {
		return 80;
	}
	add_filter('jpeg_quality', 'blunt_jpeg_quality');
	
	function blunt_setup() {
		// standard setup theme function
		
		// set up theme support for post-thumnails and set size
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(500, 9999, false); // Unlimited height, soft crop
		
		// add custom image sizes as needed sizes
		// standard size names = thumb, thumbnail, medium, large, post-thumbnail, full 
		
		// you should not use full, people upload enormous image files
		// you cannot control what they upload but you can control what is displayed
		// you should set a maximum image size and use it instead of full
		add_image_size('max-width', 1024, 9999, false);
		
		// add menus as needed
		register_nav_menu('top-menu', 'Top Menu');
		register_nav_menu('main-menu', 'Main Menu');
		register_nav_menu('footer-menu', 'Footer Menu');
		
	} // end function blunt_setup
	add_action('after_setup_theme', 'blunt_setup');
	
	function blunt_widgets_init() {
		// register your widget areeas here
		register_sidebar(array('name' => 'Blog Sidebar',
													 'id' => 'blog-sidebar',
													 'description' => 'Appears on Blog Section Pages',
													 'before_widget' => '<div id="%1$s" class="widget %2$s">',
													 'after_widget' => '</div>',
													 'before_title' => '<h3 class="widget-title">',
													 'after_title' => '</h3>'));
	} // end function blunt_widgets_init
	add_action('widgets_init', 'blunt_widgets_init');
	
	function blunt_scripts_styles() {
		// enqueue script/styles here
		global $wp_styles;
		
		$css_path = get_template_directory_uri().'/css/';
		$js_path = get_template_directory_uri().'/js/';
		
		wp_enqueue_style('main-styles', get_stylesheet_uri());
		
		wp_enqueue_style('ie-css', $css_path.'ie.css', array('main-styles'));
		$wp_styles->add_data('ie-css', 'conditional', 'lt IE 9');
		
		// this enqueues the WP standard comment form script
		// if we're on a single, the only place comments should be appearing
		if (is_single() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	} // end function blunt_scripts_styles
	add_action('wp_enqueue_scripts', 'blunt_scripts_styles');
	
	function blunt_content_width() {
		// content width function
		// used to set different content widths based on template files
		// change as needed, example shown
		global $content_width;
		global $template;
		$width = BLUNT_CONTENT_WIDTH;
		$path = dirname(__FILE__).'/';
		$file = str_replace($path, '', $template);
		$file = str_replace('.php', '', $file);
		switch ($file) {
			case 'archive':
			case 'author':
			case 'category':
			case 'single':
			case 'tag':
				// so if we're loading a blog archive
				// set the width to something new
				//$content_width = 750;
				break;
			default:
				// do nothing
				break;
		} // end switch $file
		if ($width) {
			// width ! 0
			$content_width;
		}
	} // end blunt_content_width
	add_action('template_redirect', 'blunt_content_width');

	function blunt_remove_menus() {
		// add menus that you want to hide to the $restricted array
		if (BLUNT_DEV) {
			return;
		}
		global $menu;
		$restricted = array(__('CPT UI'), __('Custom Fields'), __('Options Pages'));
		foreach ($menu as $index => $array) {
			foreach ($restricted as $name) {
				if (substr($array[0], 0, strlen($name)) == $name) {
					unset($menu[$index]);
				}
			}
		}
	} // end function blunt_remove_menus
	add_action('admin_menu', 'blunt_remove_menus', 10000);
	
	function blunt_body_class($classes) {
		// a filter just in case you want to add classes to your body
		// with some examples, change it as you need to
		global $template;
		$path = dirname(__FILE__).'/';
		$file = str_replace($path, '', $template);
		$file = str_replace('.php', '', $file);
		$file = str_replace('/', '-', $file);
		if (in_array($file, array('archive',
															'author',
															'category',
															'index',
															'single',
															'tag'))) {
			if (!in_array('blog', $classes)) {
				$classes[] = 'blog';
			}
		}
		if ($file == 'page-templates-two-column') {
			$classes[] = 'page-two-column';
		}
		if ($file == '404') {
			$file = 'error'.$file;
		}
		if (is_front_page()) {
			if (!in_array('home', $classes)) {
				$classes[] = 'home';
			}
			$file .= '-home';
		} else {
			if (!in_array('inner', $classes)) {
				$classes[] = 'inner';
			}
			$file .= '-inner';
		}
		if (!in_array($file, $classes)) {
			$classes[] = $file;
		}
		if (preg_match('/product/', $file) && $file != 'product') {
			$classes[] = 'product';
		}
		return $classes;
	} // end function blunt_body_class
	add_filter('body_class','blunt_body_class', 99);
	
	// change the excerpt length
	// uncomment hook and change value to the word length you want
	function blunt_excerpt_length($length) {
		return 20;
	} // end function blunt_excerpt_length
	//add_filter('excerpt_length', 'blunt_excerpt_length', 999);
	
	// WP rsform loads my standandard form script that I'm currently using
	// it's not a plugin, checks for existance before loading
	// expects to find script folder in the root of the site
	function WPrsform() {
		if (is_dir(ABSPATH.'/rsform') && file_exists(ABSPATH.'/rsform/rsformWP.php')) {
			require(ABSPATH.'/rsform/rsformWP.php');
		}
	}
	add_action('init', 'WPrsform', 1);
	
?>