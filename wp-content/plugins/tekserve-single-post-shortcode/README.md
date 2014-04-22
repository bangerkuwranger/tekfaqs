Tekserve Single Post Shortcode
=====================

Contributors: bangerkuwranger

Donate link: http://www.chadacarino.com/burnallmoney.html

Tags: single post, preview, excerpt, thumbnail, link, shortcode, content, widget

Requires at least: 3.1

Tested up to: 3.8

Stable tag: 1.4

License: MIT

License URI: http://www.chadacarino.com/license-mit.html

Wordpress plugin to create a shortcode for showing the title, post info, excerpt, and thumbnail for a single post.

== Description ==

There are plenty of plugins to show lists of posts, but if you only want to display a condensed preview of a post on any wp page, this is the plugin for you! The shortcode accepts the numeric id of any post as an attribute, and will display a preview that links to that post. This preview is generated with easily styled html. To show or hide the featured image for your single post preview, pass the attribute `showimage` with either `hide` or `show`. If you want to add custom text, or a button of some sort after the excerpt, add your text as a value of a `buttontext` attribute in the shortcode (works with the widget, too). It's pretty easy!

For fun, I decided to also build a widget that does the same thing; it's included and can be used like any other widget. Why not?!

== Installation ==

1. Upload the `tekservesinglepostshortcode` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode anywhere you want a condesed preview of a single post, e.g. `[single_post id="1" showimage="show" buttontext="Read More" /]`.
4. To use the widget, go to Appearance->Widgets and drag the Tekserve Single Post Widget into whatever widget area you'd like. Enter the post id, check the box if you want to show the featured image, and hit save.

== Frequently Asked Questions ==

= Why would I want to use this? =

You want to display a link to a single post with a brief content preview. Plenty of plugins will create this type of object in a list, or as part of popular or related posts, but sometimes you want to manually feature a post somewhere and not mess around with sticky posts or the loop. This simple shortcode does it for you without modifying your theme's functions.php.

= How can I style the output? =

It's pretty easy; just add css for the output classes and ids in your style.css for your theme, or enqueue a separate .css file in your theme to handle it.

Here's a listing of targets to style the output:

<table>
<thead>
<tr>
<th style="padding: 10px">
Output to Style
</th>
<th style="padding: 10px">
CSS target
</th>
</tr>
</thead>
<tbody>
<tr>
<td style="padding: 10px">
Single Post Container
</td>
<td style="padding: 10px">
.tekserve-single-post -or- #single-post-<i>id</i> (id is numerical post id)
</td>
</tr>
<tr>
<td style="padding: 10px">
Featured Image
</td>
<td style="padding: 10px">
.tekserve-single-post a img
</td>
</tr>
<tr>
<td style="padding: 10px">
Title
</td>
<td style="padding: 10px">
.tekserve-single-post .tekserve-single-post-title
</td>
</tr>
<tr>
<td style="padding: 10px">
Date and Author
</td>
<td style="padding: 10px">
.tekserve-single-post .tekserve-single-post-meta
</td>
</tr>
<tr>
<td style="padding: 10px">
Post Content
</td>
<td style="padding: 10px">
.tekserve-single-post .tekserve-single-post-excerpt
</td>
</tr>
<tr>
<td style="padding: 10px">
Button After Excerpt
</td>
<td style="padding: 10px">
.tekserve-single-post .tekserve-single-post-excerpt .tekserve-single-post-button
</td>
</tr>
</tbody>
</table>

= Where does the plugin get its output? =

From the post, of course! Here are the specifics:

* Image - Post Featured Image / Thumbnail
* Title - Post Title
* Meta - Post Date and Post Author
* Excerpt - Post excerpt, if it exists. If not, first 90 characters of content, sans html tags

Also, if you enter a 'buttontext' value in the shortcode, that text will be enclosed in a div you can style into a button or some other form of call to action. This doesn't show up if you don't enter anything.

== Changelog ==

= 1.4 =

* tested with WP 3.8
* removed '...Continue...' from end of excerpt
* added 'buttontext' option to create a read-more CTA button or text after excerpt

= 1.3 =

* filtered excerpt html tags
* added support for excerpt field

= 1.2 =

* updated file permissions

= 1.1 =

* added widget

= 1.0 =

* added shortcode

== Upgrade Notice ==

= 1.4 =

basic functionality confirmed.