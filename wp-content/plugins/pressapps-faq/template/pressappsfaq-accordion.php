<?php

global $pressapps_faq_data,$post;

if(count($pressapps_faq_data['questions'])==0){
    _e('No Faq Found','pressapps');
    return ;
}
?>
<a id="top"></a>
<?php
if(isset($pressapps_faq_data['terms'])){
    ?>
    <?php
    $i=1;
    foreach($pressapps_faq_data['terms'] as $terms){
        if(count($pressapps_faq_data['questions'][$terms->term_id])>0){  
            ?>
            <div class="question-detail-list">
                <h2 class="faq-section-heading">
                    <a name="<?php echo $i++ . $terms->slug; ?>"></a><?php echo $terms->name; ?>
                </h2>
                <?php
                foreach($pressapps_faq_data['questions'][$terms->term_id] as $post){
                    setup_postdata($post);
                    ?>
                    <article id="faqarticle-<?php the_ID(); ?>" class="faq type-pressapps_faq status-publish clearfix">
                        <h3 id="question-<?php the_ID(); ?>" class="entry-title"><span></span><a name="<?php the_ID(); ?>"></a><?php the_title(); ?></h3>
                        <div class="faq-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php
            } ?>
            </div>
    <?php } 
    }
    ?>
    <?php
    
}else{
    foreach($pressapps_faq_data['questions'] as $post){
        setup_postdata($post);
        ?>
    <article id="faqarticle-<?php the_ID(); ?>" class="faq type-pressapps_faq status-publish clearfix">
    <h3 id="question-<?php the_ID(); ?>" class="entry-title"><a name="<?php the_ID(); ?>"><span></span></a><?php the_title(); ?></h3>
    <div class="faq-content">
    <?php the_content(); ?>
    </div>
    </article>
        <?php
    }
}