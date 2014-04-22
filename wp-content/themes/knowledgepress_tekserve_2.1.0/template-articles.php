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
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <?php page_navi(); // use the page navi function ?>
<?php endif; ?>
