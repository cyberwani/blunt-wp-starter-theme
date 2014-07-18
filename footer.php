<?php
	/*
		The template for displaying the footer
	*/
?>
				<div class="clearfix"></div>
			</div><!-- end #body -->
			<div id="footer">
				<div class="footer-menu menu">
					<?php 
						$args = array('theme_location' => 'footer-menu',
													'container' => false,
													'menu_class' => 'footer',
													'echo' => true,
													'fallback_cb' => false,
													'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
													'depth' => -1);
						wp_nav_menu($args);
					?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div><!-- end #main -->
		<?php 
			include(dirname(__FILE__).'/inc/before-wp-footer.php');
			wp_footer();
			include(dirname(__FILE__).'/inc/after-wp-footer.php');
		?>
	</body>
</html>
