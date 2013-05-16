<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <?php get_template_part('templates/header'); ?>

  <?php if (is_page_template('page-home.php')) { ?>

    <?php include roots_template_path(); ?>

  <?php } else { ?>

    <div id="wrap" class="container" role="document">
      <div id="content" class="row">
        <div id="main" class="<?php roots_main_class(); ?>" role="main">
          <?php include roots_template_path(); ?>
        </div>
        <?php if (roots_sidebar()) : ?>
        <aside id="sidebar" class="<?php roots_sidebar_class(); ?>" role="complementary">
          <?php get_template_part('templates/sidebar'); ?>
        </aside>
        <?php endif; ?>
      </div><!-- /#content -->
    </div><!-- /#wrap -->

  <?php } ?>

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
