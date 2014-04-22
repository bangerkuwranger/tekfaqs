<?php
/*
Template Name: Home
*/
?>

<?php
global $post;

$subtitle = get_post_meta( $post->ID, '_subtitle', true );
$hero_menu_title = get_post_meta( $post->ID, '_hero_menu_title', true );

$boxes = get_post_meta( $post->ID, '_boxes', true );
$box_icon_left = get_post_meta( $post->ID, '_box_icon_left', true );
$box_title_left = get_post_meta( $post->ID, '_box_title_left', true );
$box_link_left = get_post_meta( $post->ID, '_box_link_left', true );
$box_content_left = get_post_meta( $post->ID, '_box_content_left', true );
$box_icon_middle = get_post_meta( $post->ID, '_box_icon_middle', true );
$box_title_middle = get_post_meta( $post->ID, '_box_title_middle', true );
$box_link_middle = get_post_meta( $post->ID, '_box_link_middle', true );
$box_content_middle = get_post_meta( $post->ID, '_box_content_middle', true );
$box_icon_right = get_post_meta( $post->ID, '_box_icon_right', true );
$box_title_right = get_post_meta( $post->ID, '_box_title_right', true );
$box_link_right = get_post_meta( $post->ID, '_box_link_right', true );
$box_content_right = get_post_meta( $post->ID, '_box_content_right', true );

$featured_title = get_post_meta( $post->ID, '_featured_title', true );
$featured_post_1 = get_post_meta( $post->ID, '_featured_post_1', true );
$featured_post_2 = get_post_meta( $post->ID, '_featured_post_2', true );
$featured_post_3 = get_post_meta( $post->ID, '_featured_post_3', true );
$featured_post_4 = get_post_meta( $post->ID, '_featured_post_4', true );

$video_title = get_post_meta( $post->ID, '_video_title', true );
$video_category = get_post_meta( $post->ID, '_video_category', true );
$video_player_link = get_post_meta( $post->ID, '_video_player_link', true );
?>

<?php 
/* ==========================================================================
   Hero Search
   ========================================================================== */
?>
<div id="hero">
  <div class="container">

    <div class="row">
      <div class="col-sm-12">
        <h1><?php the_title(); ?></h1>
        <?php
        if ( $subtitle ) {
          echo '<p class="subtitle">' . $subtitle . '</p>';
        }
        ?>
      </div>
    </div>  

    <div class="row">
      <?php //if (has_nav_menu('home_navigation')) { ?>
        <div class="hero-box col-sm-8 col-sm-offset-2">

            <form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
              <div class="input-group">
                <input type="text" id="autocomplete-ajax" name="s" id="s" class="searchajax search-query form-control input-lg" autocomplete="off" placeholder="<?php _e('Find help! Enter search term here.',PRESSAPPS_TEXT_DOMAIN); ?>">
                <span class="input-group-btn">
                  <input type="submit" id="searchsubmit" value="<?php _e('Search', PRESSAPPS_TEXT_DOMAIN); ?>" class="btn">
                </span>
              </div>
            </form>
            <script> _url = '<?php echo home_url(); ?>';</script>
        </div>   
      <?php //} ?>
    </div>  

    <?php 
    /* ==========================================================================
       Boxes
       ========================================================================== */
    ?>
    <?php if ( $boxes ) { ?>
      <?php 
        if ( $boxes == 2 ) { 
          $box_class = 'col-sm-6';
        } else {
          $box_class = 'col-sm-4';
        }
      ?>
      <div id="boxes">
        <div class="row">
          <div class="<?php echo $box_class; ?>">
            <article class="box">
              <a href="<?php echo $box_link_left; ?>"><i class="icon-<?php echo $box_icon_left; ?>"></i></a>
              <h2><a href="<?php echo $box_link_left; ?>"><?php echo $box_title_left; ?></a></h2>
              <p><?php echo $box_content_left; ?></p>
              <a class="btn" href="<?php echo $box_link_left; ?>"><?php _e('Continue', PRESSAPPS_TEXT_DOMAIN); ?></a>
            </article>
          </div>
          <?php if ( $boxes != 2 ) { ?>
            <div class="<?php echo $box_class; ?>">
              <article class="box">
                <a href="<?php echo $box_link_middle; ?>"><span></span><i class="icon-<?php echo $box_icon_middle; ?>"></i></a>
                <h2><a href="<?php echo $box_link_middle; ?>"><?php echo $box_title_middle; ?></a></h2>
                <p><?php echo $box_content_middle; ?></p>
                <a class="btn" href="<?php echo $box_link_middle; ?>"><?php _e('Continue', PRESSAPPS_TEXT_DOMAIN); ?></a>
              </article>
            </div>
          <?php } ?>
          <div class="<?php echo $box_class; ?>">
            <article class="box">
              <a href="<?php echo $box_link_right; ?>"><span></span><i class="icon-<?php echo $box_icon_right; ?>"></i></a>
              <h2><a href="<?php echo $box_link_right; ?>"><?php echo $box_title_right; ?></a></h2>
              <p><?php echo $box_content_right; ?></p>
              <a class="btn" href="<?php echo $box_link_right; ?>"><?php _e('Continue', PRESSAPPS_TEXT_DOMAIN); ?></a>
            </article>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>
</div><!-- /#hero -->


<?php
/* ==========================================================================
   Page Content
   ========================================================================== */

while (have_posts()) : the_post(); ?>
  <?php if ($content = $post->post_content) { ?>
    <div id="home-content">
      <div class="container">
        <div class="row">
          <div class="<?php echo roots_main_class(); ?>" role="main">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php endwhile; ?>

<?php
/* ==========================================================================
   Featured Articles
   ========================================================================== */

if($featured_post_1 || $featured_post_2 || $featured_post_3 || $featured_post_4) {
?>
  <div id="home-featured">
    <div class="container">
      <div class="row recent-title">
        <h2 class="col-sm-12"><?php echo $featured_title; ?></h2>
      </div>
      <div class="row recent-posts">

      <?php 
        if($featured_post_1) { $featured_post_id = $featured_post_1; featured_query(); } 
        if($featured_post_2) { $featured_post_id = $featured_post_2; featured_query(); } 
        if($featured_post_3) { $featured_post_id = $featured_post_3; featured_query(); } 
        if($featured_post_4) { $featured_post_id = $featured_post_4; featured_query(); } 
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
      
    ?>

      <div class="col-sm-3">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
              <h4 class="entry-title"><i class="<?php echo post_icon(); ?>"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </header>
              <?php if (get_post_format() == 'video') { ?>
                <?php
                global $post;
                $video = get_post_meta( $post->ID, '_video', true );
                ?>
                <?php if ($video) {echo '<div class="entry-media fitvids">' . $video . '</div>';}  ?> 
              <?php } ?>
              <?php if ( has_post_thumbnail() && get_post_format() != 'video' ) { ?>
                <div class="entry-media">
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_post_thumbnail('image_870x490'); ?>
                </a>
                </div>
              <?php } ?>
              <div class="entry-content">
               <?php add_filter('excerpt_length', 'roots_home_excerpt_length'); the_excerpt(); ?>
              </div>
          </article>
        </div>

    <?php endwhile;  
    wp_reset_query();
} 

/* ==========================================================================
   Video Section
   ========================================================================== */
if ($video_category) {

  $cat_post_num = 8 ; 
  $posts_order = '' ;

  $cat_post_args = array(
    'numberposts' => $cat_post_num,
    'orderby' => $posts_order,
    'category__in' => $video_category
    );
  
  $cat_posts = get_posts($cat_post_args);
  ?>
  <div id="home-video">
    <div class="container">
      <div class="row video-title">
        <h2 class="col-sm-12"><?php echo $video_title; ?></h2>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="box-video">
              <a href="index.php?p=<?php echo $video_player_link; ?>"><i class="icon-play-circle"></i></a>
              <h3><a href="index.php?p=<?php echo $video_player_link; ?>"><?php echo get_the_title($video_player_link); ?></a></h3>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="box-video-list">
            <h3><?php echo get_the_category_by_id($video_category); ?></h3>
              <?php echo '<ul>';
              foreach($cat_posts as $post) : setup_postdata($post);
              ?>
            
                <li><h4><i class="<?php echo post_icon(); ?> icon-fixed-width"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></li>

              <?php 
              endforeach;
              wp_reset_postdata();
              echo '</ul>';
              echo '<span class="label label-primary"><a href="' . get_category_link( $video_category ) . '" title="">' . __('View all videos', PRESSAPPS_TEXT_DOMAIN) . ' <i class="icon-chevron-right"></i></a></span>';
              ?>
          </div>  
        </div>
      </div>
    </div>
  </div>
<?php } ?>

