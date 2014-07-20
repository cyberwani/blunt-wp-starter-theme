<?php 
	/*
		The template for displaying Comments
 		
		The area of the page that contains comments and the comment form.
	*/
	
	// If the current post is protected by a password and the visitor has not yet
	// entered the password we will return early without loading the comments.
	if (post_password_required()) {
		return;
	}
?>
<div id="comments" class="comments-area">
	<?php 
		if (have_comments()) { 
			?>
				<h2 class="comments-title">
					<?php 
						echo _n('<span itemprop="commentCount">1</span> thought', 
										'<span itemprop="commentCount">%s</span> thoughts', 
										get_comments_number());
						echo ' on &quot;', get_the_title(), '&quot;';
					?>
				</h2>
			<?php blunt_comment_nav('before'); ?>
			<ul class="comment-list">
				<?php 
					// please note that the callback here
					// will only work with style ul or ol
					// if you wish to use div then you'll need to rewrite the callback
					wp_list_comments(array('style' => 'ul',
																 'avatar_size'=> 0,
																 'callback' => 'blunt_comment_schema',
																 'end-callback' => 'blunt_comment_schema_end'));
				?>
			</ul>
			<?php 
				blunt_comment_nav('after');
				if (!comments_open()) {
					?>
						<p class="no-comments"><?php __('Comments are closed.'); ?></p>
					<?php
				}
		} // end if have_comments()
		comment_form();
	?>
</div>
