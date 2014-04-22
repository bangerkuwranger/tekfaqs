<?php $options = get_option( PRESSAPPS_OPTIONS ); ?>
<div class="main-header">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-lg-8">
        <h1><?php echo $options['header_title']; ?></h1>
        <p class="tagline"><?php echo $options['header_subtitle']; ?></p>
      </div>
      <div class="col-sm-4 col-lg-4">
        <?php 
        if ($options['header_search']) {
          get_search_live(); 
        } 
        ?>
      </div>
    </div>
  </div>
</div>