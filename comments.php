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
<div id="comments" class="comments-area" itemscope itemtype="http://schema.org/UserComments">
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
					wp_list_comments(array('style' => 'ol',
																 'short_ping' => true,
																 'avatar_size'=> 34,
																 'callback' => 'blunt_comment_schema'));
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
