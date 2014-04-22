<?php
/**
 * @package name
 */

/**
 * 
 * Add the Additional column Values for the faq_category Taxonomy
 * 
 * @param string $out
 * @param string $column
 * @param int $term_id
 * @return string
 */
function pressapps_manage_faq_category_custom_column($out,$column,$term_id){
    switch($column){
        case 'shortcode':
            $temp = '[faq category=' . $term_id . ']';
            return $temp;
            break;
    }
}

add_action( 'manage_faq_category_custom_column' , 'pressapps_manage_faq_category_custom_column',10,3); 

/**
 * 
 * Add the Additional column Values for the faq Post Type
 * 
 * @global type $post
 * @param string $column
 */

function pressapps_manage_faq_custom_column($column){
    global $post;
    switch($column){
        case 'category':
            $terms = wp_get_object_terms($post->ID  ,'faq_category');
            foreach($terms as $term){
                $temp  = " <a href=\"" . admin_url('edit-tags.php?action=edit&taxonomy=faq_category&tag_ID=' . $term->term_id . '&post_type=faq') . "\" ";
                $temp .= " class=\"row-title\">{$term->name}</a><br/>";
                echo $temp;
            }
            break;
    }
}

add_action( 'manage_faq_posts_custom_column' , 'pressapps_manage_faq_custom_column'); 

/**
 * Category Based Filtering options
 * 
 * @global string $typenow
 */

function pressapps_restrict_manage_posts(){
    global $typenow;
    
    if($typenow=='faq'){
        ?>
        <select name="faq_category">
            <option value="0"><?php _e('Selecte Category','pressapps'); ?></option>
        <?php
        $categories = get_terms('faq_category');
        if(count($categories)>0){
            foreach($categories as $cat){
                if($_GET['faq_category']==$cat->slug){
                    echo "<option value={$cat->slug} selected=\"selected\">{$cat->name}</option>";
                }else{
                    echo "<option value={$cat->slug} >{$cat->name}</option>";
                }
            }
        }
        ?>
        </select>
        <?php
    }
    
}

add_action('restrict_manage_posts','pressapps_restrict_manage_posts');


/**
 * Shortcode field for the Edit Taxonomy Page
 * 
 * @param string $taxonomy
 */

function pressapps_faq_category_edit_form_fields($taxonomy){
    $tag_id = $_GET['tag_ID'];
    ?>
    <tr>
        <th scope="row" valign="top"><label for="shortcode"><?php _e('Shortcode','pressapps');?></label></th>
        <td>[faq category=<?php echo $tag_id; ?>]</td>
    </tr>
    <?php
}

add_action('faq_category_edit_form_fields','pressapps_faq_category_edit_form_fields');

