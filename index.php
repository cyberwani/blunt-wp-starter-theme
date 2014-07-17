<?php
  /*
      The main template file
  */
  
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
?>