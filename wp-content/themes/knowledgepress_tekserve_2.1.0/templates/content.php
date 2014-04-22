<article <?php post_class(); ?>>
  <header>
     <?php 
      if (comments_open()) {
        echo '<div class="loop-comments"><i class="icon-comment"></i> ';
        comments_number( '0', '1', '%' );
        echo '</div>';
      }
    ?>    
   <h2 class="entry-title"><i class="icon <?php echo post_icon(); ?>"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
  <?php pressapps_post_media(); ?>
	<div class="entry-content">
    	<?php pressapps_post_content(); ?>
	</div>
	<footer>
    	<?php get_template_part('templates/entry-meta'); ?>
  </footer>
</article>