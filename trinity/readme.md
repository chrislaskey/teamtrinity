About
================================================================================

The single page WordPress theme for Team Trinity designed by [David Delmar
Senties](http://delmarsenties.com/) built by [Chris Laskey](http://chrislaskey.com).

![Team Trinity WordPress Theme](/trinity/readme-screenshot.jpg "Team Trinity WordPress Theme")

Features
--------

This theme makes it easy to manage a one page WordPress theme without changing
how users usually create and add content.

Content creators still make posts and pages, and structure content in
a hierarchy. New sections can be created dynamically and ordered on the fly by
updating a WordPress menu.

The template is responsive and ready for desktops, tablets and mobile.

It also features a ScrollSpy style main navigation, which follows the user,
highlights the current section, and scrolls to any section when clicked.

Full width banner images can be added to any page by inserting
`{{ banner-image:/path/to/image.jpg }}` anywhere in a page or post's content.

WordPress developers can create custom section display using an extensible
template file system.

How to Install
--------------

To install the theme:

1. Install WordPress
2. Download and unzip the theme files
3. Place the `trinity` theme directory in the WordPress theme directory
   `/wp-content/themes/`
4. Log into WordPress. From the admin panel select `Appearance > Themes`.
   Select the Trinity theme.
5. From `Pages > Add New` create a page for each of the main sections. The
   titles for each of these sections should be short, ideally one word like
   "Mission", "Programs", "Races", and "Apply".
6. From `Appearance > Menus` create a new menu named "Main Menu". Once created
   select "Automatically add new top-level pages to this menu" and "Theme
   Locations: Main Menu" from the Menu Settings. Add each of the main section
   pages to the menu. Save the menu.

That's it! New sections can be added by creating a page and adding it to the
Main Menu (which should automatically be added). Section order can be changed
by changing the menu order.

For Developers
==============

Custom templates for each section
---------------------------------

By default a section is rendered by the `section.php` file.

Before loading the default `section.php` file the theme will look for a section
specific template under the path `section-<page-slug>.php`. For example, the
"Races" section will look for a `section-races.php` file, if one does not exist
it will fall back on the default `section.php`.

Creating a section template is as easy as copying the `section.php` file and
renaming the new file `section-<page-slug>.php`.

Creating a section template
---------------------------

Page content is available through the `$post` variable. The fields match the
core WordPress function
[`get_post()`](http://codex.wordpress.org/Function_Reference/get_post) output.

Children pages are available through the `$children` variable. This is an array
of pages also returned by the WordPress `get_post()` function.

In order to use WordPress [Loop](http://codex.wordpress.org/The_Loop) functions
use the core WordPress
[`setup_postdata()`](https://codex.wordpress.org/Function_Reference/setup_postdata)
function. For example, if extracting the main section page's data, call
`setup_postdata($post)`. If iterating over the children pages use
`setup_postdata($current_child)`. The usual WordPress Loop template functions
like `the_content()` and `the_title()` can be used.

For example this template will display the titles of the main page and children
pages:

```php
<?php
/**
 * @package WordPress
 * @subpackage CELEST
 * @since 3.0.0
 */
?>

<section>
	<div class="twelve columns offset-by-two content">
		<?php setup_postdata($post); ?>
		<p>Main page title: <?php the_title(); ?></p>

		<?php if( ! empty($children) ){
			echo "<p>Children page titles:</p>";
			foreach($children as $child_post){
				setup_postdata($child_post);
				the_title();
			}
		?>
	</div>
	<div class="clearfix"></div>
</section>
```

License
================================================================================

All code written by me is released under MIT license. See the attached
license.txt file for more information, including commentary on license choice.
