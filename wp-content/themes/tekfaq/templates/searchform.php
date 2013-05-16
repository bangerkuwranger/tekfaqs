<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
  <label class="hide" for="s"><?php _e('Search for:', 'guerilla'); ?></label>
  <input type="text" value="" name="s" id="s" class="search-query" placeholder="<?php _e('Search', 'guerilla'); ?> <?php bloginfo('name'); ?>">
</form>