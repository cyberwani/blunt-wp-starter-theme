<?php
  /*
      The template for showing a custom taxonomy archive
      copy this file and replace "CUSTOM-TAXONOMY" with your custom taxonomy slug
  */
  
  get_header();
?>
  <div id="sidebar-before-content">
    [Sidebar Before Content]
  </div>
  <div id="content">
    <h1 id="page-title">CUSTOM TAXONOMY (OR TERM) ARCHIVE PAGE HEADING</h1>
    <?php 
      if (have_posts()) {
        blunt_archive_nav('before');
        ?>
          <div class="articles">
            <?php 
              while (have_posts()) {
                the_post();
                ?>
                  <div class="article">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
    [Sidebar After Content]
  </div>
<?php   
  get_footer();
?>