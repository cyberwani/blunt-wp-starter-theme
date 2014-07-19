Blunt WP Starter Theme
======================

This is not quite ready yet, there are still a few changes that need to be made, but it's close. I still need to add additional chaching of fragments and objects as well as more templates for custom post types and taxonomies using different schema.org markup.

© 2014 John A. Huebner II
GNU General Public License | https://www.gnu.org/licenses/gpl.html

...however, once you've significantly changed the theme to build your own unique 
project, either for yourself or for a client under a different theme name (as is 
encouraged) you're entirely welcome to copyright and license that project as you 
see fit.

Description
-----------

My bare-bones, no-frills starter theme. It has all the things that I want and 
none of the things I want to avoid.

Minimal Standards Complient HTML, everthing that I feel is unessary or combersome 
has been removed. There is the absolute minimum CSS there can be to meet WP 
guidelines. It avoids frameworks and css pre-porcessors, why, becuase they slow 
sites down. Also, trying to keep up with the latest fads in development is like 
trying to hurd cats; by the time you think you have one figured out it changes 
direction and most of the rest have disappeared.

It does have some things that I consider required that you won't see elsewhere 
though. Functions I frequently use; schema.org markup; well laid out areas and 
files so I can easily find/add/modify what needs changing.

Guiding principle [YAGNI](http://en.wikipedia.org/wiki/You_aren%27t_gonna_need_it), 
I've stripped out the 95% that I'm never gonna use and kept or added only those 
things that I know I'm gonna need and use most of the time.

Read through the files, if you like what you see then use it or branche it, if 
you don't like it I'm sure there's a starter theme out there that is trying to 
be everything to every developer that will suit your needs.

Custom Post Types & Taxonomies
------------------------------

This theme stresses the use of custom post types and taxonomies. Why? It is the
opinion of the author (me) that the only thing that should be put into "Posts"
is blog posts and the only thing that should be put into "Pages" are content
pages. I should not open up "Posts" and see a category named "Testimonials" for
holding testimonials or a category name "Products" for holding products. Or, worse
yet, no categories at all and "Posts" that are nothing but testimonials or
products because the developer that built it did not have enough forethought to
realize that the client might some day want to create "Blog Posts".

Custom post types and taxonomies solve the sorting mess, code bloat and excessive
db queries that are created when one tries to store all content types together in
a single post type. If you're creating more than a simple brochure site that will 
have simple pages and a blog and you're not using custom post types and taxonomies 
then ***YOU ARE DOING IT WRONG!*** It's time you learned how to use custom
post types and taxonomies or it's time for you to stop building WP sites.


Schema.Org Markup
-----------------

See [http://schema.org/](http://schema.org/)

There are very few themes available that already incorporate basic schema.org 
markup, especially for anyone that wants to use WP for more than a blog. I've 
looked at the plugin solutions, but they are not really solutions since you 
either need to do 1 of 3 things that are all bad practices:
* Let the plugin format your content
* Duplicate the content, once in natural form and once in a block created by the plugin
* Use hidden markup <meta> tags in the content

The problem is that no generic theme that tries to be all things to all people is 
going to manage this properly without making the backend so complicated to use 
that it becomes frustrating. To embrace schema.org in WP the developer needs to 
embrace the idea of custom post types and taxonomies so that separate templates 
can be used for each type of schema.org type to be delt with. The developer also 
needs to embrace the use of custom fields so that individual data can be marked up. 
Yeah, you can get the basic data in there with a generic theme, but the more
advanced item properties, good luck with that.

The basic theme templates contain the correct schema.org markup for blogs. In 
the folder cpt-examples you will also find some other templates with markup for
specific schema types

Caching
-------

In most cases I am unable to use a full page cache in the sites I build. The 
reasons for this are complex but there is usally data that cannot be cached on 
almost every page of a site. This can be as simple as a short contact form that
appears on 99% of the site's pages. The hidden data in the form that prevents
spam must be refreshed on every page load and it is different on every page load.
Combine that with a full page cache and all the forms break.

This theme incorporates my own caching plugin Blunt Cache, you can find it in the
[WordPress Repository](http://wordpress.org/plugins/blunt-cache/) or [here on GitHub](https://github.com/Hube2/blunt-cache). It is a fragment and object cache,
but it can also be used as a full page cache on pages that won't break when cached.
If you use another cache, the code I've included in the template files can simply
be ignored, or if you really want to you can remove it.

*Full Page Caching*
I have created a form of full page caching and implemented it in this theme. If you
are using my caching plugin you can remove it by altering the function
blunt_cache_full_page_setup() in the file /includ/theme-setup.php.

You will find code like the following in the main template files. I thought it should
be explained because the logic might confuse some people. It is an alteration of the code
you will find in the documentation for the fragment cache in Blunt Cache.

```
  $key = 'FULL PAGE'.$_SERVER['REQUEST_URI'];
  if (!BLUNT_CACHE_FULL_PAGE || !apply_filters('blunt_cache_frag_check', false, $key)) {
      /* The code of the template will be found here.
       * In the above if statement, do to the way if statements work in PHP if 
       * BLUNT_CACHE_FULL_PAGE is false then this block will always be executed. this is
       * due to short-circuit evaluation. Since the first part of the || is true then
       * there is no need to perform the second part of the statement. Since the second
       * part of the || is not evaluated caching is never is never started. Caching of 
		   * the full page will only happen if the first part of the statement evaluates 
			 * to false which means BLUNT_CACHE_FULL_PAGE === true. It's a bit of backwards 
			 * logic, but the only way it will work using a single if statement.
       */
  }
  if (BLUNT_CACHE_FULL_PAGE) {
    // here, we only do the final step if full page caching in turned on.
    do_action('blunt_cache_frag_output_save', $key);
  }
```