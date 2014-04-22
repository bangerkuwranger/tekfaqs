<?php get_template_part('templates/page', 'header'); ?>

<div class="row not-found">
	<h3>
		<?php _e('Sorry, but the page you were trying to view does not exist.', PRESSAPPS_TEXT_DOMAIN); ?>
	</h3>
	<div class="col-lg-8 col-lg-offset-2">
		<?php get_search_form(); ?>
	</div>
</div>

