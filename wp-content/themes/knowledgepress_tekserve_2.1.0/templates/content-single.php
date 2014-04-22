<?php $options = get_option( PRESSAPPS_OPTIONS ); ?>
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>    <?php pressapps_post_media(); ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php get_template_part('templates/entry-meta'); ?>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php 
    if ( $options['blog_author'] ) {
      get_template_part('templates/author');
    } 
    ?>
    <?php 
    if ( comments_open() ) {
      comments_template('/templates/comments.php'); 
    } 
    ?>
  </article>
<?php endwhile; ?>