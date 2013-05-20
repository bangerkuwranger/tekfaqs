<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <footer class="post-meta">
        <?php roots_entry_meta(); ?>
        <?php the_tags('<i class="icon-tags"></i> '); ?>
      </footer>
    </header>
    <div class="entry-content">
      <?php if (get_post_format() == 'video') { ?>
        <?php
        global $post;
        $video_youtube = get_post_meta( $post->ID, '_video_youtube', true );
        $video_vimeo = get_post_meta( $post->ID, '_video_vimeo', true );
        ?>
        <?php if ($video_youtube) {echo '<div class="fitvids">' . $video_youtube . '</div>';}  ?> 
        <?php if ($video_vimeo) {echo '<div class="fitvids">' . $video_vimeo . '</div>';}  ?> 
      <?php } ?>
      <?php if ( has_post_thumbnail() && get_post_format() != 'video' ) { ?>
        <?php the_post_thumbnail('image_1170x659'); ?>
      <?php } ?>
      <?php the_content(); ?>
    </div>
    <footer class="post-meta">
      <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'guerilla'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php if (gt_get_option('author_box')) {
      comments_template('/templates/author.php'); 
    } ?>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>