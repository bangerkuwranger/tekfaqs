<?php

add_filter( 'cmb_meta_boxes', 'app_metabox' );

function app_metabox( array $meta_boxes ) {

	$prefix = '_';

	// Video post type
	$meta_boxes[] = array(
		'id'         => 'video_metabox',
		'title'      => 'Video Post Settings',
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Video Code',
				'desc' => 'Enter video embed code',
				'id'   => $prefix . 'video',
				'type' => 'textarea_code',
			),
		),
	);

	// Home page settings
	$meta_boxes[] = array(
		'id' => 'page_settings',
		'title' => 'Page Settings',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home.php', 'template-home2.php' ) ),
		'context' => 'normal', //  'normal', 'advanced', or 'side'
		'priority' => 'high',  //  'high', 'core', 'default' or 'low'
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Subtitle',
				'desc' => 'Enter page subtitle.',
				'id'   => $prefix . 'subtitle',
				'type' => 'text_medium',
				'std'  => '',
			),
			array(
	            'name' => 'Hero Background Color',
	            'desc' => 'Set hero background color',
	            'id'   => $prefix . 'hero_background_color',
	            'type' => 'colorpicker',
				'std'  => ''
	        ),
	        array(
				'name' => 'Hero Background Image',
				'desc' => 'Upload a page hero image (Overrides background color).',
				'id' => $prefix . 'hero_image',
				'type' => 'file',
				'save_id' => false, // save ID using true
				'allow' => array( 'attachment' ) 
			),
		),
	); 

	// Home page icons select
	$icons_select = array(  array( 'name' => 'Beaker', 'value' => 'beaker', ),
							array( 'name' => 'Book', 'value' => 'book', ),
							array( 'name' => 'Camera', 'value' => 'camera', ),
							array( 'name' => 'Check', 'value' => 'check', ),
							array( 'name' => 'Cloud', 'value' => 'cloud', ),
							array( 'name' => 'Cloud Download', 'value' => 'cloud-download', ),
							array( 'name' => 'Desktop', 'value' => 'desktop', ),
							array( 'name' => 'Edit', 'value' => 'edit', ),
							array( 'name' => 'Envelope', 'value' => 'envelope', ),
							array( 'name' => 'Facebook', 'value' => 'facebook', ),
							array( 'name' => 'File', 'value' => 'file', ),
							array( 'name' => 'Film', 'value' => 'film', ),
							array( 'name' => 'Flag', 'value' => 'flag', ),
							array( 'name' => 'Folder Close', 'value' => 'folder-close', ),
							array( 'name' => 'Folder Open', 'value' => 'folder-open', ),
							array( 'name' => 'Laptop', 'value' => 'laptop', ),
							array( 'name' => 'Leaf', 'value' => 'leaf', ),
							array( 'name' => 'Mobile Phone', 'value' => 'mobile-phone', ),
							array( 'name' => 'Ok', 'value' => 'ok', ),
							array( 'name' => 'Pencil', 'value' => 'pencil', ),
							array( 'name' => 'Picture', 'value' => 'picture', ),
							array( 'name' => 'Phone', 'value' => 'phone', ),
							array( 'name' => 'Play', 'value' => 'play', ),
							array( 'name' => 'Play Circle', 'value' => 'play-circle', ),
							array( 'name' => 'Plus', 'value' => 'plus', ),
							array( 'name' => 'Question Sign', 'value' => 'question-sign', ),
							array( 'name' => 'Star', 'value' => 'star', ),
							array( 'name' => 'Star Empty', 'value' => 'star-empty', ),
							array( 'name' => 'Tablet', 'value' => 'tablet', ),
							array( 'name' => 'Tag', 'value' => 'tag', ),
							array( 'name' => 'Thumbs Up', 'value' => 'thumbs-up', ),
							array( 'name' => 'Truck', 'value' => 'truck', ),
							array( 'name' => 'Twitter', 'value' => 'twitter', ),
							array( 'name' => 'Upload', 'value' => 'upload-alt', ),
							array( 'name' => 'User', 'value' => 'user', ),
							array( 'name' => 'Wrench', 'value' => 'wrench', ),
							);

	// Home page boxes 
	$meta_boxes[] = array(
		'id' => 'boxes',
		'title' => 'Boxes Section',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home.php' ) ),
		'context' => 'normal', 
		'priority' => 'core',  
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Display Boxes',
				'desc' => 'Display info boxes (setup below)',
				'id'   => $prefix . 'boxes',
				'type' => 'select',
				'std'  => '1',
				'options' => array(
					array('name' => 'Hide', 'value' => '0'),
					array('name' => '2 Boxes', 'value' => '2'),
					array('name' => '3 Boxes', 'value' => '3')				
				)
				),
			array(
				'name' => 'Box Left',
				'id'   => $prefix . 'box_left',
				'type' => 'header',
			),
			array(
				'name'    => 'Icon',
				'id'      => $prefix . 'box_icon_left',
				'type'    => 'select',
				'options' => $icons_select,
				),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'box_title_left',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Link',
				'id'   => $prefix . 'box_link_left',
				'desc' => 'Full link to a page e.g. "http://website.com/blog/".',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Content',
				'id'   => $prefix . 'box_content_left',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Box Middle',
				'id'   => $prefix . 'box_middle',
				'type' => 'header',
			),
			array(
				'name'    => 'Icon',
				'id'      => $prefix . 'box_icon_middle',
				'type'    => 'select',
				'options' => $icons_select,
				),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'box_title_middle',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Link',
				'id'   => $prefix . 'box_link_middle',
				'desc' => 'Full link to a page e.g. "http://website.com/blog/".',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Content',
				'id'   => $prefix . 'box_content_middle',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Box Right',
				'id'   => $prefix . 'box_right',
				'type' => 'header',
			),
			array(
				'name'    => 'Icon',
				'id'      => $prefix . 'box_icon_right',
				'type'    => 'select',
				'options' => $icons_select,
				),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'box_title_right',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Link',
				'id'   => $prefix . 'box_link_right',
				'desc' => 'Full link to a page e.g. "http://website.com/blog/".',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Content',
				'id'   => $prefix . 'box_content_right',
				'type' => 'textarea_small',
			),
		),
	); 

	// Home page featured post section
	$meta_boxes[] = array(
		'id' => 'home_featured',
		'title' => 'Featured Posts Section',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home.php' ) ),
		'context' => 'normal', 
		'priority' => 'core', 
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Title',
				'id'   => $prefix . 'featured_title',
				'type' => 'text_medium',
			),
			array(
				'name'     => 'Featured Post 1',
				'desc'     => 'Select featured post 1',
				'id'       => $prefix . 'featured_post_1',
				'type'     => 'post_select',
			),
			array(
				'name'     => 'Featured Post 2',
				'desc'     => 'Select featured post 2',
				'id'       => $prefix . 'featured_post_2',
				'type'     => 'post_select',
			),
			array(
				'name'     => 'Featured Post 3',
				'desc'     => 'Select featured post 3',
				'id'       => $prefix . 'featured_post_3',
				'type'     => 'post_select',
			),
			array(
				'name'     => 'Featured Post 4',
				'desc'     => 'Select featured post 4',
				'id'       => $prefix . 'featured_post_4',
				'type'     => 'post_select',
			),
		),
	); 

	// Home page video section
	$meta_boxes[] = array(
		'id' => 'home_video',
		'title' => 'Video Section',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home.php' ) ),
		'context' => 'normal', 
		'priority' => 'core', 
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Title',
				'id'   => $prefix . 'video_title',
				'type' => 'text_medium',
			),
			array(
				'name'     => 'Post Category',
				'desc'     => 'Select post category used for video section on home page.',
				'id'       => $prefix . 'video_category',
				'type'     => 'category_select',
			),
			array(
				'name'     => 'Video Player Link',
				'desc'     => 'Select video post linked to the video player',
				'id'       => $prefix . 'video_player_link',
				'type'     => 'post_select',
			),
	        array(
				'name' => 'Video Player Image',
				'desc' => 'Upload background image for video player',
				'id' => $prefix . 'video_player_image',
				'type' => 'file',
				'save_id' => false, // save ID using true
				'allow' => array( 'attachment' ) 
			),
		),
	); 

	// Home page 2 boxes 
	$meta_boxes[] = array(
		'id' => 'boxes',
		'title' => 'Boxes Section',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home2.php' ) ),
		'context' => 'normal', 
		'priority' => 'core',  
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Display Boxes',
				'desc' => 'Display info boxes (setup below)',
				'id'   => $prefix . 'boxes',
				'type' => 'select',
				'std'  => '1',
				'options' => array(
					array('name' => 'Hide', 'value' => '0'),
					array('name' => '2 Boxes', 'value' => '2'),
					array('name' => '3 Boxes', 'value' => '3')				
				)
				),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'boxes_title',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Subtitle',
				'id'   => $prefix . 'boxes_subtitle',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Box Left',
				'id'   => $prefix . 'box_left',
				'type' => 'header',
			),
			array(
				'name'    => 'Icon',
				'id'      => $prefix . 'box_icon_left',
				'type'    => 'select',
				'options' => $icons_select,
				),
			array(
	            'name' => 'Icon Color',
	            'desc' => 'Set icon background color',
	            'id'   => $prefix . 'box_icon_color_left',
	            'type' => 'colorpicker',
				'std'  => '#3498db'
	        ),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'box_title_left',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Link',
				'id'   => $prefix . 'box_link_left',
				'desc' => 'Full link to a page e.g. "http://website.com/blog/".',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Content',
				'id'   => $prefix . 'box_content_left',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Box Middle',
				'id'   => $prefix . 'box_middle',
				'type' => 'header',
			),
			array(
				'name'    => 'Icon',
				'id'      => $prefix . 'box_icon_middle',
				'type'    => 'select',
				'options' => $icons_select,
				),
			array(
	            'name' => 'Icon Color',
	            'desc' => 'Set icon background color',
	            'id'   => $prefix . 'box_icon_color_middle',
	            'type' => 'colorpicker',
				'std'  => '#3498db'
	        ),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'box_title_middle',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Link',
				'id'   => $prefix . 'box_link_middle',
				'desc' => 'Full link to a page e.g. "http://website.com/blog/".',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Content',
				'id'   => $prefix . 'box_content_middle',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Box Right',
				'id'   => $prefix . 'box_right',
				'type' => 'header',
			),
			array(
				'name'    => 'Icon',
				'id'      => $prefix . 'box_icon_right',
				'type'    => 'select',
				'options' => $icons_select,
				),
			array(
	            'name' => 'Icon Color',
	            'desc' => 'Set icon background color',
	            'id'   => $prefix . 'box_icon_color_right',
	            'type' => 'colorpicker',
				'std'  => '#3498db'
	        ),
			array(
				'name' => 'Title',
				'id'   => $prefix . 'box_title_right',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Link',
				'id'   => $prefix . 'box_link_right',
				'desc' => 'Full link to a page e.g. "http://website.com/blog/".',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Content',
				'id'   => $prefix . 'box_content_right',
				'type' => 'textarea_small',
			),
		),
	); 

	// Home page 2 featured post section
	$meta_boxes[] = array(
		'id' => 'home_featured',
		'title' => 'Featured Posts Section',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home2.php' ) ),
		'context' => 'normal', 
		'priority' => 'core', 
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Title',
				'id'   => $prefix . 'featured_title',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Subtitle',
				'id'   => $prefix . 'featured_subtitle',
				'type' => 'text_medium',
			),
			array(
	            'name' => 'Background Color',
	            'desc' => 'Set featured section background color',
	            'id'   => $prefix . 'featured_background_color',
	            'type' => 'colorpicker',
				'std'  => '#3498db'
	        ),
			array(
				'name'     => 'Featured Post 1',
				'desc'     => 'Select featured post 1',
				'id'       => $prefix . 'featured_post_1',
				'type'     => 'post_select',
			),
			array(
				'name'     => 'Featured Post 2',
				'desc'     => 'Select featured post 2',
				'id'       => $prefix . 'featured_post_2',
				'type'     => 'post_select',
			),
			array(
				'name'     => 'Featured Post 3',
				'desc'     => 'Select featured post 3',
				'id'       => $prefix . 'featured_post_3',
				'type'     => 'post_select',
			),
			array(
				'name'     => 'Featured Post 4',
				'desc'     => 'Select featured post 4',
				'id'       => $prefix . 'featured_post_4',
				'type'     => 'post_select',
			),
		),
	); 


	// Home page 2 video section
	$meta_boxes[] = array(
		'id' => 'home_video',
		'title' => 'Video Section',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-home2.php' ) ),
		'context' => 'normal', 
		'priority' => 'core', 
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Title',
				'id'   => $prefix . 'video_title',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Subtitle',
				'id'   => $prefix . 'video_subtitle',
				'type' => 'text_medium',
			),
			array(
				'name'     => 'Post Category',
				'desc'     => 'Select post category used for video section on home page.',
				'id'       => $prefix . 'video_category',
				'type'     => 'category_select',
			),
			array(
				'name'     => 'Video Player Link',
				'desc'     => 'Select video post linked to the video player',
				'id'       => $prefix . 'video_player_link',
				'type'     => 'post_select',
			),
	        array(
				'name' => 'Video Player Image',
				'desc' => 'Upload background image for video player',
				'id' => $prefix . 'video_player_image',
				'type' => 'file',
				'save_id' => false, // save ID using true
				'allow' => array( 'attachment' ) 
			),
		),
	); 

	// Knowledge base page template
	$meta_boxes[] = array(
		'id' => 'kb_template',
		'title' => 'Knowledge Base Settings',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-knowledgebase.php' ) ),
		'context' => 'normal', 
		'priority' => 'high', 
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Display 3rd Level Categories',
				'desc' => 'Display 3rd level child categories.',
				'id'   => $prefix . 'show_3rd_level_cat',
				'type' => 'checkbox',
				'std'  => '1',
			),
			array(
				'name'    => 'Articles Per Category',
				'desc'    => 'Select number of knowledge base articles displayed per category',
				'id'      => $prefix . 'kb_aticles_per_cat',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '3 Articles', 'value' => '3', ),
					array( 'name' => '4 Articles', 'value' => '4', ),
					array( 'name' => '5 Articles', 'value' => '5', ),
					array( 'name' => '6 Articles', 'value' => '6', ),
					array( 'name' => '7 Articles', 'value' => '7', ),
					array( 'name' => '8 Articles', 'value' => '8', ),
					array( 'name' => '10 Articles', 'value' => '10', ),
					array( 'name' => '12 Articles', 'value' => '12', ),
					array( 'name' => '14 Articles', 'value' => '14', ),
					array( 'name' => '18 Articles', 'value' => '18', ),
					array( 'name' => '20 Articles', 'value' => '20', ),
				),
			),
		),
	); 

	// Contact page template
	$meta_boxes[] = array(
		'id' => 'contact_template',
		'title' => 'Contact Form Settings',
		'pages' => array('page'), 
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'template-contact.php' ) ),
		'context' => 'normal', 
		'priority' => 'high', 
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Contact Form Email Address',
				'desc'    => 'Enter the email address where want to receive emails from the contact form or leave blank to use default admin email.',
				'id'   => $prefix . 'contact_email',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Contact Form Subject',
				'desc'    => 'Enter the subject for the contact form or leave blank to use default subject.',
				'id'   => $prefix . 'contact_subject',
				'type' => 'text_medium',
			),
		),
	); 

	return $meta_boxes;
}
        
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {


	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once get_template_directory() . '/lib/metabox/init.php';

}