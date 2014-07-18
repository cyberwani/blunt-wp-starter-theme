
This folder contains an example of a custom post type with archive template and 
a custom taxonomy template that would be used for a "Product" section on a site. 
It contains the basic schema.org markup for a "Product".

Care should be taken when setting up the slugs for products and product types or 
categories. Many popular eCommerce plugins use "product" as the CPT slug as well 
as "brand" and "product_type" for the custom taxonomy slugs that are associated 
with the product CPT. If I were setting up a product section for "ABC Corp" I 
would most likey use the slug "abc-product" for the CPT slug and I would use 
something like "abc-product-type" and "abc-brand" for the custom taxonomy slugs. 
In fact I would probably add the "abc-" prefix to everything I did on the site 
just to be safe and not need to fix things due to future plugin aditions. 
Anyway....

As it says above, these templates include the basic schema.org markup. See 
[http://schema.org/Product](http://schema.org/Product) for more item properties 
that can be added.

If you look at the files archive-CUSTOM-POST-TYPE.php and taxonomy-CUSTOM-TAXONOMY.php 
in this folder you'll notice that they are identical. I include them both because 
if I were creating a product section for a site they would not be when I was done. 
I'd alter the archive template to only show uncategorized products as well as 
probably adding a list of top level product types or brands or whatever other 
custom taxonomies I'd set up. The custom taxonomy template(s) would show products 
for a given term, probably followed by sub-terms.

I'd also probably be using Advanced Custom Fields to add a lot more product 
information and including the schema.org markup for it. For example: images, model 
numbers, brands, part numbers, or whatever was important for the client.