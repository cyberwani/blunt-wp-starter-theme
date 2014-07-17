<?php
  /*
      The template for showing single Blog post
  */
  
  get_header();
  while (have_posts()) {
    the_post();
    ?>
      <div id="content" itemscope itemtype="http://schema.org/Blog">
        <div itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
          <?php blunt_post_nav('before'); ?>
          <h1 id="page-title" class="single-item-title" itemprop="name"><?php the_title(); ?></h1>
          <div itemprop="text"><?php the_content(); ?></div>
          <?php 
            blunt_post_meta();
            blunt_post_nav('after');
            comments_template();
          ?>
        </div>
      </div>
    <?php 
  } // end while have posts
?>
<div id="sidebar-after-content">
  <?php get_sidebar('blog'); ?>
</div>
<?php   
  get_footer();
?>
