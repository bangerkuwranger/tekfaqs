<?php 

$options = get_option( PRESSAPPS_OPTIONS ); 

/*-----------------------------------------------------------------------------------*/
/* Live Search */
/*-----------------------------------------------------------------------------------*/

// live search form
function get_search_live() {
    locate_template('/templates/search-live.php', true, true);
}

if ($options['live_search_enable']) { 

	function pressapps_live_search() {

		$options = get_option( PRESSAPPS_OPTIONS ); 

	    global $wpdb;
	    
	    $post_status	=	'publish';
	    $search_term	=	"%".$_REQUEST['query']."%";

	    //$search_post_type = $options['live_search_post_type'];

	    $post_type = "'post'";
	    /*
		if ($search_post_type['page']) {
	    	$post_type		.=	",'page'"; 
	    } 
		if ($search_post_type['faq']) {
	    	$post_type		.=	",'faq'"; 
	    } 
		*/
		if ($options['live_search_in'] == '2') {
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
	add_action('wp_ajax_search_title', 'pressapps_live_search');  // hook for login users
	add_action('wp_ajax_nopriv_search_title', 'pressapps_live_search'); // hook for not login users

}

/*-----------------------------------------------------------------------------------*/
/* Google Fonts */
/*-----------------------------------------------------------------------------------*/

function options_typography_get_google_fonts() {
  // Google Font Defaults
  $google_faces = array(
    '0' => 'Select font',
    'Advent Pro, sans-serif' => 'Advent Pro', 
    'Averia Serif Libre, cursive' => 'Averia Serif Libre',
    'Exo, sans-serif' => 'Exo',
    'Josefin Slab, serif' => 'Josefin Slab', 
    'Lato, sans-serif' => 'Lato',
    'Merriweather, serif' => 'Merriweather',
    'Open Sans, sans-serif' => 'Open Sans',
    'Roboto, sans-serif' => 'Roboto',
    'Ubuntu, sans-serif' => 'Ubuntu',
  );
  return $google_faces;
}

if ( !function_exists( 'options_typography_google_fonts' ) ) {
  function options_typography_google_fonts() {
  
    $options = get_option( PRESSAPPS_OPTIONS );

	if ($options['body_typography_font'] != '0') {
		$font = $options['body_typography_font'];
		options_typography_enqueue_google_font($font);
	}
	if ($options['heading_typography_font'] != '0') {
		  $font = $options['heading_typography_font'];
		  options_typography_enqueue_google_font($font);
	}
	if ($options['navigation_typography_font'] != '0') {
		$font = $options['navigation_typography_font'];
		options_typography_enqueue_google_font($font);
	}

  }
}

add_action( 'wp_enqueue_scripts', 'options_typography_google_fonts' );

/**
 * Enqueues the Google $font that is passed
 */
 
function options_typography_enqueue_google_font($font) {
  $font = explode(',', $font);
  $font = $font[0];
  // Certain Google fonts need slight tweaks in order to load properly
  $font .= ':300,300italic,500,700';
    
  $font = str_replace(" ", "+", $font);
  wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}


/*-----------------------------------------------------------------------------------*/
/* Numeric Page Navi */
/*-----------------------------------------------------------------------------------*/

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
		
	echo $before.'<ul class="pagination pagination-lg">'."";
		
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
	echo '</ul>'.$after."";
}


/*-----------------------------------------------------------------------------------*/
/* Post Media */
/*-----------------------------------------------------------------------------------*/

function pressapps_post_media() {
  
	if (has_post_format('video')) {
		global $post;
		$video = get_post_meta( $post->ID, '_video', true );

		if ($video) {echo '<div class="featured-media"><div class="fitvids">' . $video . '</div></div>';}  
	}
	    	
	if(has_post_thumbnail() && has_post_format('image')) { ?>
		<div class="featured-media">
			<a class="blog-thumbnail" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('image_870x490'); ?>
				<?php
					global $post;
					$caption = '';
					$thumbnail_id    = get_post_thumbnail_id($post->ID);
					$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
					if ($thumbnail_image && isset($thumbnail_image[0])) {
						if ($thumbnail_image[0]->post_excerpt != '') {
							$caption = '<div class="featured-caption">'.$thumbnail_image[0]->post_excerpt.'</div>';
						}
					}
				?>
				<?php echo $caption; ?>
			</a>
		</div>
<?php } 

}

/*-----------------------------------------------------------------------------------*/
/* Add facebook, twitter, & google+ links to the user profile */
/*-----------------------------------------------------------------------------------*/

function pressapps_add_user_fields( $contactmethods ) {
	// Add Facebook
	$contactmethods['user_fb'] = 'Facebook';
	// Add Twitter
	$contactmethods['user_tw'] = 'Twitter';
	// Add Google+
	$contactmethods['google_profile'] = 'Google Profile URL';
	// Save 'Em
	return $contactmethods;
}
add_filter('user_contactmethods','pressapps_add_user_fields',10,1);

/*-----------------------------------------------------------------------------------*/
/* Unused WP functions */
/*-----------------------------------------------------------------------------------*/

function dead_function() {
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	comment_form();
}

/*-----------------------------------------------------------------------------------*/
/* Option Favicon */
/*-----------------------------------------------------------------------------------*/

function theme_favicon() {
  $options = get_option( PRESSAPPS_OPTIONS );
  if( $options['favicon']) {
      echo '<link rel="shortcut icon" href="' . $options['favicon'] . '">';
  }
}

/*-----------------------------------------------------------------------------------*/
/* Hero background */
/*-----------------------------------------------------------------------------------*/

function hero_background(){

	global $post;
	$hero_image = get_post_meta( $post->ID, '_hero_image', true );

      if ($hero_image) {
        echo '
          <script>
            jQuery(document).ready(function ($) {

                $("#hero").backstretch("' . $hero_image . '");
            });
          </script>';

      }

} 


/*-----------------------------------------------------------------------------------*/
/* Post format icons */
/*-----------------------------------------------------------------------------------*/

function post_icon() {
    if (get_post_format() == 'video') {
        return 'icon-film';
    } elseif (get_post_format() == 'image') {
        return 'icon-picture';
    } else {
        return 'icon-file-text-alt';
    }
}


/*-----------------------------------------------------------------------------------*/
/* Post excerpts & More */
/*-----------------------------------------------------------------------------------*/

define('POST_EXCERPT_LENGTH', $options['post_excerpt_length']);

function post_excerpt_length($length) {
  return POST_EXCERPT_LENGTH;
}

function pressapps_excerpt_more($more) {
  return ' <a class="blog-more btn btn-xxs btn-primary" href="' . get_permalink() . '">' . __('Read more', PRESSAPPS_TEXT_DOMAIN ) . '</a>';
}

add_filter('excerpt_length', 'post_excerpt_length');
add_filter('excerpt_more', 'pressapps_excerpt_more');

function pressapps_post_content() {

	$options = get_option( PRESSAPPS_OPTIONS );
	
	if( $options['post_excerpt'] == 2) {
		the_excerpt();
	} else {
		the_content('<button class="blog-more btn btn-xxs btn-primary">' . __('Read more', PRESSAPPS_TEXT_DOMAIN ) . '</button>');
	}
}

/*-----------------------------------------------------------------------------------*/
/* Home page template post excerpts */
/*-----------------------------------------------------------------------------------*/

function roots_home_excerpt_length($length) {
  return HOME_EXCERPT_LENGTH;
}
define('HOME_EXCERPT_LENGTH',       12);

