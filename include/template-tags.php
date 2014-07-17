<?php 
  
  /* Tags for your templates */
  
  function blunt_post_meta($show_author=true) {
    $categories_list = get_the_category_list(', ');
    $tag_list = get_the_tag_list('', ', ', '');
    $date = sprintf('<a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s" itemprop="datePublished">%4$s</time></a>',
                    esc_url(get_permalink()),
                    esc_attr(get_the_time()),
                    esc_attr(get_the_date('c')),
                    esc_html(get_the_date()));
    $author = false;
    if ($show_author) {
      $author = sprintf('<span itemprop="author" itemscope itemtype="http://schema.org/Person">'.
                        '<a href="%1$s" title="%2$s" itemprop="name">%3$s</a></span>',
                        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                        esc_attr(sprintf(__('View all posts by %s'), get_the_author())),
                        get_the_author());
    } // end if get author
    ?>
      <div class="item-meta">
        <p>
          This entry was posted
          <?php 
            if ($categories_list) {
              echo ' in ',$categories_list; 
            }
            if ($tag_list) {
              echo ' and tagged ',$tag_list;
            }
            if ($author) {
              echo ' by ',$author;
            }
            echo ' on ',$date;
          ?>
        </p>
      </div>
    <?php 
  } // end function blunt_post_meta
  
  // this function strips html form excerpts
  // something I do often, feel free to remove it or comment it out
  function blunt_strip_excerpt_html($content) {
    $content = preg_replace('#</?\w+[^>]*>#', '', $content);
    return $content;
  } // end function blunt_strip_excerpt_html
  add_filter('the_excerpt', 'blunt_strip_excerpt_html', 99);
  
  function blunt_archive_nav($location='', $args=false) {
    // standard archve nav newer/older posts
    // can be used to put previous next links on archive pages
    /*
        $args = array('prev_text' => 'Newer Posts',
                      'next_text' => 'Older Posts',
                      'prev_char' => '&laquo',
                      'next_char' => '&raquo;')
        $location = 'class name of class names to add to nav menu'
    */
    global $wp_query;
    $prev_text = 'Newer Posts';
    $next_text = 'Older Posts';
    $prev_char = '&laquo;';
    $next_char = '&raquo;';
    if (is_array($args)) {
      extract($args, EXTR_IF_EXISTS);
    }
    if ($wp_query->max_num_pages > 1) {
      ?>
        <ul class="ssi-archive-nav <?php echo $location; ?>">
          <?php 
            if ($wp_query->paged > 1) {
              ?>
                <li class="newer">
                  <?php previous_posts_link($prev_char.' '.$prev_text); ?>
                </li>
              <?php 
            }
            if ($wp_query->paged < $wp_query->max_num_pages) {
              ?>
                <li class="older">
                  <?php next_posts_link($next_text.' '.$next_char); ?>
                </li>
              <?php 
            }
          ?>
        </ul>
      <?php 
    } // end if pages > 1
  } // end function blunt_archive_nav
  
  function blunt_post_nav($location='', $args=false) {
    // for single post pages
    $prev_post = 'Previous Post';
    $next_post = 'Next Post';
    $next_char = '&laquo;';
    $prev_char = '&raquo;';
    // see blunt_archive_nav for args
    ob_start();
    next_post_link('%link', $next_char.' '.$next_post);
    $next_link = ob_get_clean();
    ob_start();
    previous_post_link('%link', $prev_post.' '.$prev_char);
    $prev_link = ob_get_clean();
    if ($next_link || $prev_link) {
      ?>
        <ul class="bnwp-post-nav <?php echo $location; ?>">
          <?php 
            if ($next_link) {
              ?>
                <li class="next"><?php echo $next_link; ?></li>
              <?php 
            }
            if ($prev_link) {
              ?>
                <li class="prev"><?php echo $prev_link; ?></li>
              <?php 
            }
          ?>
        </ul>
      <?php 
    }
  } // end function blunt_post_nav
  
?>