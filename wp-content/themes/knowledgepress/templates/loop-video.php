  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
      <h2><i class="icon-film"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php 
        if (comments_open()) {
          echo '<div class="loop-like"><span class="label label-likes"><i class="icon-comment"></i> ';
          comments_number( '0', '1', '%' );
          echo '</span></div>';
        }
      ?>    
    </header>
    <div class="entry-content">
      <?php
      global $post;
      $video_youtube = get_post_meta( $post->ID, '_video_youtube', true );
      $video_vimeo = get_post_meta( $post->ID, '_video_vimeo', true );
      ?>
      <?php if ($video_youtube) {echo '<div class="fitvids">' . $video_youtube . '</div>';}  ?> 
      <?php if ($video_vimeo) {echo '<div class="fitvids">' . $video_vimeo . '</div>';}  ?> 

      <?php if ( !$video_youtube && !$video_vimeo ) { ?>
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
          <?php the_post_thumbnail('image_870x490'); ?>
        </a>
      <?php } ?>
        <?php the_excerpt(); ?>
        <footer class="post-meta">
          <?php roots_entry_meta(); ?>
          <?php the_tags('<i class="icon-tags"></i> '); ?>
        </footer>
    </div>
  </article>

