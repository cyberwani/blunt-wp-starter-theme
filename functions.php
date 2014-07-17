<?php 
  
  /* 
    all of our base funcitons are in included files
    you should comment out the calls to files you don't need
    and see thost files for what they do
  */
  
  $path = dirname(__FILE__);
  include($path.'/include/theme-setup.php');
  include($path.'/include/template-tags.php');
  include($path.'/include/pre-get-posts.php');
  include($path.'/include/useful-functions.php');
  include($path.'/include/admin-columns.php');
  include($path.'/include/add-rewrite-rules.php');
  include($path.'/include/load-plugins.php');
  
?>