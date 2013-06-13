<?php
/*
Template Name: Home
*/
?>
<?php 

/* ==========================================================================
   Hero Search & Boxes
   ========================================================================== */
?>
<div id="hero-image">
<div id="hero">
  <div class="container">
    <div class="hero-title">
      <h1><?php echo gt_get_option('header_title'); ?></h1>
    </div>
    <div class="hero-search">
      <?php get_hero_search_live(); ?>
    </div>
  </div>
</div>

<div id="boxes-container"><h1>Browse By:</h1>
  <div class="container">
  <div class="row boxes">
    <div class="span4">
      <div class="box">
        <div class="box-icon">
          <i class="icon-<?php echo gt_get_option('box_1_icon'); ?>"></i>
        </div>
        <div class="box-title">
          <h2><a href="index.php?page_id=<?php echo gt_get_option('box_1_link'); ?>"><?php echo get_the_title(gt_get_option('box_1_link')); ?></a></h2>
        </div>
        <div class="box-text">
          <?php echo gt_get_option('box_1_text'); ?><br>
          <a class="btn-black" href="index.php?page_id=<?php echo gt_get_option('box_1_link'); ?>"><?php _e('Continue', 'guerilla'); ?></a>
        </div>
      </div>
    </div>
    <div class="span4">
      <div class="box">
        <div class="box-icon">
          <i class="icon-<?php echo gt_get_option('box_2_icon'); ?>"></i>
        </div>
        <div class="box-title">
          <h2><a href="index.php?page_id=<?php echo gt_get_option('box_2_link'); ?>"><?php echo get_the_title(gt_get_option('box_2_link')); ?></a></h2>
        </div>
        <div class="box-text">
          <?php echo gt_get_option('box_2_text'); ?><br>
          <a class="btn-black" href="index.php?page_id=<?php echo gt_get_option('box_2_link'); ?>"><?php _e('Continue', 'guerilla'); ?></a>
        </div>
      </div>
    </div>
    <div class="span4">
      <div class="box">
        <div class="box-icon">
          <i class="icon-<?php echo gt_get_option('box_3_icon'); ?>"></i>
        </div>
        <div class="box-title">
          <h2><a href="index.php?page_id=<?php echo gt_get_option('box_3_link'); ?>"><?php echo get_the_title(gt_get_option('box_3_link')); ?></a></h2>
        </div>
        <div class="box-text">
          <?php echo gt_get_option('box_3_text'); ?><br>
          <a class="btn-black" href="index.php?page_id=<?php echo gt_get_option('box_3_link'); ?>"><?php _e('Continue', 'guerilla'); ?></a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>
<?php 

/* ==========================================================================
   Page Content
   ========================================================================== */
?>
<div id="wrap" class="container" role="document">
  <div id="content" class="row">
    <div id="main" class="<?php roots_main_class(); ?>" role="main">
      <?php get_template_part('templates/content', 'page'); ?>
    </div>
  </div>
</div>
<?php 

/* ==========================================================================
   Featured Articles
   ========================================================================== */

if(gt_get_option('featured_article_1') || gt_get_option('featured_article_2') || gt_get_option('featured_article_3') || gt_get_option('featured_article_4')) {
?>
  <div id="section-container">
    <div class="container">
      <div class="row recent-title">
        <h2 class="span12"><?php echo gt_get_option('featured_title'); ?></h2>
      </div>
      <div class="row recent-posts">

      <?php 
        if(gt_get_option('featured_article_1')) { $featured_post_id = gt_get_option('featured_article_1'); featured_query(); } 
        if(gt_get_option('featured_article_2')) { $featured_post_id = gt_get_option('featured_article_2'); featured_query(); } 
        if(gt_get_option('featured_article_3')) { $featured_post_id = gt_get_option('featured_article_3'); featured_query(); } 
        if(gt_get_option('featured_article_4')) { $featured_post_id = gt_get_option('featured_article_4'); featured_query(); } 
      ?>

      </div>
    </div>
  </div>
<?php }

function featured_query() { 
    global $featured_post_id;
    $post_id = $featured_post_id;
    query_posts('p='. $post_id); 

    while( have_posts() ): the_post(); 
      
        if (get_post_format() == 'video') {
          $post_icon = 'icon-film';
        } elseif (get_post_format() == 'image') {
          $post_icon = 'icon-picture';
        } else {
          $post_icon = 'icon-file-alt';
        }
      ?>

      <div class="span3">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
              <h4><i class="<?php echo $post_icon; ?>"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </header>
            <div class="entry-content">
              <?php if (get_post_format() == 'video') { ?>
                <?php
                global $post;
                $video_youtube = get_post_meta( $post->ID, '_video_youtube', true );
                $video_vimeo = get_post_meta( $post->ID, '_video_vimeo', true );
                ?>
                <?php if ($video_youtube) {echo '<div class=" fitvids">' . $video_youtube . '</div>';}  ?> 
                <?php if ($video_vimeo) {echo '<div class=" fitvids">' . $video_vimeo . '</div>';}  ?> 
              <?php } ?>
              <?php if ( has_post_thumbnail() && get_post_format() != 'video' ) { ?>
                <div class="">
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_post_thumbnail('image_870x490'); ?>
                </a>
                </div>
              <?php } ?>
              <div class="">
               <?php add_filter('excerpt_length', 'roots_home_excerpt_length'); the_excerpt(); ?>
              </div>
            </div>
          </article>
        </div>

    <?php endwhile;  
    wp_reset_query();
} 

/* ==========================================================================
   Video Section
   ========================================================================== */

if (gt_get_option('category_video')) {

  $cat_post_num = 7 ; 
  $posts_order = '' ;

  global $post;

    $category_video = gt_get_option('category_video');
    $cat_post_args = array(
      'numberposts' => $cat_post_num,
      'orderby' => $posts_order,
      'category__in' => $category_video
      );
    
    $cat_posts = get_posts($cat_post_args);
  ?>
  <div id="section-container" class="video-bg">
    <div class="container">
      <div class="row video-title">
        <h2 class="span12"><?php echo gt_get_option('video_title'); ?></h2>
      </div>
      <div class="row">
        <div class="span8">
          <div class="box-video">
              <a href="index.php?p=<?php echo gt_get_option('video_link'); ?>"><i class="icon-play-circle"></i></a>
              <h2><a href="index.php?p=<?php echo gt_get_option('video_link'); ?>"><?php echo get_the_title(gt_get_option('video_link')); ?></a></h2>
          </div>
        </div>
        <div class="span4">
          <div class=" box-video-list">
            <div class="box-video-title">
              <h2><?php echo get_the_category_by_id($category_video); ?></h2>
            </div>
            <div class="box-video-links">
              <?php
              echo '<ul class="category-posts">';
              foreach($cat_posts as $post) : setup_postdata($post);
              if (get_post_format() == 'video') {
                $post_icon = 'icon-film';
              } elseif (get_post_format() == 'image') {
                $post_icon = 'icon-picture';
              } else {
                $post_icon = 'icon-file-alt';
              }
              ?>
            
              <li><h4><i class="<?php echo $post_icon; ?>"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></li>

              <?php 
              endforeach;
              echo '</ul>';
              echo '<span class="label label-color"><a href="' . get_category_link( $category_video ) . '" title="">' . __('View all videos', 'guerilla') . ' <i class="icon-chevron-right"></i></a></span>';
              ?>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
<?php } ?>