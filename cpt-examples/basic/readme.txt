
This folder contains an example of a basic custom post type with archive template and a custom taxonomy template.

These are the basic files you need for creating a public custom post type that will use its own templates, which is suggested. It's much easier to create extra templates and let WP use the correct template than it is to try to display different post types and archives in the standard theme templates, unless you like long complicated files with lots of IF's Checking to see what post type or taxonomy your displaying. WP is going to look for these templates anyway so you may as well use them and not let the extra processing go to waste.

As you can see by looking at the files, CPT templates look just like the standard blog single and archive templates. WP has already done the correct queries for the posts. Of course the power of using CPT templates is seen when you have a different layout for the CPTs and you employ custom fields (like those you can create with Advanced Custom Fields) to add more detail to your custom data.

The file single-CUSTOM-POST-TYPE.php is needed for all public custom post types.

The file archive-CUSTOM-POST-TYPE.php is only needed if the post type will has archives.

The files taxonomy-CUSTOM-TAXONOMY.php is used for creating a custom taxonomy page. Each custom taxonomy can have its own template.

For more information on templates in theme files see the WP codex page: http://codex.wordpress.org/Template_Hierarchy