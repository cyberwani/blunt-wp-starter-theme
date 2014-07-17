<?php 
  // home/front page template
  // can't use home.php or page.php isn't loaded
  // this shows an example of a 1 column page
  
  while (have_posts()) {
    the_post();
    ?>
      <div id="content">
        <?php 
          // include content from home page if it exists 
          the_content();
        ?>
      </div>
    <?php 
  } // end while have posts  
?>
