<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function guerillaframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$the_theme = wp_get_theme();
	$themename = $the_theme->Name;
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$guerillaframework_settings = get_option('guerillaframework');
	$guerillaframework_settings['id'] = $themename;
	update_option('guerillaframework', $guerillaframework_settings);
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function guerillaframework_options() {

	//print_r($theList);

	// icons select
	$options_icons = array( 'beaker' => 'Beaker',
							'book'	=> 'Book',
							'camera'=> 'Camera',
							'check'	=> 'Check',
							'cloud'	=> 'Cloud',
							'cogs'	=> 'Cogs',
							'desktop' => 'Desktop',
							'download'	=> 'Download',
							'download-alt' => 'Download to Disk',
							'envelope'	=> 'Envelope',
							'facebook'	=> 'Facebook',
							'file-alt'	=> 'File',
							'film'	=> 'Film',
							'flag'	=> 'Flag',
							'folder-close'	=> 'Folder Close',
							'folder-open'	=> 'Folder Open',
							'gift' => 'Gift Package',
							'hdd' => 'Hard Drive',
							'heart-empty'	=> 'Heart',
							'leaf'	=> 'Leaf',
							'lightbulb'	=> 'Lightbulb',
							'medkit'	=> 'Medkit',
							'ok'	=> 'Ok',
							'pencil'	=> 'Pencil',
							'picture'	=> 'Picture',
							'phone'	=> 'Phone',
							'play'	=> 'Play',
							'play-circle'	=> 'Play Circle',
							'plus'	=> 'Plus',
							'question-sign'	=> 'Question Sign',
							'save' => 'Save - Disk',
							'star'	=> 'Star',
							'star-empty'	=> 'Star Empty',
							'suitcase'	=> 'Suitcase',
							'tag'	=> 'Tag',
							'thumbs-up'	=> 'Thumbs Up',
							'truck'	=> 'Truck',
							'twitter'	=> 'Twitter',
							'upload-alt'	=> 'Upload',
							'user'	=> 'User',
							'wrench'	=> 'Wrench',
							);
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
	$options_categories[''] = 'Select a category';
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the posts into an array
	$options_posts = array();  
	$args_posts = array( 'numberposts' => 99999, 'order'=> 'ASC', 'orderby' => 'title' );
	$options_posts_obj = get_posts($args_posts);
	$options_posts[''] = 'Select a post';
	foreach ($options_posts_obj as $post) {
    	$options_posts[$post->ID] = $post->post_title;
	}
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages();
	$options_pages[''] = 'Select a page';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	//$imagepath =  get_stylesheet_directory_uri() . '/options/images/';
	$imagepath =  get_template_directory_uri() . '/options/images/';

	$options = array();
	
	$options[] = array( 'name' => __('General', 'guerilla'),
						'title' => __("General Settings", 'guerilla'),
					//	'desc' => __("Subheading Style settings", 'guerilla'),
						'type' => 'heading');
		
	$options[] = array(	'name' => __('Content Layout', 'guerilla'),
						'desc' => __('Select main content and sidebar alignment.', 'guerilla'),
						'id' => 'default_layout',
						'std' => 'left_sidebar',
						'type' => 'images',
						'options' => array(
							'left_sidebar' => $imagepath . 'layouts/left_sidebar.gif',
							'right_sidebar' => $imagepath . 'layouts/right_sidebar.gif',
							'no_sidebar' => $imagepath . 'layouts/no_sidebar.gif')
						);

	$options[] = array(	'name' => __('Logo Upload', 'guerilla'),
						'desc' => __('Upload custom logo image', 'guerilla'),
						'id' => 'logo_image',
						'type' => 'upload');

	$options[] = array(	'name' => __('Favicon Upload', 'guerilla'),
						'desc' => __('Upload custom favicon image', 'guerilla'),
						'id' => 'favicon',
						'type' => 'upload');

	$options[] = array(	'name' => __('Header Title', 'guerilla'),
						'desc' => __("Enter header tagline.", 'guerilla'),
						'id' => 'header_title',
						'std' => 'Support Center',
						'type' => 'text');
						
	$options[] = array(	'name' => __('Header Tagline', 'guerilla'),
						'desc' => __("Enter header tagline (Shown on all pages excet 'Home' page template).", 'guerilla'),
						'id' => 'header_tagline',
						'std' => 'Find answers and help fast',
						'type' => 'text');
						
	$options[] = array(	'name' => __('Search Bar', 'guerilla'),
						'desc' => __('Add search bar to header.', 'guerilla'),
						'id' => 'search_bar',
						'std' => '1',
						'type' => 'checkbox');
						
	$options[] = array(	'name' => __('Shortcodes', 'guerilla'),
						'desc' => __('Enable theme shortcodes', 'guerilla'),
						'id' => 'shortcodes_enable',
						'std' => '1',
						'type' => 'checkbox');
						
	$options[] = array(	'name' => __('Google Analytics Code', 'guerilla'),
						'desc' => __("Enter Google analytics code (ie 'UA-24189019-1').", 'guerilla'),
						'id' => 'analytics',
						'std' => '',
						'type' => 'text');
						
	$options[] = array(	'name' => __('Copyright', 'guerilla'),
						'desc' => __('Enter your footer copyright information.', 'guerilla'),
						'id' => 'copyright',
						'std' => "Copyright 2012. Powered by <a href='http://wordpress.org/'>WordPress</a>",
						'type' => 'textarea');

	$options[] = array( 'name' => __('CSS Code', 'guerilla'),
						'desc' => __('Custom CSS code', 'guerilla'),
						'id' => 'wpbs_css',
						'std' => '',
						'type' => 'textarea');

	$options[] = array( 'name' => __('Live Search', 'guerilla'),
						'title' => __("Live Search Settings", 'guerilla'),
						'type' => 'heading');

	$options[] = array(	'name' => __('Enable Live Search', 'guerilla'),
						'desc' => __('Enable live search.', 'guerilla'),
						'id' => 'live_search_enable',
						'std' => '1',
						'type' => 'checkbox');

		$search_post_type_array = array(
							'page' => __('Pages', 'guerilla'),
							'faq' => __('Faq', 'guerilla'));

		$search_post_type_defaults = array(
							'page' => '1',
							'faq' => '1');

	$options[] = array(	'name' => __('Search Post Types', 'guerilla'),
						'desc' => __('Enable live search in pages and faq posts (post search is enabled by default).', 'guerilla'),
						'id' => 'live_search_post_type',
						'std' => $search_post_type_defaults, 
						'type' => 'multicheck',
						'options' => $search_post_type_array);

		$search_in_array = array(
							'1' => __('Title', 'guerilla'),
							'2' => __('Title and Content', 'guerilla'));

	$options[] = array(	'name' => __('Search In', 'guerilla'),
						'desc' => __('Search for keyword in title and post/page content.', 'guerilla'),
						'id' => 'live_search_in',
						'std' => '1',
						'type' => 'radio',
						'options' => $search_in_array);

	$options[] = array( 'name' => __('Style', 'guerilla'),
						'title' => __("Style", 'guerilla'),
						'desc' => __("Color and typography settings", 'guerilla'),
						'type' => 'heading');
						
	$options[] = array(	'name' => __('Theme Color', 'guerilla'),
						'desc' => __('Select theme color', 'guerilla'),
						'id' => 'theme_color',
						'std' => '53B2D5',
						'type' => 'color',
						);

	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);
	
	// Available Options for Header Fonts
	$typography_options_headers = array(
		'faces' => $typography_mixed_fonts,
		'styles' => false, 
		'color'	=> true,
		'sizes' => false, 
	);
	
	// Available Options for Navigation Fonts
	$typography_options_navigation = array(
		'faces' => $typography_mixed_fonts,
		'styles' => false,
		'color'	=> true,
		'sizes' => array( '10','11','12','13','14','15','16','17','18','19','20') 
	);

	// Available Options for Body Font
	$typography_options_body = array(
		'sizes' => array( '10','11','12','13','14','15','16','17' ),
		'faces' => options_typography_get_os_fonts(),
		'styles' => false
	);
						
	$options[] = array( 'name' => __('Main Body Text', 'guerilla'),
						'desc' => __('Used in P tags.', 'guerilla'),
						'id' => 'main_body_typography',
						'std' => array('face' => '"Tekvetica", "Helvetica Neue LT Com", Helvetica Neue, Helvetica, sans-serif','size' => '15px','color' => '#004a72	'),
						'type' => 'typography',
						'options' => $typography_options_body );
						
	$options[] = array( 'name' => __('Navigation', 'guerilla'),
						'desc' => __('Main navigation.', 'guerilla'),
						'id' => 'top_nav_link',
						'std' => array('face' => '"Tekvetica", "Helvetica Neue LT Com", Helvetica Neue, Helvetica, sans-serif','size' => '16px'),
						'type' => 'typography',
						'options' => $typography_options_navigation );
						
	$options[] = array( 'name' => __('Headings', 'guerilla'),
						'desc' => __('Used in H1, H2, H3, H4, H5 & H6 tags.', 'guerilla'),
						'id' => 'heading_typography',
						'std' => array('face' => '"Tekvetica", "Helvetica Neue LT Com", Helvetica Neue, Helvetica, sans-serif'),
						'type' => 'typography',
						'options' => $typography_options_headers );

	$options[] = array( 'name' => __('Home', 'guerilla'),
						'title' => __("Hero", 'guerilla'),
						'desc' => __("Hero image settings", 'guerilla'),						
						'type' => 'heading');
						
	$options[] = array(	'name' => __('Hero Image Upload', 'guerilla'),
						'desc' => __('Upload home page hero image', 'guerilla'),
						'id' => 'hero_image',
						'type' => 'upload');

	$options[] = array( 'name' => __("Left Box", 'guerilla'),
						'desc' => __("Settings for left link box.", 'guerilla'),
						'type' => 'title');
						
	$options[] = array(	'name' => __('Icon', 'guerilla'),
						'desc' => __('Select box icon.', 'guerilla'),
						'id' => 'box_1_icon',
						'std' => 'file',
						'type' => 'select',
						'options' => $options_icons);
		
	$options[] = array(	'name' => __('Page Title & Link', 'guerilla'),
						'desc' => __('Select page linked to the left box.', 'guerilla'),
						'id' => 'box_1_link',
						'type' => 'select',
						'options' => $options_pages);
		
	$options[] = array(	'name' => __('Description', 'guerilla'),
						'desc' => __("Enter description for the left box.", 'guerilla'),
						'id' => 'box_1_text',
						'std' => '',
						'type' => 'textarea');
						
	$options[] = array( 'name' => __("Middle Box", 'guerilla'),
						'desc' => __("Settings for middle link box.", 'guerilla'),
						'type' => 'title');
						
	$options[] = array(	'name' => __('Icon', 'guerilla'),
						'desc' => __('Select box icon.', 'guerilla'),
						'id' => 'box_2_icon',
						'std' => 'check',
						'type' => 'select',
						'options' => $options_icons);
		
	$options[] = array(	'name' => __('Page Title & Link', 'guerilla'),
						'desc' => __('Select page linked to the middle box.', 'guerilla'),
						'id' => 'box_2_link',
						'type' => 'select',
						'options' => $options_pages);
		
	$options[] = array(	'name' => __('Description', 'guerilla'),
						'desc' => __("Enter description for the middle box.", 'guerilla'),
						'id' => 'box_2_text',
						'std' => '',
						'type' => 'textarea');
						
	$options[] = array( 'name' => __("Right Box", 'guerilla'),
						'desc' => __("Settings for right link box.", 'guerilla'),
						'type' => 'title');
						
	$options[] = array(	'name' => __('Icon', 'guerilla'),
						'desc' => __('Select box icon.', 'guerilla'),
						'id' => 'box_3_icon',
						'std' => 'envelope',
						'type' => 'select',
						'options' => $options_icons);
		
	$options[] = array(	'name' => __('Page Title & Link', 'guerilla'),
						'desc' => __('Select page linked to the right box.', 'guerilla'),
						'id' => 'box_3_link',
						'type' => 'select',
						'options' => $options_pages);
		
	$options[] = array(	'name' => __('Description', 'guerilla'),
						'desc' => __("Enter description for the right box.", 'guerilla'),
						'id' => 'box_3_text',
						'std' => '',
						'type' => 'textarea');
						
	$options[] = array( 'name' => __("Featured Articles", 'guerilla'),
						'desc' => __("Settings for featured articles.", 'guerilla'),
						'type' => 'title');
						
	$options[] = array(	'name' => __('Featured Title', 'guerilla'),
						'desc' => __("Enter featured section title", 'guerilla'),
						'id' => 'featured_title',
						'std' => 'Most popular subjects customers ask about frequently.',
						'type' => 'text');

	$options[] = array(	'name' => __('Featured Article 1', 'guerilla'),
						'desc' => __('Select featured post 1.', 'guerilla'),
						'id' => 'featured_article_1',
						'type' => 'select',
						'options' => $options_posts);
		
	$options[] = array(	'name' => __('Featured Article 2', 'guerilla'),
						'desc' => __('Select featured post 2.', 'guerilla'),
						'id' => 'featured_article_2',
						'type' => 'select',
						'options' => $options_posts);
		
	$options[] = array(	'name' => __('Featured Article 3', 'guerilla'),
						'desc' => __('Select featured post 3.', 'guerilla'),
						'id' => 'featured_article_3',
						'type' => 'select',
						'options' => $options_posts);
		
	$options[] = array(	'name' => __('Featured Article 4', 'guerilla'),
						'desc' => __('Select featured post 4.', 'guerilla'),
						'id' => 'featured_article_4',
						'type' => 'select',
						'options' => $options_posts);
		
	$options[] = array( 'name' => __("Video Section", 'guerilla'),
						'desc' => __("Settings for video section.", 'guerilla'),
						'type' => 'title');
						
	$options[] = array(	'name' => __('Video Section Title', 'guerilla'),
						'desc' => __("Enter video section title", 'guerilla'),
						'id' => 'video_title',
						'std' => 'Getting started tutorial videos.',
						'type' => 'text');

	$options[] = array(	'name' => __('Select Video Category', 'guerilla'),
						'desc' => __('Select post category used for video section on home page', 'guerilla'),
						'id' => 'category_video',
						'type' => 'select',
						'options' => $options_categories);
		
	$options[] = array(	'name' => __('Video Player Link', 'guerilla'),
						'desc' => __('Select video post linked to the video player.', 'guerilla'),
						'id' => 'video_link',
						'type' => 'select',
						'options' => $options_posts);
		
	$options[] = array(	'name' => __('Video Image Upload', 'guerilla'),
						'desc' => __('Upload background image for the video box.', 'guerilla'),
						'id' => 'video_image',
						'type' => 'upload');

	$options[] = array( 'name' => __('Knowledge Base', 'guerilla'),
						'title' => __("Knowledge Base", 'guerilla'),
						'desc' => __("Knowledge base article settings", 'guerilla'),						
						'type' => 'heading');
						
	$options[] = array(	'name' => __('Articles Per Category', 'guerilla'),
						'desc' => __('Select number of knowledge base articles displayed on "Knowledge Base" page template.', 'guerilla'),
						'id' => 'kb_aticles_per_cat',
						'std' => '7',
						'type' => 'select',
						'options' => array(	'3' => '3',
											'4' => '4', 
											'5' => '5', 
											'6' => '6', 
											'7' => '7', 
											'8' => '8', 
											'10' => '10', 
											'12' => '12', 
											'14' => '14', 
											'20' => '20', 
							));

	$options[] = array(	'name' => __('Article Excerpt Length', 'guerilla'),
						'desc' => __('Specify article excerpt length displayed on "Articles" page template and search page.', 'guerilla'),
						'id' => 'post_excerpt',
						'std' => '25',
						'class' => 'mini',
						'type' => 'text');

	$options[] = array( 'name' => __("Author Box", 'guerilla'),
						'desc' => __("Display author info box below article", 'guerilla'),
						'id' => 'author_box',
						'std' => '0',
						'type' => 'checkbox');

	$options[] = array( 'name' => __("Comments are closed", 'guerilla'),
						'desc' => __("Suppress 'Comments are closed' message", 'guerilla'),
						'id' => 'suppress_comments_message',
						'std' => '1',
						'type' => 'checkbox');

	$options[] = array( 'name' => __('Social', 'guerilla'),
						'title' => __("Social Icons", 'guerilla'),
						'desc' => __("Displayed in footer", 'guerilla'),
						'type' => 'heading');
						
	$options[] = array(	'name' => __('Twitter', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://twitter.com/username'", 'guerilla'),
						'id' => 'twitter_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('Facebook', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://facebook.com/username'", 'guerilla'),
						'id' => 'facebook_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('Google+', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://gplus.to/username'", 'guerilla'),
						'id' => 'gplus_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('LinkedIn', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://linkedin.com/in/username'", 'guerilla'),
						'id' => 'linkedin_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('Vimeo', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://vimeo.com/username'", 'guerilla'),
						'id' => 'vimeo_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('YouTube', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://youtube.com/username'", 'guerilla'),
						'id' => 'youtube_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('Flickr', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://flickr.com/photos/username'", 'guerilla'),
						'id' => 'flickr_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('Pinterest', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://pinterest.com/username'", 'guerilla'),
						'id' => 'pinterest_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('RSS', 'guerilla'),
						'desc' => __("Enter full URL, ie 'http://website.com/rss'", 'guerilla'),
						'id' => 'rss_icon',
						'std' => '',
						'type' => 'text');

	$options[] = array( 'name' => __('Contact', 'guerilla'),
						'title' => __("Contact Form", 'guerilla'),
						'desc' => __("Contact page template settings", 'guerilla'),
						'type' => 'heading');

	$options[] = array(	'name' => __('Contact Form Email Address', 'guerilla'),
						'desc' => __('Enter the email address where want to receive emails from the contact form or leave blank to use default admin email.', 'guerilla'),
						'id' => 'contact_email',
						'std' => '',
						'type' => 'text');

	$options[] = array(	'name' => __('Contact Form Subject', 'guerilla'),
						'desc' => __('Enter the subject for the contact form or leave blank to use default subject.', 'guerilla'),
						'id' => 'contact_subject',
						'std' => '',
						'type' => 'text');

	return $options;
}

?>