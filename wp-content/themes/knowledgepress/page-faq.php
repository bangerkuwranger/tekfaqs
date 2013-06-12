<?php
/*
Template Name: Faq
*/
?>
<?php get_template_part('templates/page', 'title'); ?>
<a name="top"></a>
<div class="faq-top">
  <?php $pf_terms = get_categories( 'type=faq&taxonomy=faq_category&orderby=slug' ); ?>

  <?php 
  if ($pf_terms) {
 
    foreach( $pf_terms as $pf_term ) : ?>
    <ul>
    <li><h2><a href="#<?php echo $pf_term->slug; ?>"><?php echo $pf_term->name; ?></a></h2></li>

      <?php
      $args = array(
        'tax_query' => array(
          array(
            'taxonomy' => 'faq_category',
            'field' => 'slug',
            'terms' => $pf_term->slug
          ),
        ),
        'posts_per_page' => '-1',
      );

      $wp_query = new WP_Query($args);
      if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>

        <h4 id="faq-<?php echo get_the_ID(); ?>" class="entry-title"><i class="icon-chevron-down"></i> <a href="#<?php the_ID(); ?>"><?php the_title(); ?></a></h4>

      <?php endwhile; endif; ?>
    </ul>

    <?php endforeach;

  } else {
      $args = array(
              'post_type' => 'faq',
              );

      $wp_query = new WP_Query($args);
      if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>

        <h4 id="faq-<?php echo get_the_ID(); ?>" class="entry-title"><i class="icon-chevron-down"></i> <a href="#<?php the_ID(); ?>"><?php the_title(); ?></a></h4>

      <?php endwhile; endif; 
  }
  ?>
</div>
<?php $pf_terms = get_categories( 'type=faq&taxonomy=faq_category' );
if ($pf_terms) {
  foreach( $pf_terms as $pf_term ) : ?>
  <div><h2 class="faq-section-heading"><a name="<?php echo $pf_term->slug; ?>"></a><?php echo $pf_term->name; ?></h2></div>

    <?php
    $args = array(
      'tax_query' => array(
        array(
          'taxonomy' => 'faq_category',
          'field' => 'slug',
          'terms' => $pf_term->slug
        )
      ),
      'posts_per_page' => '-1',
    );

    $wp_query = new WP_Query($args);
    if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
            
              <h3 id="faq-<?php echo get_the_ID(); ?>" class="entry-title"><a name="<?php the_ID(); ?>"></a><?php the_title(); ?></h3>
              
              <div class="entry-content">
              <?php the_content(); ?>
                <i class="icon-chevron-up"></i> <a href="#top"><?php _e('Back To Top', 'guerilla'); ?></a>
              </div>
            
            </article>

    <?php endwhile; endif; ?>

  <?php endforeach; 
} else {

    $args = array(
            'post_type' => 'faq',
            );

    $wp_query = new WP_Query($args);
    if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
            
              <h3 id="faq-<?php echo get_the_ID(); ?>" class="entry-title"><a name="<?php the_ID(); ?>"></a><?php the_title(); ?></h3>
              
              <div class="entry-content">
              <?php the_content(); ?>
                <i class="icon-chevron-up"></i> <a href="#top"><?php _e('Back To Top', 'guerilla'); ?></a>
              </div>
            
            </article>

    <?php endwhile; endif;
}
