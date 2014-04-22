<?php
/**
 * Plugin Name: PressApps Faq
 * Plugin URI: http://pressapps.co/plugins/
 * Description: Standalone FAQ plugin
 * Author: PressApps Team
 * Version : 1.0.0
 */

define('PRESSAPPS_FAQ_PLUGIN_DIR',dirname(__FILE__));

class PRESSAPPS_FAQ{
    
    /**
     * Setup the Environment for the Plugin
     */
    function __construct() {
        
        include_once 'function.php';
        include_once 'add_action.php';
        include_once 'add_filter.php';
        include_once 'help.php';
      
        load_plugin_textdomain('pressapps', false, basename(dirname(__FILE__)).'/lang' );
        
        add_action('init'              ,array($this,'init'));
        
    }
    
    
    function init(){
        
        add_filter( 'widget_text', 'do_shortcode' );
        
        register_post_type( 'faq',array(
            'description'           => __('FAQ Articles','pressapps'),
            'labels'                => array(
                'name'                  => __('FAQ'                     ,'pressapps'),
                'singular_name'         => __('FAQ'                     ,'pressapps'),
                'add_new'               => __('Add New'                 ,'pressapps'),  
                'add_new_item'          => __('Add New FAQ'             ,'pressapps'),  
                'edit_item'             => __('Edit FAQ'                ,'pressapps'),  
                'new_item'              => __('New FAQ'                 ,'pressapps'),  
                'view_item'             => __('View FAQ'                ,'pressapps'),  
                'search_items'          => __('Search FAQ'              ,'pressapps'),  
                'not_found'             => __('No FAQ found'            ,'pressapps'),  
                'not_found_in_trash'    => __('No FAQ found in Trash'   ,'pressapps')
            ),
            'public'                => true,
            'menu_position'         => 5,
            'rewrite'               => array('slug' => 'faq'),
            'supports'              => array('title','editor'),
            'public'                => true,
            'show_ui'               => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false
        ));
        
        register_taxonomy( 'faq_category',array( 'faq' ),array( 
            'hierarchical'  => false,
            'labels'        => array(
                'name'              => __( 'Categories'             ,'pressapps'),
                'singular_name'     => __( 'Category'               ,'pressapps'),
                'search_items'      => __( 'Search Categories'      ,'pressapps'),
                'all_items'         => __( 'All Categories'         ,'pressapps'),
                'parent_item'       => __( 'Parent Category'        ,'pressapps'),
                'parent_item_colon' => __( 'Parent Category:'       ,'pressapps'),
                'edit_item'         => __( 'Edit Category'          ,'pressapps'),
                'update_item'       => __( 'Update Category'        ,'pressapps'),
                'add_new_item'      => __( 'Add New Category'       ,'pressapps'),
                'new_item_name'     => __( 'New Category Name'      ,'pressapps'),
                'popular_items'     => NULL,
                'menu_name'         => __( 'Categories'             ,'pressapps') 
            ),
            'show_ui'       => true,
            'public'        => true,
            'query_var'     => true,
            'hierarchical'  => true,
            'rewrite'       => array( 'slug' => 'faq_category' )
        ));
        
        
        wp_register_style('pressapps_faq_default'     , plugins_url('/css/default.css', __FILE__));
        
        wp_register_style('pressapps_faq_accordion'     , plugins_url('/css/custom.css', __FILE__));
        
        wp_register_script('pressapps_faq_accordion'       , plugins_url('/js/custom.js'         , __FILE__)      ,array('jquery'));
       
    }
    
    function custom_column_values($column){
        global $post;
        switch($column){
            case 'category':
                $terms  = wp_get_object_terms($post->ID,'pressapps_faq_category');
                
                if(!empty($terms)){
                    foreach($terms as $term){
                        echo '<a target="_blank" class="row-title" ';
                        echo ' href="' . admin_url('edit-tags.php?action=edit&taxonomy=pressapps_faq_category&tag_ID=' . $term->term_id . '&post_type=pressapps_faq') . '">' .  $term->name . '</a>';
                    }
                }
                
                break;
        }
    }
    
    function custom_column($columns){
        $new_columns['cb']             = $columns['cb'];
        $new_columns['title']          = $columns['title'];
        $new_columns['category']       = __('Category','pressapps');
        return $new_columns;
    }
    
}

$pressapps_faq = new PRESSAPPS_FAQ();


