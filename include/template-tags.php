<?php 
	
	/* Tags for your templates */
	
	function blunt_abs_url($url) {
		/*
			I use a plugin called Root Relative URLs
			The problem is that sometimes urls should be absolute
			This function will convert urls back to absolute when needed
		*/
		$new_url = $url;
		if (!preg_match('#^https?://#', $url)) {
			$new_url = 'http';
			if (is_ssl()) {
				$new_url .= 's';
			}
			$new_url .= '//'.$_SERVER['HTTP_HOST'];
			$path = $url;
			if (substr($url, 0, 1) == '..') {
				// check for relative just in case
				$abspath = substr(ABSPATH, 0, strlen(ABSPATH)-1);
				$path = dirname($abspath.$_SERVER['REQUEST_URI']).'/'.$url;
				$path = str_replace($abspath, '', realpath($path));
			}
			$new_url .= $path;
		}
		return $new_url;
	} // end function blunt_abs_url
	
	function blunt_post_meta($show_author=true) {
		$categories_list = get_the_category_list(', ');
		$tag_list = get_the_tag_list('', ', ', '');
		$date = sprintf('<a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s" itemprop="datePublished">%4$s</time></a>',
										esc_url(get_permalink()),
										esc_attr(get_the_time()),
										esc_attr(get_the_date('c')),
										esc_html(get_the_date()));
		$author = false;
		if ($show_author) {
			$author = sprintf('<span itemprop="author" itemscope itemtype="http://schema.org/Person">'.
												'<a href="%1$s" title="%2$s" itemprop="name">%3$s</a></span>',
												esc_url(get_author_posts_url(get_the_author_meta('ID'))),
												esc_attr(sprintf(__('View all posts by %s'), get_the_author())),
												get_the_author());
		} // end if get author
		?>
			<div class="item-meta">
				<p>
					This entry was posted
					<?php 
						if ($categories_list) {
							echo ' in ',$categories_list; 
						}
						if ($tag_list) {
							echo ' and tagged ',$tag_list;
						}
						if ($author) {
							echo ' by ',$author;
						}
						echo ' on ',$date;
					?>
				</p>
			</div>
		<?php 
	} // end function blunt_post_meta
	
	// this function strips html form excerpts
	// something I do often, feel free to remove it or comment it out
	function blunt_strip_excerpt_html($content) {
		$content = preg_replace('#</?\w+[^>]*>#', '', $content);
		return $content;
	} // end function blunt_strip_excerpt_html
	add_filter('the_excerpt', 'blunt_strip_excerpt_html', 99);
	
	function blunt_comment_schema($comment, $args, $depth) {
		// this function ignores $args['style'] and always outputs a for ul/ol style
		// see http://codex.wordpress.org/Function_Reference/wp_list_comments for example
		// a custom function for displaying comments that includes schema.org markup
		$GLOBALS['comment'] = $comment;
		$class = '';
		if (!empty($args['has_children'])) {
			$class = 'parent';
		}
		?>
    	<li id="comment-<?php comment_id(); ?>" <?php comment_class($class); ?>>
      	<div id="div-comment-<?php 
						comment_id(); ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
        	<div class="comment-author vcard">
          	<?php 
							if ($args['avatar_size']) {
								echo get_avatar($comment, $args['avatar_size']);
							}
							printf(__('<cite class="fn" itemprop="creator">%s</cite> <span class="says">says:</span>'),
												get_comment_author_link());
							if (!$comment->comment_approved) {
								?>
                	<em class="comment-awaiting-moderation">
										<?php _e('Your comment is awaiting moderation.'); ?>
                  </em>
									<br />
                <?php 
							}
						?>
            <div class="comment-meta commentmetadata">
            	<a href="<?php 
									echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>"><?php 
									printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?></a>
							<?php edit_comment_link(__('(Edit)'), '&nbsp;&nbsp;', ''); ?>
						</div>
            <span itemprop="commentText">
							<?php comment_text(); ?>
            </span>
            <div class="reply">
            	<?php 
								comment_reply_link(array_merge($args, array('add_below' => $add_below,
																														'depth' => $depth,
																														'max_depth' => $args['max_depth'])));
							?>
            </div>
          </div>
        </div>
		<?php 
		// to meet the needs of wp since recursive functions 
		// don't seem to be on the menu
		// the closing li tag is in blunt_comment_schema_end()
	} // end function blunt_comment_schema
	
	function blunt_comment_schema_end() {
		?>
    	</li>
    <?php 
	} // end function blunt_comment_schema_end
	
	function blunt_comment_nav($location='', $args=false) {
		// standard nave for newer/older comments
		// used on comment template
		/*
			$args = array('prev_text' => 'Newer Posts',
										'next_text' => 'Older Posts',
										'prev_char' => '&laquo',
										'next_char' => '&raquo;')
			$location = 'class name or class names to add to nav menu'
		*/
		$prev_text = 'Newer Comments';
		$next_text = 'Older Comments';
		$prev_char = '&laquo;';
		$next_char = '&raquo;';
		if (is_array($args)) {
			extract($args, EXTR_IF_EXISTS);
		}
		$comment_page_count = get_comment_pages_count();
		if ($comment_page_count > 1 && get_option('page_comments')) {
			global $cpage;
			?>
				<ul class="blunt-comment-nav <?php echo $location; ?>">
			 		<?php 
						if ($cpage > 1) {
							?>
								<li class="newer">
									<?php previous_posts_link($prev_char.' '.__($prev_text)); ?>
								</li>
							<?php 
						}
						if ($cpage < $comment_page_count) {
							?>
								<li class="older">
									<?php next_posts_link(__($next_text).' '.$next_char); ?>
								</li>
							<?php 
						}
					?>
				</ul>
			<?php
		}
	} // end function blunt_comment_nav
	
	function blunt_archive_nav($location='', $args=false) {
		// standard archve nav newer/older posts
		// can be used to put previous next links on archive pages
		/*
			$args = array('prev_text' => 'Newer Posts',
										'next_text' => 'Older Posts',
										'prev_char' => '&laquo',
										'next_char' => '&raquo;')
			$location = 'class name or class names to add to nav menu'
		*/
		global $wp_query;
		$prev_text = 'Newer Posts';
		$next_text = 'Older Posts';
		$prev_char = '&laquo;';
		$next_char = '&raquo;';
		if (is_array($args)) {
			extract($args, EXTR_IF_EXISTS);
		}
		if ($wp_query->max_num_pages > 1) {
			?>
				<ul class="blunt-archive-nav <?php echo $location; ?>">
					<?php 
						if ($wp_query->paged > 1) {
							?>
								<li class="newer">
									<?php previous_posts_link($prev_char.' '.__($prev_text)); ?>
								</li>
							<?php 
						}
						if ($wp_query->paged < $wp_query->max_num_pages) {
							?>
								<li class="older">
									<?php next_posts_link(__($next_text).' '.$next_char); ?>
								</li>
							<?php 
						}
					?>
				</ul>
			<?php 
		} // end if pages > 1
	} // end function blunt_archive_nav
	
	function blunt_post_nav($location='', $args=false) {
		// for single post pages
		$prev_post = 'Previous Post';
		$next_post = 'Next Post';
		$next_char = '&laquo;';
		$prev_char = '&raquo;';
		// see blunt_archive_nav for args
		ob_start();
		next_post_link('%link', $next_char.' '.__($next_post));
		$next_link = ob_get_clean();
		ob_start();
		previous_post_link('%link', __($prev_post).' '.$prev_char);
		$prev_link = ob_get_clean();
		if ($next_link || $prev_link) {
			?>
				<ul class="blunt-post-nav <?php echo $location; ?>">
					<?php 
						if ($next_link) {
							?>
								<li class="next"><?php echo $next_link; ?></li>
							<?php 
						}
						if ($prev_link) {
							?>
								<li class="prev"><?php echo $prev_link; ?></li>
							<?php 
						}
					?>
				</ul>
			<?php 
		}
	} // end function blunt_post_nav
	
?>