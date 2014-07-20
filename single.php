<?php
	/*
		The template for showing single Blog post
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		// cache the header for this page
		$head_key = 'HEADER'.$_SERVER['REQUEST_URI'];
		if (!apply_filters('blunt_cache_frag_check', false, $head_key)) {
			get_header();
		}
		do_action('blunt_cache_frag_output_save', $head_key);
		while (have_posts()) {
			the_post();
			?>
				<div id="content" itemscope itemtype="http://schema.org/Blog">
					<div itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<?php 
							$content_key = 'HEADER'.$_SERVER['REQUEST_URI'];
							if (!apply_filters('blunt_cache_frag_check', false, $content_key)) {
								blunt_post_nav('before');
								?>
                	<h1 id="page-title" class="single-item-title" itemprop="name"><?php the_title(); ?></h1>
									<div itemprop="text"><?php the_content(); ?></div>
                <?php
								blunt_post_meta();
								blunt_post_nav('after');
							} // end cache check
							do_action('blunt_cache_frag_output_save', $content_key);
							comments_template();
						?>
					</div>
				</div>
			<?php 
		} // end while have posts
		// cache the sitebar and footer
		$foot_key = 'HEADER'.$_SERVER['REQUEST_URI'];
		if (!apply_filters('blunt_cache_frag_check', false, $foot_key)) {
			?>
        <div id="sidebar-after-content">
          <?php get_sidebar('blog'); ?>
        </div>
      <?php 
			get_footer();
		} // end cache check
		do_action('blunt_cache_frag_output_save', $foot_key);
	} // end while have_posts
	if (BLUNT_CACHE_FULL_PAGE) {
		do_action('blunt_cache_frag_output_save', $key);
	}
?>