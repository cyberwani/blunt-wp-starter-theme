<?php
	/*
			The template for displaying Author Archive pages
	*/
	
	$key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
	if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
		get_header();
		?>
			<div id="content" itemscope itemtype="http://schema.org/Person">
				<h1 id="page-title">Author: <?php echo get_the_author(); ?></h1>
				<div class="author-info">
					<div class="author-avatar" itemprop="image">
						<?php echo get_avatar(get_the_author_meta('user_email'), 96, NULL, get_the_author()); ?>
					</div>
					<div class="author-description" itemprop="description">
						<h1 itemprop="name"><?php echo get_the_author(); ?></h1>
						<p itemprop="description"><?php the_author_meta('description'); ?></p>
					</div>
					<div class="clearfix"></div>
					<hr />
				</div>
				<?php 
					if (have_posts()) {
						blunt_archive_nav('before');
						?>
							<div class="articles" itemscope itemtype="http://schema.org/Blog">
								<?php 
									while (have_posts()) {
										the_post();
										?>
											<div class="article" itemscope itemtype="http://schema.org/BlogPosting">
												<h2 itemprop="name"><a itemprop="url" href="<?php 
														the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a></h2>
												<?php blunt_post_meta(false); ?>
												<p itemprop="description"><?php the_excerpt(); ?></p>
												<p><a href="<?php the_permalink(); ?>" itemprop="url">Continue Reading</a></p>
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