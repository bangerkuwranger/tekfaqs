<header id="banner" role="banner">
  <div class="container">
    <?php
    if (gt_get_option('logo_image')) { ?>
      <div class="logo">
        <a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo gt_get_option('logo_image'); ?>" alt="<?php bloginfo('name'); ?>"/></a>
      </div>
    <?php }
    else { ?>
      <div class="logo logo-text">
        <h1><a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      </div>
    <?php }
    ?>
    <nav id="nav-main" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) {
          wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_id' => 'menu', 'menu_class' => '', 'container' => false, 'depth' => 0, 'link_before' => '' ) );
        }
      ?>
    </nav>
  </div>
</header>
<?php 
  if (!is_page_template('page-home.php')) {
    get_template_part('templates/page', 'header'); 
  }
?>
