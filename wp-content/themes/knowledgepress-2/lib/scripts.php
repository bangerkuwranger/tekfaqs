<?php

/**
 * Enqueue scripts and stylesheets
 */

$options = get_option( PRESSAPPS_OPTIONS ); 

function roots_scripts() {

  $options = get_option( PRESSAPPS_OPTIONS ); 

  wp_enqueue_style('roots_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', false, null);
  wp_enqueue_style('roots_app', get_template_directory_uri() . '/assets/css/app.css', false, null);

  if (!is_admin()) {
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '3.0', 'all' );
  }
  // Load style.css from child theme
  if (is_child_theme()) {
    wp_enqueue_style('roots_child', get_stylesheet_uri(), false, null);
  }
  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js', false, null, false);
  wp_register_script('roots_plugins', get_template_directory_uri() . '/assets/js/plugins.js', false, null, true);
  wp_register_script('roots_main', get_template_directory_uri() . '/assets/js/main.js', false, null, true);
  wp_enqueue_script('modernizr');
  wp_enqueue_script("jquery");
  wp_enqueue_script('roots_plugins');
  wp_enqueue_script('roots_main');

  wp_register_script('fitvids', get_template_directory_uri().'/assets/js/vendor/jquery.fitvids.min.js', false, '1.0', false);
  wp_register_script('backstretch', get_template_directory_uri() . '/assets/js/vendor/jquery.backstretch.min.js', false, null, true);
  wp_enqueue_script('fitvids');
  wp_enqueue_script('backstretch');
  

  if ( $options['live_search_enable'] ) { 
    wp_register_script('live_search', get_template_directory_uri().'/assets/js/vendor/jquery.autocomplete.js');
    wp_register_script('live_search_plugin', get_template_directory_uri().'/assets/js/vendor/autocomplete-plugin.js');
    wp_enqueue_script('live_search');
    wp_enqueue_script('live_search_plugin');
  }

}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

/**
 * Google analytics script
 */
function roots_google_analytics() { 
  $options = get_option( PRESSAPPS_OPTIONS ); 
?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo $options['analytics']; ?>');ga('send','pageview');
</script>

<?php }
if ($options['analytics']) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}
