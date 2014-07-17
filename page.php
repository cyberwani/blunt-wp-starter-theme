<?php
  /*
      The template for displaying all pages using default template
      can include different template for front or inner page
      see page-front.php and page-inner.php
  */
  
  get_header();
  
  if (is_front_page()) {
    get_template_part('page', 'front');
  } else {
    get_template_part('page', 'inner');
  }
  
  get_footer();
  
?>