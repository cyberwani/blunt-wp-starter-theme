<?php
	/*
			The template for Post Tage archive Page
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		?>
			<div id="content" itemscope itemtype="http://schema.org/Blog">
				<h1 id="page-title">Tagged: <?php single_tag_title(); ?></h1>
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
						blunt_archive_nav('before');
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