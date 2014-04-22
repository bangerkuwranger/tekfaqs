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

global $post;

$show_3rd_level_cat = get_post_meta( $post->ID, '_show_3rd_level_cat', true );
$kb_aticles_per_cat = get_post_meta( $post->ID, '_kb_aticles_per_cat', true );

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
    
    
    $term_id        = array();
    $sub_categories = NULL;
    $subcategories  = NULL;
    $term_id[]      = $category->term_id;
    
    $sub_categories = array_values(get_categories(array(
        'orderby'   => 'name',
        'order'     => 'ASC',
        'child_of'  => $category->cat_ID,
    )));
    
    
    if(count($sub_categories)>0) {
        for($j=0;$j<count($sub_categories);$j++){
            $subcategories[$sub_categories[$j]->term_id] = $sub_categories[$j];
        }
        
        foreach($subcategories as $sub_cat){
            if($sub_cat->parent != $category->term_id){
                if(isset($subcategories[$sub_cat->parent]))
                    $subcategories[$sub_cat->parent]->subcats[] = $sub_cat;
                unset($subcategories[$sub_cat->term_id]);
            }
            
        }
    }
    
    $cat_posts = get_posts(array(
        'numberposts'   => -1,
        'category__and'  => $category->term_id,
    ));
    
    if(count($subcategories)==0 && count($cat_posts)==0){
        continue;
    }

    if($i++%3==0 && $skip){
        ?>
        <div class="row knowledge-base-row">
        <?php
    }
    $skip = TRUE;
    ?>
    <div class="col-sm-4 kb-category">
        <h2>
            <a href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo $category->name; ?>">
            <?php echo $category->name; ?>
            </a>
        </h2>
        <?php
        if(count($subcategories)>0) {
        foreach($subcategories as $sub_category) { 
            $term_id[] = $sub_category->term_id;
            ?>
        <ul class="sub-categories">
            <li>
                <?php 
                if(isset($sub_category->subcats)>0 && $show_3rd_level_cat ){
                    ?>
                    <i class="icon-folder-open"></i>
                    <a href="<?php  echo get_category_link( $sub_category->term_id ) ?>" title="<?php echo $sub_category->name;  ?>">
                        <?php echo $sub_category->name; ?>
                    </a>
                    <ul class="subcat">
                    <?php
                    foreach($sub_category->subcats as $sub_sub_cat){
                        ?>
                        <li>
                            <i class="icon-folder-close"></i>
                            <a href="<?php  echo get_category_link( $sub_sub_cat->term_id ) ?>" title="<?php echo $sub_sub_cat->name;  ?>">
                                <?php echo $sub_sub_cat->name; ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                    <?php
                }else{
                ?>
                    <i class="icon-folder-close"></i>
                    <a href="<?php  echo get_category_link( $sub_category->term_id ) ?>" title="<?php echo $sub_category->name;  ?>">
                        <?php echo $sub_category->name; ?>
                    </a>    
                <?php 
                }
                ?>
            </li>
        </ul>
            <?php 
        }
        }
        
        if(count($cat_posts)>0){
            ?>
            <ul class="category-posts">
            <?php 
            $j            = 1;
            $cat_post_num = $kb_aticles_per_cat; 
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
                <li>
                    <i class="icon-fixed-width <?php echo $post_icon; ?>"></i>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php
            if($j++==$cat_post_num)
                break;
            }
            ?>
            </ul>
        <?php
        }
        
        ?>
        <span class="label label-primary">
            <a href="<?php echo get_category_link( $category->term_id ) ?>" > <?php _e('View all', PRESSAPPS_TEXT_DOMAIN); ?> <?php echo get_total_cat_count($term_id);  ?> <?php _e('articles', PRESSAPPS_TEXT_DOMAIN); ?> 
                <i class="icon-chevron-right"></i>
            </a>
        </span>
    </div>
    <?php		
    
    if($i%3==0){
        ?>
        </div>
        <?php
    }
   
}
if($i%3!=0){
        echo "</div>";
    }
?>


