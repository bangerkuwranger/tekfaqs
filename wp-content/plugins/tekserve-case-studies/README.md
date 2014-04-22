Tekserve Case Studies
====================

Wordpress plugin to create a custom post type for Case Studies. Includes custom fields for the source' company and case study PDF, and a shortcode to display case studies in Genesis themes.


Contributors: bangerkuwranger

Donate link: http://www.chadacarino.com/burnallmoney.html

Tags: custom post type, custom fields, case study

Requires at least: 3.1

Tested up to: 3.7.1

Stable tag: 1.0

License: MIT

License URI: http://www.chadacarino.com/license-mit.html

Wordpress plugin to create a custom post type for Testimonials. Includes custom fields for name and organization of the quote source.

== Description ==

It's easy to create simple custom post types, and create functional dependencies in your theme while doing so. Skip it! Use this plugin to create a theme-independent custom post type for your site to maintain a collection of case studies, complete with downloadable pdfs. Easy.

== Installation ==

1. Upload the `tekserve-case-studies` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Start creating your collection of quotes in the 'Case Studies' item in WordPress

== Frequently Asked Questions ==

= How do I show my case studies on a page? =

It's pretty easy to call custom post types in the loop, and you can display a single post with some code for a custom shortcode. This plugin includes a shortcode that is compatible with the Genesis framework; if enough people ask I can do a little more to add compatibility outside of the Genesis framework.

= Can I display a section with rotating case studies? =

Sure! You'll have to write the rotator, and you can set up an admin panel to select the quotes, or just use shortcode attributes. However, there are already many existing plugins that already provide this function, and that may be easier for you to implement. This was written to provide a lightweight implementation of a specific function: to enter, store, and display a single quote at a time.

= Can I display more than one quote on a page? =

Yep. You can either use the shortcode several times to display multiple specific quotes:

`[tekserve-case-study id="1"] [tekserve-case-study id="2"] [tekserve-case-study id="3"]`

Or assign a Testimonial Type to a set of quotes and display them in an unordered list with a single shortcode:

`[tekserve-case-study type="just-these"]`

= How do I find a quote in the Case Study list? There's no title! =

Actually, there is a title, you just don't choose it yourself. This plugin automatically assigns your testimonial a title that shows you the text, source, and id (for the shortcode).


== Changelog ==

= 1.0 =
