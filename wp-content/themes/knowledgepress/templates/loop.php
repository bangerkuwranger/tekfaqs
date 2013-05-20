  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
      <h2><i class="icon-file-alt"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php 
        if (comments_open()) {
          echo '<div class="loop-like"><span class="label label-likes"><i class="icon-comment"></i> ';
          comments_number( '0', '1', '%' );
          echo '</span></div>';
        }
      ?>    
    </header>
    <div class="entry-content">
      <?php the_excerpt(); ?>
    </div>
    <footer class="post-meta">
      <?php roots_entry_meta(); ?>
      <?php the_tags('<i class="icon-tags"></i> '); ?>
    </footer>
  </article>