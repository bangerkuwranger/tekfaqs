<?php

/**
 * Add the Additional Columns For the faq_category Taxonomy
 * 
 * @param array $columns
 * @return array
 */       
function pressapps_manage_edit_faq_category_columns($columns){
    
    $new_columns['cb']          = $columns['cb'];
    $new_columns['name']        = $columns['name'];
    $new_columns['shortcode']   = __("Shortcode",'pressapps');
    $new_columns['slug']        = $columns['slug'];
    $new_columns['posts']       = $columns['posts'];
    
    return $new_columns;
}

add_filter('manage_edit-faq_category_columns','pressapps_manage_edit_faq_category_columns');


/**
 * 
 * Rename the Columns for the faq post type and adding new Columns
 * 
 * @param array $columns
 * @return array
 */

function pressapps_manage_edit_faq_columns($columns){
    
    $new_columns['cb']          = $columns['cb'];
    $new_columns['title']       = __('Question','pressapps');
    $new_columns['category']    = __('Category','pressapps');
    $new_columns['date']        = $columns['date'];
    
    return $new_columns;
}

add_filter('manage_edit-faq_columns','pressapps_manage_edit_faq_columns');