<?php
/*-----------------------------------------------------------------------------------*/
/* Framework Option Styles */
/*-----------------------------------------------------------------------------------*/

function option_styles() {

	$options = get_option( PRESSAPPS_OPTIONS );
	
	$theme_options_styles = '';

      $body_typography_font = $options['body_typography_font'];
      if ($body_typography_font) {
        $theme_options_styles .= '
        body { 
          font-family: ' . $body_typography_font . '; 
        }';
      }

      $body_typography_size = $options['body_typography_size'];
      if ($body_typography_size) {
        $theme_options_styles .= '
        body { 
          font-size: ' . $body_typography_size . '; 
        }';
      }

      $navigation_typography_font = $options['navigation_typography_font'];
      if ($navigation_typography_font) {
        $theme_options_styles .= '
        .banner .navbar-inner, .banner .navbar-inner .btn { 
          font-family: ' . $navigation_typography_font . '; 
        }';
      }

      $nav_typography_size = $options['nav_typography_size'];
      if ($nav_typography_size) {
        $theme_options_styles .= '
        .banner .navbar-inner, .banner .navbar-inner .btn, .banner .navbar-inner label {
          font-size: ' . $nav_typography_size . '; 
        }';
      }

     $heading_typography_font = $options['heading_typography_font'];
      if ($heading_typography_font) {
        $theme_options_styles .= '
        h1, h2, h3, h4, h5, h6 { 
          font-family: ' . $heading_typography_font . '; 
        }';
      }

      // theme color
      $theme_color = $options['theme_color'];
      if ($theme_color) {
        $theme_options_styles .= '
        a, a:hover {
          color: ' . $theme_color . ';
        }
        .entry-title i,
        .author-links i,
        .sidebar .crpw-item i,
        .sidebar .pressapps_tweet_widget i,
        .box-video-list i,
        .autocomplete-suggestions h4 > strong {
          color: ' . $theme_color . ';
        }
        #bbpress-forums li.bbp-header, #bbpress-forums fieldset.bbp-form legend, #bbpress-forums button.submit, .bbp-breadcrumb {
           background-color: ' . $theme_color . ';
        }
        .faq .faq-close span, .faq .faq-open span {
           background-color: ' . $theme_color . '!important;
        }
        .btn-primary, .btn-primary:hover {
           background-color: ' . $theme_color . ';
           border-color: ' . $theme_color . ';
        }
        .pagination >li>a:hover, .pagination >li>a:focus, .pagination >.active>a, .pagination >.active>span,
        .loop-comments,
        .sidebar .crpw-item:hover, .sidebar .widget_nav_menu li:hover,
        .label-primary {
          background-color: ' . $theme_color . ';
        }';
      }

      // navigation dropdown hover background color 
      $dropdown_hover_color = $options['dropdown_hover_color'];
      if ($dropdown_hover_color) {
        $theme_options_styles .= '
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus, .dropdown-menu>li>a:hover,
        .navbar-nav>.active>a, .navbar-nav>.active>a:hover, .navbar-nav>.active>a:focus, .navbar-nav>li>a:hover { 
          background: ' . $dropdown_hover_color . '; 
        }';
      }

      // banner bbackground color 
      $banner_bg_color = $options['banner_bg_color'];
      if ($banner_bg_color) {
        $theme_options_styles .= '
        .banner {
          background-color: ' . $banner_bg_color . ';
        }
        .navbar-nav .dropdown-menu {
          background-color: ' . $banner_bg_color . ';
        }';
      }
      
      // banner bbackground color 
      $main_header_bg_color = $options['main_header_bg_color'];
      if ($main_header_bg_color) {
        $theme_options_styles .= '
        .main-header {
          background-color: ' . $main_header_bg_color . ';
        }';
      }

      // body bbackground color 
      $body_bg_color = $options['body_bg_color'];
      if ($body_bg_color) {
        $theme_options_styles .= '
        body { 
          background-color: ' . $body_bg_color . ';
        }';
      }

      // home page template specific styles
      if ( is_page_template('template-home.php') || is_page_template('template-home2.php') ) {

        global $post;

        // hero background
        $hero_background_color = get_post_meta( $post->ID, '_hero_background_color', true );
        if ($hero_background_color) {
          $theme_options_styles .= '
          #hero { 
            background-color: ' . $hero_background_color . '; 
          }';
        }

        // hero height due to boxes
        $boxes = get_post_meta( $post->ID, '_boxes', true );
        if ($boxes) {
          $theme_options_styles .= '
          .page-template-template-home2-php #hero { 
            padding-bottom: 190px; 
          }';
        }

        // icon left background
        $box_icon_color_left = get_post_meta( $post->ID, '_box_icon_color_left', true );
        if ($box_icon_color_left) {
          $theme_options_styles .= '
          .box-left .circle { 
            background-color: ' . $box_icon_color_left . '; 
          }';
        }

        // icon middle background
        $box_icon_color_middle = get_post_meta( $post->ID, '_box_icon_color_middle', true );
        if ($box_icon_color_middle) {
          $theme_options_styles .= '
          .box-middle .circle { 
            background-color: ' . $box_icon_color_middle . '; 
          }';
        }

        // icon right background
        $box_icon_color_right = get_post_meta( $post->ID, '_box_icon_color_right', true );
        if ($box_icon_color_right) {
          $theme_options_styles .= '
          .box-right .circle { 
            background-color: ' . $box_icon_color_right . '; 
          }';
        }

        // featured right background
        $featured_background_color = get_post_meta( $post->ID, '_featured_background_color', true );
        if ($featured_background_color) {
          $theme_options_styles .= '
          .page-template-template-home2-php #home-featured { 
            background-color: ' . $featured_background_color . '; 
          }';
        }

        // video player background image
        $video_player_image = get_post_meta( $post->ID, '_video_player_image', true );
        if ($video_player_image) {
          $theme_options_styles .= '
          .box-video { 
            background-image:url("' . $video_player_image . '"); 
          }';
        }

      }

      // footer bbackground color 
      $footer_bg_color = $options['footer_bg_color'];
      if ($footer_bg_color) {
        $theme_options_styles .= '
        .footer-widgets { 
          background-color: ' . $footer_bg_color . ';
        }';
      }

      // sidebar layout 
      $theme_layout = $options['theme_layout'];
      if ($theme_layout == 2) {
        $theme_options_styles .= '
        .main{ 
          float: right !important; 
        }
        @media (max-width: 767px) {
          .main {
          float:none !important;
          margin-left:0;
          }
        }';
      }
	      
      // custom css 
      $custom_css = $options['custom_css'];
      if( $custom_css ){
        $theme_options_styles .= '
        ' . $custom_css;
      }
          
      if($theme_options_styles){
        echo '<style>' 
        . $theme_options_styles . '
        </style>';
      }
    
} // end option_styles function

/*-----------------------------------------------------------------------------------*/
/* Os Fonts */
/*-----------------------------------------------------------------------------------*/

function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Cambria, Georgia, serif' => 'Cambria',
		'Garamond, serif' => 'Garamond',
		'Georgia, serif' => 'Georgia',
		'' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma',
    'Verdana, Geneva, sans-serif' => 'Verdana',
	);
	return $os_faces;
}

