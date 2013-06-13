<?php
// Footer text function
function copyright_text_function() {
	if (gt_get_option('copyright')) {
		echo '<div class="copyright-text">' . gt_get_option('copyright') . '</div>'; 
	}
}

// Favicon function
function favicon_function() {
    if( gt_get_option('favicon'))
        echo '<link rel="shortcut icon" href="' . gt_get_option('favicon') . '">';
}

// Social icons
function social_icons() {
  get_template_part('templates/social', 'icons');
}

// Add thumbnail class to thumbnail links
/*
function add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a rel="prettyPhoto[pp_gal]" class="thumbnail"',$html);
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);
*/
// Option Styles
function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif' => 'Arial',
		'"Avant Garde", sans-serif' => 'Avant Garde',
		'Cambria, Georgia, serif' => 'Cambria',
		'Copse, sans-serif' => 'Copse',
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
		'Georgia, serif' => 'Georgia',
		'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma'
	);
	return $os_faces;
}

function options_typography_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
  //  'Archivo Black, sans-serif' => 'Archivo Black',
		'Arvo, serif' => 'Arvo',
		'Copse, sans-serif' => 'Copse',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Droid Serif, serif' => 'Droid Serif',
    'Montserrat, sans-serif' => 'Montserrat',
		'Nobile, sans-serif' => 'Nobile',
		'Open Sans, sans-serif' => 'Open Sans',
		'Oswald, sans-serif' => 'Oswald',
    'Raleway, sans-serif' => 'Raleway',  
		'Rokkitt, serif' => 'Rokkit',
		'PT Sans, sans-serif' => 'PT Sans',
		'Quattrocento, serif' => 'Quattrocento',
		'Ubuntu, sans-serif' => 'Ubuntu',
		'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz'
	);
	return $google_faces;
}


if ( !function_exists( 'options_typography_google_fonts' ) ) {
	function options_typography_google_fonts() {
		$all_google_fonts = array_keys( options_typography_get_google_fonts() );
		$google_mixed = gt_get_option('heading_typography', false);
		$google_mixed_2 = gt_get_option('top_nav_link', 'Arvo, serif');
		$selected_fonts = array(
			$google_mixed['face'],
			$google_mixed_2['face'] );
		$selected_fonts = array_unique($selected_fonts);
		// Check each of the unique fonts against the defined Google fonts
		// If it is a Google font, go ahead and call the function to enqueue it
		foreach ( $selected_fonts as $font ) {
			if ( in_array( $font, $all_google_fonts ) ) {
				options_typography_enqueue_google_font($font);
			}
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
	// Like our friend "Raleway"
	if ( $font == 'Raleway' )
		$font = 'Raleway:300';
	if ( $font == 'Oswald' )
		$font = 'Oswald:300';
	$font = str_replace(" ", "+", $font);
	wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

// Get theme options
function theme_style_options(){
  $theme_options_styles = '';

      $theme_color = gt_get_option('theme_color');
      if ($theme_color) {
        $theme_options_styles .= '
        a, #menu > .active > a, #menu > li > a:hover {
          color: ' . $theme_color . '; 
        }
        .faq-page article h3, .knowledge-index h2 a:hover {
          color: ' . $theme_color . '; 
        }
        #sidebar i, #main article h2 i, .author-links i, #footer-container i, .recent-posts i, .box-video-links i, .autocomplete-suggestions strong {
          color: ' . $theme_color . '; 
        }
        #menu ul a:hover, .label-color, #sidebar .widget li:hover, .loop-like .label-likes {
          background-color: ' . $theme_color . '; 
        }
        #page-header-container {
          background-color: ' . $theme_color . '; 
        }
        .btn-custom {
          background-color: ' . $theme_color . '!important; 
        }
        .pagination ul > li > a:hover, .pagination ul > .active > a, .pagination ul > .active > span {
          background-color: ' . $theme_color . '; 
        }';
      }

      $hero_image = gt_get_option('hero_image');
      if ($hero_image) {
        $theme_options_styles .= '
        #hero-image{ 
          background-image: url('. $hero_image .');
        }
        .box {
          background-color: rgba(0, 0, 0, 0.45);
        }';
      } else {
        $theme_options_styles .= '
        #hero-image {
          background-color: ' . $theme_color . '; 
        }';
      }

      $heading_typography = gt_get_option('heading_typography');
      if ($heading_typography) {
        $theme_options_styles .= '
        h1, h2, h3, h4, h5, h6, .hero-unit p, .hero-unit h1 { 
          font-family: ' . $heading_typography['face'] . '; 
        }';
      }
      
      $topbar_link = gt_get_option('top_nav_link');
      if ($topbar_link) {
        $theme_options_styles .= '
        #menu a { 
          font-family: ' . $topbar_link['face'] . '; 
          font-size: ' . $topbar_link['size'] . '; 
        }';
      }
      
      $main_body_typography = gt_get_option('main_body_typography');
      if ($main_body_typography) {
        $theme_options_styles .= '
        body{ 
          font-family: ' . $main_body_typography['face'] . '; 
          font-size: ' . $main_body_typography['size'] . '; 
          color: ' . $main_body_typography['color'] . '; 
        }
        i, .knowledge-base li a, .knowledge-base li a:hover, .faq-top h4 a, .faq-top h4 a:hover { 
          color: ' . $main_body_typography['color'] . '; 
        }';
      }
      
      $suppress_comments_message = gt_get_option('suppress_comments_message');
      if ($suppress_comments_message){
        $theme_options_styles .= '
        #main article {
          border-bottom: none;
        }';
      }

      $video_image = gt_get_option('video_image');
      if ($video_image) {
        $theme_options_styles .= '
        .box-video{ 
          background-image: url('. $video_image .');
        }';
      }

      $default_layout = gt_get_option('default_layout');
      if ($default_layout == 'left_sidebar') {
        $theme_options_styles .= '
        #main{ 
          float: right !important; 
        }';
      }

      $additional_css = gt_get_option('wpbs_css');
      if( $additional_css ){
        $theme_options_styles .= $additional_css;
      }
          
      if($theme_options_styles){
        echo '<style>' 
        . $theme_options_styles . '
        </style>';
      }
    
} // end theme_style_options function
?>