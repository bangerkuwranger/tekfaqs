<?php
/*
Template Name: Knowledge Base
*/

/**
 * Return the total no of unique post in terms/Categories
 * 
 * @global type $wpdb
 * @param array $term_id
 * @return type
 */
function get_total_cat_count($term_id = array()){
    global $wpdb;
    
    $result['A'] = 0;
    
    $qry['A']  = " SELECT DISTINCT(B.object_id) FROM {$wpdb->term_taxonomy} A , {$wpdb->term_relationships} B ";
    $qry['A'] .= " WHERE A.term_taxonomy_id=B.term_taxonomy_id AND A.term_id IN (" .  implode(",",$term_id) . ")"; 
    
    
    
    $result['A'] = $wpdb->get_results($qry['A']);
    
    return count($result['A']);
}

$categories = get_categories(array(
    'orderby'         => 'slug',
    'order'           => 'ASC',
    'hierarchical'    => true,
    'parent'          => 0,
    'hide_empty'      => false,
)); 

$i    = 0;
$skip = TRUE;

foreach($categories as $category) { 
    if($i++%3==0 && $skip){
        ?>
        <div class="row knowledge-base">
        <?PHP
    }
    $skip = TRUE;
    
    $term_id        = array();
    $term_id[]      = $category->term_id;
    
    $sub_categories = get_categories(array(
        'orderby'   => 'name',
        'order'     => 'ASC',
        'child_of'  => $category->cat_ID,
    )); 
    
    $cat_posts = get_posts(array(
        'numberposts'   => -1,
        'category__and'  => $category->term_id,
    ));
    
    if(count($sub_categories)==0 && count($cat_posts)==0){
        $i--;
        $skip = FALSE;
        continue;
    }
    
    ?>
    <div class="span3">
        <h2>
            <a href="<?PHP echo get_category_link($category->term_id); ?>" title="<?PHP echo $category->name; ?>">
            <?PHP echo $category->name; ?>
            </a>
        </h2>
        <?PHP
        foreach($sub_categories as $sub_category) { 
            $term_id[] = $sub_category->term_id;
            ?>
        <ul class="sub-categories">
            <li><i class="icon-folder-close"></i>
                <a href="<?PHP  echo get_category_link( $sub_category->term_id ) ?>" title="<?PHP echo $sub_category->name;  ?>">
                    <?PHP echo $sub_category->name; ?>
                </a>
            </li>
        </ul>
            <?PHP 
        }
        
        
        
        
        if(count($cat_posts)>0){
            ?>
            <ul class="category-posts">
            <?PHP 
            $j            = 1;
            $cat_post_num = gt_get_option('kb_aticles_per_cat');
            foreach($cat_posts as $post){
                setup_postdata($post);
                switch(get_post_format()){
                    case 'video':
                        $post_icon = 'icon-film';
                        break;
                    case 'image':
                        $post_icon = 'icon-picture';
                        break;
                    default:
                        $post_icon = 'icon-file-alt';
                        break;
                }
                ?>
                <li><i class="<?php echo $post_icon; ?>"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?PHP
            if($j++==$cat_post_num)
                break;
            }
            ?>
            </ul>
        <?PHP
        }
        
        ?>
        <span class="label label-color">
            <a href="<?PHP echo get_category_link( $category->term_id ) ?>" > View all <?PHP echo get_total_cat_count($term_id);  ?> articles 
                <i class="icon-chevron-right"></i>
            </a>
        </span>
    </div>
    <?PHP		
    
    if($i%3==0){
        ?>
        </div>
        <?PHP
    }
   
}
if($i%3!=0){
        echo "</div>";
    }
?>


