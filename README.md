Blunt WP Starter Theme
======================

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
though: functions I frequently use, schema.org markup; built in support for my
fragment and object cache, well laid out areas and files so I can easily 
find/add/modify what needs changing, and clean, easy to read coding.

Guiding principle [YAGNI](http://en.wikipedia.org/wiki/You_aren%27t_gonna_need_it), 
I've stripped out the 95% that I'm never gonna use and kept or added only those 
things that I know I'm gonna need and use most of the time.

Read through the files, if you like what you see then use it or fork it, if 
you don't like it then I'm sure there's a starter theme out there that is trying 
to be everything to every developer that will suit your needs.

Please note that this theme is not meant to have child themes. The idea here is
that you're going to use this as a base for starting your own custom theme,
rename it, give it a nice screenshot, etc.

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

Custom post types and taxonomies solve the sorting mess, code bloat, excessive db 
queries and complicate template files that are created when one tries to store all 
content types together in a single post type. Not to mention making the admin easier 
to navigate and simplifying site maintenance for the average user. If you're 
creating more than a simple brochure site that will have simple pages and a blog 
and you're not using custom post types and taxonomies then ***YOU ARE DOING IT 
WRONG!*** and it's time you learned how to use custom post types and taxonomies 
or it's really time for you to stop building WP themes.

Check out [Custom Post Type UI](http://wordpress.org/plugins/custom-post-type-ui/).
Its a plugin that makes the process of creating custom post types and taxonomies
simple. If you look through my custom post type example files you'll see that 
creating templates for them is really rather stupidly easy, if you can understand 
a basic post (single.php) or archive (index.php) template then you can build 
templates for custom post types and taxonomies.


Schema.Org Markup
-----------------

See [http://schema.org/](http://schema.org/)

There are very few themes available that already incorporate basic schema.org 
markup correctly, especially for anyone that wants to use WP for more than a 
blog. I've looked at the plugin solutions, but they are not really solutions since you 
need to do 1 of 3 things that are all bad practices:
* Let the plugin format your content
* Duplicate the content, once in natural form and once in a block created by the plugin
* Use hidden markup <meta> tags in the content

The problem is that no generic theme that tries to be all things to all people is 
going to manage this properly without making the backend so complicated to use 
that it becomes frustrating to the average user. To embrace schema.org markup 
in WP the developer needs to embrace the idea of custom post types and taxonomies 
so that separate templates can be used for each schema.org type to be delt with. 
The developer also needs to embrace the use of custom fields so that individual 
data can be marked up. Yeah, you can get the basic data in there with a generic 
theme, but the more advanced item properties, good luck with that. Take a look 
at the plugin [ACF](http://wordpress.org/plugins/advanced-custom-fields/) for 
the best way to add custom fields to your post types, or terms, or users, or 
whatever the 4311 you want to add them to.

The basic theme templates contain the correct schema.org markup for blogs. In 
the folder cpt-examples you will also find some other templates with markup for
specific schema types.

Caching
-------

In most cases I am unable to use a full page cache in the sites I build. The 
reasons for this are complex but there is usally data that cannot be cached on 
almost every page of a site. This can be as simple as a short contact form that
appears on 99% of the site's pages; the hidden data in the form that prevents
spam must be refreshed on every page load and it is different on every page load.
Combine that with a full page cache and all the forms break.

This theme incorporates my own caching plugin Blunt Cache, you can find it in the
[WordPress Repository](http://wordpress.org/plugins/blunt-cache/) or [here on GitHub](https://github.com/Hube2/blunt-cache). I needed both a fragment cache and 
an object cache and I needed them to be stupidly easy and quick to implement. It 
can also be used as a full page cache on pages that won't break when cached. If 
you use another cache the code I've included in the template files can simply be 
ignored, or if you really want to you can remove it.

*Full Page Caching*
I have created a form of full page caching and implemented it in this theme. If 
you are using my caching plugin you can remove it by altering the function
blunt_cache_full_page_setup() in the file /include/theme-setup.php.

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
       * part of the || is not evaluated caching is never started. Caching of 
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

I have only implemented one example of fragment caching outside of full page in the base
theme. This example can be seen in single.php. Three areas of the page are being cached
and the comments section of the page is left uncached so that it can remain dynamic and
show new comments without needing to clear any part of the cache. In most cases I would 
alter the caching on a template dependent on what's going to be mostly static and what 
will likely need to be refreshed on each page load.