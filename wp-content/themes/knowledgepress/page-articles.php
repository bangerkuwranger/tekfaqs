<?php 
/*
Template Name: Articles
*/
?>

<?php get_template_part('templates/page', 'title'); ?>

<?php
$args = array('orderby' => 'ID', 'order' => 'DESC', 'paged' => get_query_var('paged'));
$wp_query = new WP_Query($args);
if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
	<?php get_template_part('templates/loop', get_post_format()); ?>
<?php endwhile; endif; ?>

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