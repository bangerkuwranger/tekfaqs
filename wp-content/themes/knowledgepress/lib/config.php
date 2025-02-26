<?php
/**
 * Roots configuration and constants
 */
//add_theme_support('root-relative-urls');    // Enable relative URLs
//add_theme_support('rewrite-urls');          // Enable URL rewrites
//add_theme_support('h5bp-htaccess');         // Enable HTML5 Boilerplate's .htaccess
//add_theme_support('bootstrap-top-navbar');  // Enable Bootstrap's fixed navbar

// Define which pages shouldn't have the sidebar
function roots_sidebar() {
  if (gt_get_option('default_layout') == 'no_sidebar' || is_404() || is_page_template('page-home.php') || is_page_template('page-full.php')) {
    return false;
  } else {
    return true;
  }
}

// #main CSS classes
function roots_main_class() {
  if (roots_sidebar()) {
    if (is_page_template('page-knowledge-base.php')) {
      echo 'span9';
    } else {
    echo 'span9';
    }
  } else {
    echo 'span12';
  }
}

// #sidebar CSS classes
function roots_sidebar_class() {
  echo 'span3';
}

$get_theme_name = explode('/themes/', get_template_directory());
define('GOOGLE_ANALYTICS_ID',       gt_get_option('analytics')); // UA-XXXXX-Y
define('POST_EXCERPT_LENGTH',       gt_get_option('post_excerpt'));
define('HOME_EXCERPT_LENGTH',       14);
define('WP_BASE',                   wp_base_dir());
define('THEME_NAME',                next($get_theme_name));
define('RELATIVE_PLUGIN_PATH',      str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH',     str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH',                RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);

// Set the content width based on the theme's design and stylesheet
if (!isset($content_width)) { $content_width = 940; }
