<?php
  /*
      The template for showing a custom post type archive
      copy this file and replace "CUSTOM-POST-TYPE" with your custom post type slug
			
			This template also includes the basic schema.org markup for "Product"
  */
	
	get_header();
?>
	<div id="sidebar-before-content">
		[Sidebar Before Content]
	</div>
	<div id="content">
		<h1 id="page-header-h1">Products</h1>
		<?php 
			if (have_posts()) {
				$args = array('prev_text' => 'Previous Products',
											'next_text' => 'More Products');
				blunt_archive_nav('before', $args);
				?>
					<div class="products">
						<?php 
							while (have_posts()) {
								?>
									<div class="product" itemscope itemtype="http://schema.org/Product">
                  	<h2><a itemprop="url" href="<?php 
												the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a>
                    </h2>
                    <p itemprop="description"><?php the_excerpt(); ?></p>
                    <p><a itemprop="url" href="<?php the_permalink(); ?>">More Information</a></p>
                  </div>
								<?php 
							} // end while have_posts
						?>
					</div>
				<?php 
				$args = array('prev_text' => 'Previous Products',
											'next_text' => 'More Products');
				blunt_archive_nav('after', $args);
			} else {
				?>
					<p>No Products Found</p>
				<?php 
			}
		?>
	</div>
	<div id="sidebar-after-content">
		[Sidebar After Content]
	</div>
<?php 	
	get_footer();
?>