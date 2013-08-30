<div id="footer-container">
  <footer id="content-info" class="container" role="contentinfo">
  	<div class="row">
      <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>
  </footer>
</div>
<div id="footer-sub">
  <footer class="container" role="contentinfo">
    <?php social_icons() ?>
  	<?php copyright_text_function(); ?>
  </footer>
  <?php wp_footer(); ?>
</div>

