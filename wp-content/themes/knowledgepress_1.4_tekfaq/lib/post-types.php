<?php

// Custom post types

/* faq */

add_action( 'init', 'faq_post_type' );
if ( ! function_exists( 'faq_post_type' ) ) {
function faq_post_type() {
    
    //Register FAQ Post Type
    register_post_type( 'faq',
        array(
        'description' => __( 'FAQ Articles', 'guerilla' ),
        'labels' => array(
                'name' => __( 'FAQ', 'guerilla' ),
                'singular_name' => __( 'FAQ', 'guerilla' ),
                'add_new' => __('Add New', 'guerilla'),  
                'add_new_item' => __('Add New FAQ', 'guerilla'),  
                'edit_item' => __('Edit FAQ', 'guerilla'),  
                'new_item' => __('New FAQ', 'guerilla'),  
                'view_item' => __('View FAQ', 'guerilla'),  
                'search_items' => __('Search FAQ', 'guerilla'),  
                'not_found' =>  __('No FAQ found', 'guerilla'),  
                'not_found_in_trash' => __('No FAQ found in Trash', 'guerilla')
            ),
        'public' => true,
        'menu_position' => 5,
        'rewrite' => array('slug' => 'faq'),
        'supports' => array(
            'title',
            'editor'),
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false
        )
    );
}
}

	function faq_taxonomy()
	{
		$labels = array('name' => __( 'Categories', 'guerilla' ),
						'singular_name' => __( 'Category', 'guerilla' ),
						'search_items' =>  __( 'Search Categories', 'guerilla' ),
						'all_items' => __( 'All Categories', 'guerilla' ),
						'parent_item' => __( 'Parent Category', 'guerilla' ),
						'parent_item_colon' => __( 'Parent Category:', 'guerilla' ),
						'edit_item' => __( 'Edit Category', 'guerilla' ),
						'update_item' => __( 'Update Category', 'guerilla' ),
						'add_new_item' => __( 'Add New Category', 'guerilla' ),
						'new_item_name' => __( 'New Category Name', 'guerilla' ),
						'menu_name' => __( 'Categories', 'guerilla' ) );

		register_taxonomy(  'faq_category',
							array( 'faq' ),
							array( 'hierarchical' => true,
							'labels' => $labels,
							'show_ui' => true,
							'public' => true,
							'query_var' => true,
							'rewrite' => array( 'slug' => 'faq_category' )));
	}
	
	add_action( 'init', 'faq_taxonomy' );
