<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */
define('Redux_TEXT_DOMAIN', 'pressapps');

/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
//define('Redux_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('Redux_Options')) {
    require_once(dirname(__FILE__) . '/options/defaults.php');
}

/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections) {
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', Redux_TEXT_DOMAIN),
		'icon' => 'paper-clip',
		'icon_class' => 'icon-large',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');


/*
 *
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args) {
    //$args['dev_mode'] = false;

    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options() {
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

    // If you want to use Google Webfonts, you MUST define the api key.
    //$args['google_api_key'] = 'xxxx';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
    //$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Add content after the form.
    //$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Set footer/credit line.
    $args['footer_credit'] = __('<p>Thank you for using WordPress.</p>', Redux_TEXT_DOMAIN);

    // Setup custom links in the footer for share icons
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/GuerillaThemes',
        'title' => __('Follow Us on Twitter', Redux_TEXT_DOMAIN),
        'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
    );
    //$args['share_icons']['linked_in'] = array(
    //    'link' => 'http://www.linkedin.com/profile/view?id=52559281',
    //    'title' => __('Find me on LinkedIn', Redux_TEXT_DOMAIN),
    //    'img' => Redux_OPTIONS_URL . 'img/social/LinkedIn.png'
    //);

    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = PRESSAPPS_OPTIONS;

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    //$args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options-general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    $args['page_position'] = 59;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';
	//$args['dev_mode_icon_type'] = 'image';
	//$args['import_icon_type'] == 'image';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;

    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    /*
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );

    // Set the help sidebar for the options page.
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', Redux_TEXT_DOMAIN);
    */
    $sections = array();

    /* WIP 
    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $theme_name = $theme_data->get('Name');
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $theme_name = $theme_data['Name'];
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }

    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<h3 style="border-bottom:none;text-align:center">' . $theme_name . ' Theme</h3>';
    $item_info .= '<p style="text-align:center"><strong>By:</strong> <a href="' . $author_uri . '" target="_blank">' . $author . '</a></p>';
    $item_info .= '<p style="text-align:center"><strong>Version:</strong> ' . $version . '</p>';
    $item_info .= '<p style="text-align:center">For updates follow us on Twitter</p>';
    $item_info .= '<p style="text-align:center;"><a href="https://twitter.com/GuerillaThemes" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @GuerillaThemes</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>';
    $item_info .= '<p>&nbsp;</p>';
    $item_info .= '<div style="display:block">';
    $item_info .= '<div style="width:33%;display:inline-block;text-align:center"><p><i class="icon-file-alt icon-4x"></i></p><h3 style="border-bottom:none;"><a href="http://docs.pressappsthemes.com/' . THEME_NAME . '/" target="_blank">Documentation</a></h3></div>';
    $item_info .= '<div style="width:33%;display:inline-block;text-align:center"><p><i class="icon-plus-sign-alt icon-4x"></i></p><h3 style="border-bottom:none;"><a href="http://themeforest.net/user/GuerillaThemes" target="_blank">Theme Support</a></h3></div>';
    $item_info .= '<div style="width:33%;display:inline-block;text-align:center"><p><i class="icon-shopping-cart icon-4x"></i></p><h3 style="border-bottom:none;"><a href="http://themeforest.net/user/GuerillaThemes/portfolio" target="_blank">Buy Themes</a></h3></div>';
    $item_info .= '</div>';

    $sections[] = array(
        'icon' => 'home',
        'icon_class' => 'icon-large',
        'title' => __('Getting Started', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => 'font_awesome_info',
                'type' => 'raw_html',
                'html' => $item_info,
            )
        )
    );
    */
    $sections[] = array(
        'icon' => 'wrench',
        'icon_class' => 'icon-large',
        'title' => __('General Settings', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">General theme settings.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'logo',
                'type' => 'upload',
                'title' => __('Logo Upload', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Upload logo image.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => ''
                ),
            array(
                'id' => 'favicon',
                'type' => 'upload',
                'title' => __('Favicon Upload', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Upload favicon image.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => ''
                ),
            array(
                'id' => 'theme_layout',
                'type' => 'radio_img',
                'title' => __('Default Theme Layout', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select default sidebar alignment.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => array(
                 //   '1' => array('title' => '1 Column', 'img' => Redux_OPTIONS_URL . 'img/1col.png'),
                    '2' => array('title' => '2 Column Left', 'img' => Redux_OPTIONS_URL . 'img/2cl.png'),
                    '3' => array('title' => '2 Column Right', 'img' => Redux_OPTIONS_URL . 'img/2cr.png')
                ), 
                'std' => '2'
            ),    
            array(
                'id' => 'analytics', 
                'type' => 'text', 
                'title' => __('Google Analytics Code', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter Google analytics code (ie 'UA-24189019-1').", PRESSAPPS_TEXT_DOMAIN ),
                'std' => ''
                ),
            array(
                'id' => 'custom_css',
                'type' => 'textarea',
                'title' => __('CSS Code', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __("Enter custom CSS code (ie 'body {color: #0088cc;}').", PRESSAPPS_TEXT_DOMAIN ),
                'std' => ''
                ),

        )
    );
              
     $sections[] = array(
        'icon' => 'list-alt',
        'icon_class' => 'icon-large',
        'title' => __('Header Settings', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Set site header settings.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'header_title', 
                'type' => 'text', 
                'title' => __('Title', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter site header title.", PRESSAPPS_TEXT_DOMAIN ),
                'std' => 'Knowledge Base'
                ),
            array(
                'id' => 'header_subtitle', 
                'type' => 'text', 
                'title' => __('Subtitle', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter site header subtitle.", PRESSAPPS_TEXT_DOMAIN ),
                'std' => 'Find answers and help fast'
                ),
            array(
                'id' => 'header_search',
                'type' => 'checkbox',
                'title' => __('Search', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Display search field in header.', PRESSAPPS_TEXT_DOMAIN ),
                'switch' => true,
                'std' => '1'
            ),
        )
    );

     $sections[] = array(
        'icon' => 'file-text-alt',
        'icon_class' => 'icon-large',
        'title' => __('Post Settings', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Set default article settings.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'post_excerpt',
                'type' => 'select_hide_below',
                'title' => __('Post Content', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Display full post content or post excerpt.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => array(
                    '1' => array('name' => 'Full Content', 'allow' => 'false'),
                    '2' => array('name' => 'Post Excerpt', 'allow' => 'true'),
                ), 
                'std' => '1'
            ),
            array(
                'id' => 'post_excerpt_length',
                'type' => 'text',
                'title' => __('Post Excerpt Length', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __('Enter post excerpt length.', PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'numeric',
                'std' => '100',
                'class' => 'small-text'
            ),   
            array(
                'id' => 'blog_author',
                'type' => 'checkbox',
                'title' => __('Post Author', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Display author info box on post single page.', PRESSAPPS_TEXT_DOMAIN ),
                'switch' => true,
                'std' => '1'
            ),
        )
    );

   $sections[] = array(
        'icon' => 'search',
        'icon_class' => 'icon-large',
        'title' => __('Live Search', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Select default content settings.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'live_search_enable',
                'type' => 'checkbox',
                'title' => __('Live Search', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Enable live search for posts (Main header and Home page template).', PRESSAPPS_TEXT_DOMAIN ),
                'switch' => true,
                'std' => '1'
            ),
            array(
                'id' => 'live_search_in',
                'type' => 'select',
                'title' => __('Search Titles / Content', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Search in post titles only or post titles and content.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => array(
                    '1' => 'Titles Only',
                    '2' => 'Titles and Content'
                ), 
                'std' => '2'
            ),
        )
    );
                
   $sections[] = array(
        'icon' => 'tint',
        'icon_class' => 'icon-large',
        'title' => __('Styling Options', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Select default theme styling.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'body_bg_color',
                'type' => 'color',
                'title' => __('Body Background Color', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select body background color.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => '#F8F8F8'
            ),
            array(
                'id' => 'banner_bg_color',
                'type' => 'color',
                'title' => __('Navigation Header Color', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select navigation header background color.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => '#282828'
            ),
            array(
                'id' => 'dropdown_hover_color',
                'type' => 'color',
                'title' => __('Navigation Hover Color', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select navigation hover color.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => '#000000'
            ),
            array(
                'id' => 'main_header_bg_color',
                'type' => 'color',
                'title' => __('Title / Search Header Color', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select main header background color.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => '#3498db'
            ),
            array(
                'id' => 'theme_color',
                'type' => 'color',
                'title' => __('Content Theme Color', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select color of elements in main content area (Links, Buttons).', PRESSAPPS_TEXT_DOMAIN ),
                'std' => '#3498db'
            ),
            array(
                'id' => 'footer_bg_color',
                'type' => 'color',
                'title' => __('Footer Color', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select footer background color.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => '#3498db'
            ),
        )
    );
                
    $sections[] = array(
        'icon' => 'font',
        'icon_class' => 'icon-large',
        'title' => __('Font Options', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Select default font options.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'body_typography_size',
                'type' => 'select',
                'title' => __('Body Font Size', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select main content font size.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => array('10px' => '10px', '11px' => '11px', '12px' => '12px', '13px' => '13px', '14px' => '14px', '15px' => '15px', '16px' => '16px', '17px' => '17px', '18px' => '18px', '19px' => '19px'),
                'std' => '16px'
            ), 
            array(
                'id' => 'body_typography_font',
                'type' => 'select',
                'title' => __('Body Font', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Used in P tags.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => options_typography_get_google_fonts(),
                'std' => 'Open Sans, sans-serif',
            ),
            array(
                'id' => 'nav_typography_size',
                'type' => 'select',
                'title' => __('Navigation Font Size', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Select navigation font size.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => array('12px' => '12px', '13px' => '13px', '14px' => '14px', '15px' => '15px', '16px' => '16px', '17px' => '17px', '18px' => '18px', '19px' => '19px'),
                'std' => '18px'
            ),   
            array(
                'id' => 'navigation_typography_font',
                'type' => 'select',
                'title' => __('Navigation Font', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Used in main navigation.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => options_typography_get_google_fonts(),
                'std' => 'Open Sans, sans-serif',
            ),
            array(
                'id' => 'heading_typography_font',
                'type' => 'select',
                'title' => __('Heading Font', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Used in H1, H2, H3, H4, H5 & H6 tags.', PRESSAPPS_TEXT_DOMAIN ),
                'options' => options_typography_get_google_fonts(),
                'std' => 'Open Sans, sans-serif',
            ),
        )
    );

    $sections[] = array(
        'icon' => 'list-alt icon-flip-vertical',
        'icon_class' => 'icon-large',
        'title' => __('Footer Settings', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Select footer settings.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'copyright',
                'type' => 'textarea',
                'title' => __('Copyright', PRESSAPPS_TEXT_DOMAIN ), 
                'desc' => __('Enter your footer copyright information.', PRESSAPPS_TEXT_DOMAIN ),
                'std' => "Copyright 2012. Powered by <a href='http://wordpress.org/'>WordPress</a>"
            ),
        )
    );
    
    $sections[] = array(
        'icon' => 'heart-empty',
        'icon_class' => 'icon-large',
        'title' => __('Social Icons', PRESSAPPS_TEXT_DOMAIN ),
        'desc' => __('<p class="description">Set up footer social icons.</p>', PRESSAPPS_TEXT_DOMAIN ),
        'fields' => array(
            array(
                'id' => 'twitter_icon',
                'type' => 'text',
                'title' => __('Twitter', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://twitter.com/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'facebook_icon',
                'type' => 'text',
                'title' => __('Facebook', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://facebook.com/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'gplus_icon',
                'type' => 'text',
                'title' => __('Google+', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://gplus.to/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'linkedin_icon',
                'type' => 'text',
                'title' => __('LinkedIn', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://linkedin.com/in/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'vimeo_icon',
                'type' => 'text',
                'title' => __('Vimeo', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://vimeo.com/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'youtube_icon',
                'type' => 'text',
                'title' => __('YouTube', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://youtube.com/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'flickr_icon',
                'type' => 'text',
                'title' => __('Flickr', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://flickr.com/photos/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'dribbble_icon',
                'type' => 'text',
                'title' => __('Dribbble', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://dribbble.com/username'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
            array(
                'id' => 'rss_icon',
                'type' => 'text',
                'title' => __('RSS', PRESSAPPS_TEXT_DOMAIN ),
                'desc' => __("Enter full URL, ie 'http://website.com/rss'", PRESSAPPS_TEXT_DOMAIN ),
                'validate' => 'url',
                'std' => ''
                ),
        )
    );

    $tabs = array();

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);

/*
 *
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 *
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation

    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */

    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}
