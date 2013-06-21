<style type="text/css">
#aqsfformid {
border: none;
padding: 10px;
}
span.form_title {
font-weight: bold;
font-size: 18px;
color: #004a72;
margin: 10px;
line-height: 50px;
}
.awqsf_box {
margin-bottom: 10px;
display: inline-block;
padding: 10px;
color: #004a72;
}
.awqsf_box select {

}
input#awqsf_keyword {

}
label.awqsf-label-keyword {
position: relative;
left: -20px;
top: -17px;
}

p.awqsf-button {
position: relative;
top: 48px;
}

.page-title h1 {
max-width: 820px;
}
h3 {
margin: 13px 0 22px 20px;
}
#awqsf_keyword_box {
margin-top: 20px;
}
#awqsf_submit {
background: #f36f37;
color: white;
border: none;
border-radius:6px;
padding: 4px 8px;
}
#awqsf_submit:hover {
background:#40A8C9;
}
</style>
<?php get_template_part('templates/page', 'title'); ?>
<?php if (!have_posts()) 
{ ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e('Sorry, no results were found.', 'guerilla'); ?></p>
  </div>
  <?php // get_search_form(); ?>
<?php } else { ?>
<h3>Displaying <?php $num = $wp_query->post_count; if (have_posts()) : echo $num; endif;?> Results </h3>
<?php } ?>
<?php echo do_shortcode('[awsqf-form id=745]'); ?>
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