<?php

function pressapps_faq_help_tab(){
    
    $screen = get_current_screen();
    
    if(in_array($screen->id,array('edit-faq_category','faq','edit-faq'))){
    
        /*
        $screen->add_help_tab( array(
            'id'	=> 'pressappsfaq_Overview',
            'title'	=> __( 'Faq Overview', 'pressapps' ),
            'content'	=>
                '<p>' . __('<h2>Faq Overview</h2>','pressapps') . '</p>' .
            
                '<p>' . sprintf(__( 'Thank you for using FAQ Plugin. Should you need help using FAQ please read the bundled documentation. For further assistance you can contact <a href="%s">support</a>.', 'pressapps' ), 'mailto:support@pressapps.co') . '</p>' 

        ));
        */
        $screen->add_help_tab( array(
            'id'	=> 'pressappsfaq_shortcode',
            'title'	=> __( 'Faq Shortcodes', 'pressapps' ),
            'content'	=>
            
                '<p>' . __('<h2>Faq Shortcodes</h2>','pressapps') . '</p>' .
            
                '<p>' . __( 'You can use <code>[faq]</code> shortcode to include the Faqs on any page, post or custom post type.', 'pressapps' ) . '</p>' .

                '<p>' . __( 'The shortcode accepts two optional attributes:', 'pressapps' ) . '</p>' . 
                '<p>' . __( '(1) <b>category</b> = <i>-1</i> <b>|</b> <i>{any faq category id}</i>', 'pressapps' ) . '</p>' . 
                '<p>' . __( '(2) <b>template</b> = <i>accordion</i> <b>|</b> <i>{any custom/existing template}</i>', 'pressapps' ) . '</p>' . 
                '<p>' . __( '<b>Examples</b>', 'pressapps' ) . '</p>' . 
                '<p>' . __( '1. <code>[faq]</code>', 'pressapps' ) . '</p>' .
                '<p>' . sprintf(__( '2. <code>[faq category={category_id}]</code> {category_id} you will find it <a href="%s">here</a> under shortcode column', 'pressapps' ),admin_url('edit-tags.php?taxonomy=faq_category&post_type=faq') ). '</p>' .
                '<p>' . __( '3. <code>[faq category={category_id} template=\'accordion\']</code>', 'pressapps' ) . '</p>' 
                

        ));
        /*
        $screen->add_help_tab( array(
            'id'	=> 'pressappsfaq_templates',
            'title'	=> __( 'Faq Templates', 'pressapps' ),
            'content'	=>
            
                '<p>' . __('<h2>Faq Templates</h2>','pressapps') . '</p>' .
            
                '<p>' . __( 'if you are developer and or you want to customize the existing Style of the Faq Disaply to match it with your theme we are having Solution for that as well insted of Modifing the core file directly we would prefeer you to follow the Below listed step.', 'pressapps' ) . '</p>' .

                '<p>' . __( '<b>1. customize the existing template</b>', 'pressapps' ) . '</p>' .
                '<p>' . __( 'to customize the existing template copy the template file from plugin <code>templates</code> folder to your currently <code>active theme</code>', 'pressapps' ) . '</p>' .
                '<p>' . __( 'So let say you wanted to modify the <b>accordion</b> Template in that case you can simply copy the <code>pressappsfaq-accordion.php</code> file from the Plugin\'s template folder to your Current Active theme\'s Folder', 'pressapps' ) . '</p>' .
                
                '<p>' . __( '<b>2. Create your own custom template</b>', 'pressapps' ) . '</p>' .
                '<p>' . __( 'if you wanted to create a new Template of your own in that case copy any of the Existing template from the plugin\'s <code>templates</code> folder to your currently <code>active theme</code>', 'pressapps' ) . '</p>' .
                '<p>' . __( 'and rename that template in the following file format <b>pressappsfaq-{templat-name}.php</b> and place it to your Current Active theme\'s Folder', 'pressapps' ) . '</p>' .
                '<p>' . __( 'So let say you wanted to create the <b>custom</b> Template in that case you can simply copy the <code>pressappsfaq-default.php</code> file from the Plugin\'s template folder to your Current Active theme\'s Folder and then rename this file to <code>pressappsfaq-custom.php</code>', 'pressapps' ) . '</p>' .
                '<p>' . __( 'Customly created template can be used using <code>template</code> attribute like <i>template=\'custom\'</i> with in the faq shortcode', 'pressapps' ) . '</p>' 

        ));
        */
    }
}

add_action( 'admin_print_styles'     ,'pressapps_faq_help_tab');
add_action( 'admin_print_styles'     ,'pressapps_faq_help_tab');