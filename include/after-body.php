<?php 
  
  /*
      this file is included immediately after the <body> tag
      put whatever html and php you need in that location in this file
      for example Google Tag Manager Code
      
      some people have asked me what this file is for and don't understand what to do with it
      It's really simple, there is no hook for adding things just after the opening <body> tag
      and no way working withing WP to do so. Just for example Google Tag manager.
      Google Tag Manager needs to be added just after the opening <body> tag.
      It really needs to be there so that it runs in time to capture events for GA.
      There are plugins that will add it but they add it using JavaScript/JQuery or at
      the end of the document, which are both pretty useless ways of installing something
      that needs to be set up early in the page load.
      That's where this file comes in.
      
  */
  
  
?>