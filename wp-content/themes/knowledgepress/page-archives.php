<?php
/*
Template Name: Archives
*/
?>
<?php get_template_part('templates/page', 'title'); ?>
<div class="page-main">
	<div id="container">
		<div id="content" role="main" class="page-archives">
				<?php the_post(); ?>
				<h2><?php _e('Archives by Month:', 'guerilla'); ?></h2>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<br>
				<h2><?php _e('Archives by Subject:', 'guerilla'); ?></h2>
				<ul>
					 <?php wp_list_categories(); ?>
				</ul>
		</div><!-- #content -->
	</div><!-- #container -->
</div>