<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/bootstrap.css
 * 2. /theme/assets/css/bootstrap-responsive.css
 * 3. /theme/assets/css/app.css
 * 4. /child-theme/style.css (if a child theme is activated)
 *
 * Enqueue scripts in the following order:
 * 1. /theme/assets/js/vendor/modernizr-2.6.2.min.js  (in head.php)
 * 2. jquery-1.8.1.min.js via Google CDN              (in head.php)
 * 3. /theme/assets/js/plugins.js
 * 4. /theme/assets/js/main.js
 */

function roots_scripts() {
  wp_enqueue_style('roots_bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css', false, null);
  wp_enqueue_style('roots_bootstrap_responsive', get_stylesheet_directory_uri() . '/assets/css/bootstrap-responsive.css', array('roots_bootstrap'), null);
  wp_enqueue_style('roots_app', get_stylesheet_directory_uri() . '/assets/css/app.css', false, null);
  wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css', array(), '1.0', 'all' );

  // Load style.css from child theme
  if (is_child_theme()) {
    wp_enqueue_style('roots_child', get_stylesheet_uri(), false, null);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('roots_plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.js', false, null, false);
  wp_register_script('roots_main', get_stylesheet_directory_uri() . '/assets/js/main.js', false, null, false);
  wp_enqueue_script('roots_plugins');
  wp_enqueue_script('roots_main');
  
  // Custom Scripts
  wp_register_script('superfish', get_stylesheet_directory_uri().'/assets/js/vendor/jquery.superfish.js');
  wp_register_script( 'prettify', get_stylesheet_directory_uri() . '/assets/js/vendor/prettify.js', 'jquery' );
  wp_register_script('fitvids', get_stylesheet_directory_uri().'/assets/js/vendor/jquery.fitvids.js');

  wp_enqueue_script('superfish');
  wp_enqueue_script( 'prettify' );
  wp_enqueue_script('fitvids');

  if (gt_get_option('live_search_enable')) { 
    wp_register_script('live_search', get_stylesheet_directory_uri().'/assets/js/vendor/jquery.autocomplete.js');
    wp_register_script('live_search_plugin', get_stylesheet_directory_uri().'/assets/js/vendor/autocomplete-plugin.js');
    wp_enqueue_script('live_search');
    wp_enqueue_script('live_search_plugin');
  }

}

add_action('wp_enqueue_scripts', 'roots_scripts', 100);

