<?php

// Custom functions
/**
 * Add the RSS feed link in the <head> if there's posts
 */
function roots_feed_link() {
  $count = wp_count_posts('post'); if ($count->publish > 0) {
    echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
  }
}

add_action('wp_head', 'roots_feed_link', -2);

/**
 * Add the asynchronous Google Analytics snippet from HTML5 Boilerplate
 * if an ID is defined in config.php
 *
 * @link mathiasbynens.be/notes/async-analytics-snippet
 */
 
function gt_google_analytics() { ?>
<script>
  var _gaq=[['_setAccount','<?php echo GOOGLE_ANALYTICS_ID; ?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php }
if (GOOGLE_ANALYTICS_ID) {
  add_action('wp_footer', 'gt_google_analytics', 20);
}

// adding facebook, twitter, & google+ links to the user profile
function bones_add_user_fields( $contactmethods ) {
	// Add Facebook
	$contactmethods['user_fb'] = 'Facebook';
	// Add Twitter
	$contactmethods['user_tw'] = 'Twitter';
	// Add Google+
	$contactmethods['google_profile'] = 'Google Profile URL';
	// Save 'Em
	return $contactmethods;
}
add_filter('user_contactmethods','bones_add_user_fields',10,1);

// Numeric Page Navi (built into the theme by default)
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<div class="pagination"><ul class="clearfix">'."";
		
	$prevposts = get_previous_posts_link('&larr; Previous');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next &rarr;');
	echo '</li>';
	echo '</ul></div>'.$after."";
}

// live search
function get_search_live() {
    locate_template('/templates/search-live.php', true, true);
}
// live search end

// hero live search
function get_hero_search_live() {
    locate_template('/templates/search-hero-live.php', true, true);
}
// hero live search end

/**
 * Live search
 */

if (gt_get_option('live_search_enable')) { 

	function gt_live_search() {
	    global $wpdb;
	    
	    $post_status	=	'publish';
	    $search_term	=	"%".$_REQUEST['query']."%";

	    $search_post_type = gt_get_option('live_search_post_type');

	    $post_type = "'post'";

		if ($search_post_type['page']) {
	    	$post_type		.=	",'page'"; 
	    } 
		if ($search_post_type['faq']) {
	    	$post_type		.=	",'faq'"; 
	    } 

		if (gt_get_option('live_search_in') == '2') {
			$sql_query = $wpdb->prepare( "SELECT ID, post_title, SUBSTRING(post_content,1,100) as post_content, post_name from $wpdb->posts where post_status = %s and post_type in ( $post_type )and (post_title like %s or post_content like %s)", $post_status, $search_term, $search_term );
	    } else {
			$sql_query = $wpdb->prepare( "SELECT ID, post_title, SUBSTRING(post_content,1,100) as post_content, post_name from $wpdb->posts where post_status = %s and post_type in ( $post_type )and post_title like %s", $post_status, $search_term );
	    }
		
		$results = $wpdb->get_results($sql_query);
		
		$search_json = array( "query" => "Unit", "suggestions" => array() );   // create a json array
		
		foreach ( $results as $result ) {
			$link	=	get_permalink( $result->ID ); // get post url
			
			$search_json["suggestions"][] = array(
													"value" => $result->post_title,
													"data"  => array( "content" => $result->post_content, "url" => $link )
											);
		}
		echo json_encode($search_json); // conver array to joson string
		die();
	}
	add_action('wp_ajax_search_title', 'gt_live_search');  // hook for login users
	add_action('wp_ajax_nopriv_search_title', 'gt_live_search'); // hook for not login users

}