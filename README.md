Blunt WP Starter Theme
======================

© 2014 John A. Huebner II
GNU General Public License | https://www.gnu.org/licenses/gpl.html

...however, once you've significantly changed the theme to build your own unique project, either for yourself or for a client under a different theme name (as is encouraged) you're entirely welcome to copyright and license that project as you see fit.

Description
-----------

My bare-bones, no-frills starter theme. It has all the things that I want and none of the things I want to avoid.

Minimal Standards Complient HTML, everthing that I feel is unessary or combersome has been removed. There is the absolute minimum CSS there can be to meet WP guidelines. It avoids frameworks and css pre-porcessors, why, becuase they slow sites down. Also, trying to keep up with the latest fads in development is like trying to hurd cats; by the time you think you have one figured out it changes direction and most of the rest have disappeared.

It does have some things that I consider required that you won't see elsewhere though. Functions I frequently use; schema.org markup; well laid out areas and files so I can easily find/add/modify what needs changing.

Guiding principle [YAGNI](http://en.wikipedia.org/wiki/You_aren%27t_gonna_need_it), I've stripped out the 95% that I'm never gonna use and kept or added only those things that I know I'm gonna need and use most of the time.

Read through the files, if you like what you see then use it or branche it, if you don't like it I'm sure there's a starter theme out there that is trying to be everything to every developer that will suit your needs.


Schema.Org Markup
-----------------

See [http://schema.org/](http://schema.org/)
================================================================================
There are very few themes available that already incorporate basic schema.org 
markup, especially for anyone that wants to use WP for more than a blog. I've 
looked at the plugin solutions, but they are not really solutions since you 
either need to do 1 of 3 things that are all bad practices:
* Let the plugin format your content
* Duplicate the content, once in natural form and once in a block created by the plugin
* Use hidden markup <meta> tags in the content
The problem is that no generic theme that tries to be all things to all people is going to manage this properly without making the backend so complicated to use that it becomes frustrating. To embrace schema.org in WP the developer needs to embrace the idea of custom post types and taxonomies so that separate templates can be used for each type of schema.org type to be delt with. The developer also needs to embrase the use of custom fields so that individual data can be marked up. Yeah, you can get the basic data in there
