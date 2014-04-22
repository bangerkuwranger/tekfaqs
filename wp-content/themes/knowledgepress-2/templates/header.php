<?php $options = get_option( PRESSAPPS_OPTIONS ); ?>
<header class="banner navbar navbar-static-top" role="banner">
  <div class="container">

    <div class="navbar-header">

      <?php if ($options['logo']) { ?>
        <div class="navbar-brand">
          <a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo $options['logo']; ?>" alt="<?php bloginfo('name'); ?>"/></a>
        </div>
      <?php } else { ?>
        <div class="navbar-brand">
          <h1><a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
        </div>
      <?php } ?>

      <button data-target=".nav-responsive" data-toggle="collapse" type="button" class="navbar-toggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <nav class="nav-main hidden-xs" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
    </nav>

    <div class="visible-xs">

      <nav class="nav-responsive collapse" role="navigation">
        <?php
         // wp_nav_menu(array('theme_location' => 'responsive_navigation', 'menu_class' => 'nav'));

        if (has_nav_menu('responsive_navigation')) {
          $menu_name = 'responsive_navigation';
        } else {
          $menu_name = 'primary_navigation';
        }

        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {

          $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

          $menu_items = wp_get_nav_menu_items($menu->term_id);

          $menu_list = '<ul class="nav">';

          foreach ( (array) $menu_items as $key => $menu_item ) {
              $title = $menu_item->title;
              $url = $menu_item->url;
              $submenu = '';
              if ( $menu_item->menu_item_parent > 0) {
                $submenu = ' class="responsive-submenu"';
              }

              $menu_list .= '<li><a' . $submenu . ' href="' . $url . '">' . $title . '</a></li>';
          }
          $menu_list .= '</ul>';

        } else {

          $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';

        }

        echo $menu_list;

        ?>
       </nav>

    </div>

  </div>
</header>
