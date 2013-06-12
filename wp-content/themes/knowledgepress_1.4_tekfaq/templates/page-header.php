<div id="page-header-container">
  <div class="container">
    <div class="page-header row">
      <div class="span8">
        <h1><?php echo gt_get_option('header_title'); ?></h1>
        <p class="tagline"><?php echo gt_get_option('header_tagline'); ?></p>
      </div>
      <div class="span4">
        <?php 
        if (gt_get_option('search_bar')) {
          get_search_live(); 
        } 
        ?>
      </div>
    </div>
  </div>
</div>