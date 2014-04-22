<?php

/**
 * 
 * return the Final output of the FAQ html generated based on the template file 
 * and Data based on the parameter
 * 
 * @param array $args
 * @return string
 */
function pressapps_get_display_faq($args = array()){
    global $pressapps_faq_data;
    
    $default = array(
        'category'      => -1,
        'template'      => 'default',
    );
    
    $args = shortcode_atts($default,$args);
    
    $qry_args = array(
        'post_type'     => 'faq',
        'numberposts'   => -1,
    );
    
    if(isset($args['category']) && $args['category']!=-1){
        $qry_args['tax_query']   = array(array(
                'taxonomy'  => 'faq_category',
                'field'     => 'id',
                'terms'     => $args['category'],
            ),
        );
        $pressapps_terms       = get_terms('faq_category',array(
            'child_of'  => $args['category']
        ));
    }else{
        $pressapps_terms = get_terms('faq_category');
    }
    
    if(count($pressapps_terms)>0){
        foreach($pressapps_terms as $term){
            $pressapps_terms_questions[$term->term_id] = get_posts(array_merge($qry_args,
                array('tax_query'     => array(
                    array(
                        'taxonomy'  => 'faq_category',
			'field'     => 'id',
			'terms'     => $term->term_id,
                    )
                )
            )));
            
        }
        
        $pressapps_faq_data = array(
            'dispaly_terms' => TRUE,
            'terms'         => $pressapps_terms,
            'questions'     => $pressapps_terms_questions,
            'template'      => $args['template'],
        );
    }else{
        
        $pressapps_question = get_posts($qry_args);
        
        $pressapps_faq_data = array(
            'dispaly_terms' => FALSE,
            'questions'     => $pressapps_question,
            'template'      => $args['template'],
        );
    }
    
    /**
     * Select the Proper Template file to be Render the FAQ Structure
     * 
     */
    
    $default_filename           = PRESSAPPS_FAQ_PLUGIN_DIR . "/template/pressappsfaq-default.php";  
    $theme_default_filename     = get_stylesheet_directory() . "/pressappsfaq-default.php";
    
    $default_template_filename  = PRESSAPPS_FAQ_PLUGIN_DIR . "/template/pressappsfaq-{$args['template']}.php";
    $theme_template_filename    = get_stylesheet_directory() . "/pressappsfaq-{$args['template']}.php";
    
    if(@file_exists($theme_template_filename)){
        $filename = $theme_template_filename;
    }elseif(@file_exists($default_template_filename)){
        $filename = $default_template_filename;
    }elseif(@file_exists($theme_default_filename)){
        $filename = $theme_default_filename;
    }else{
        $filename = $default_filename;
    }
    
    
    ob_start();
    include_once $filename;

    if($pressapps_faq_data['template']=='default'){
        wp_enqueue_style('pressapps_faq_default');
    } elseif ($pressapps_faq_data['template']=='accordion'){
        wp_enqueue_style('pressapps_faq_accordion');
        wp_enqueue_script('pressapps_faq_accordion');
    } 
    

    return ob_get_clean();
    
}

/**
 * 
 * Disply the FAQ HTML generated based on the template file of FAQ.
 * 
 * @param array $args
 */
function pressapps_the_display_faq($args   = array()){
    echo pressapps_get_display_faq($args);
}

/**
 * Add the Shortcode for the Faq part with the following options 
 * 
 * <ul>
 * <li></li>
 * <li></li>
 * <li></li>
 * </ul>
 * 
 * @param array $atts
 * @return string
 */
function pressapps_shortcode_faq($atts = array()){
    
    
    
    return pressapps_get_display_faq($atts);
}


add_shortcode('faq', 'pressapps_shortcode_faq');