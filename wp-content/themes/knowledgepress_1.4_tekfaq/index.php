<?php get_template_part('templates/page', 'title'); ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e('Sorry, no results were found.', 'guerilla'); ?></p>
  </div>
  <?php // get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part('templates/loop', get_post_format()); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
	<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
        
        <?php page_navi(); // use the page navi function ?>
        
    <?php } else { // if it is disabled, display regular wp prev & next links ?>
      <nav id="post-nav" class="pager">
        <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'guerilla')); ?></div>
        <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'guerilla')); ?></div>
      </nav>
    <?php } ?>		
<?php endif; ?>