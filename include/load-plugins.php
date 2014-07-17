<?php 
  
  /*
      
      Any plugins that you place into the includes/plugins 
      folder will be autoloaded by this file
      
      Note that plugins loaded here must be safe for loading from the theme
      no checking is done, if a file with a plugin header is found it is loaded
      
      be vewwwy vewwwy carful
      
  */
  
  // get_plugin_data( $plugin_file, $markup = true, $translate = true )
  
  $blunt_plugin_path = dirname(__FILE__).'/plugins';
  $plugin_list = blunt_get_plugin_list($blunt_plugin_path);
  if (count($plugin_list)) {
    foreach ($plugin_list as $plugin_file) {
      include($plugin_file);
    } // end foreach plugin_file
  } // end if count plugin_list
  
  function blunt_get_plugin_list($path, $depth=0) {
    // recursive function to read files and folders in plugin folder
    // I could have built a nested loop to look into subfolders
    // but recursive functions are too much fun to pass up
    $plugins = array();
    $files = scandir($path);
    if (count($files)) {
      foreach ($files as $file) {
        $file_path = $path.'/'.$file;
        if (is_dir($file_path) && substr($file, 0, 1) != '.' && $depth == 0) {
          // recursive call here
          // but we only go one level in becuase some plugins may include other plugins
          $plugins = array_merge($plugins, blunt_get_plugin_list($file_path, $depth+1));
        } elseif (!is_dir($file) && strtolower(substr($file, -4)) == '.php') {
          // php file could be a plugin
          $data = get_plugin_data($file_path, false, false);
          if (!empty($data['Name'])) {
            $plugins[] = $file_path;
          } // end if data name
        } // end if elseif
      } // end foreach $file
    } // end if count files
    return $plugins;
  } // end function blunt_get_plugin_list
  
?>
