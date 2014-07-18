<?php
	/*
		The main template file
		
		*** A NOTE TO WOULD-BE THEME DEVELOPERS **
		
		it is a common practice for theme developers to use this file for the home 
		page of a site. In my opinion, this is a bad and incorrect practice. This 
		file is used for displaying the main "Blog" page. 
		see http://codex.wordpress.org/Template_Hierarchy. The only template that 
		can override this is if you add the theme file home.php. This is confusing 
		in itself since home.php won't show the site home page but the blog home 
		"Index" page instead, and there are also instances where other pages can 
		also use the home.php file. See my page.php template. The home page should 
		either use this template system or it should use a custom template that 
		can be selected in the admin, again, in my opinion. This will prevent 
		confusion and work for the next developer that needs to pick up what you 
		left behind.
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		?>
			<div id="content" itemscope itemtype="http://schema.org/Blog">
				<h1 id="page-title">Blog</h1>
				<?php 
					if (have_posts()) {
						blunt_archive_nav('before');
						?>
							<div class="articles">
								<?php 
									while (have_posts()) {
										the_post();
										?>
											<div class="article" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
											 <h2 itemprop="name"><a itemprop="url" href="<?php 
														the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a></h2>
												<?php blunt_post_meta(); ?>
												<p><?php the_excerpt(); ?></p>
												<p><a href="<?php the_permalink(); ?>">Continue Reading</a></p>
											</div>
										<?php 
									} // end while have posts
								?>
							</div>
						<?php 
						blunt_archive_nav('after');
					} else {
						// no posts
						?>
							<p>No results were found.</p>
						<?php 
					}
				?>
			</div>
			<div id="sidebar-after-content">
				<?php get_sidebar('blog'); ?>
			</div>
		<?php 
		get_footer();
	}
	if (BLUNT_CACHE_FULL_PAGE) {
		do_action('blunt_cache_frag_output_save', $key);
	}
?>