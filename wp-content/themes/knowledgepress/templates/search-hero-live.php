<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
  <label class="hide" for="s"><?php _e('Search for:', 'guerilla'); ?></label>
  <input type="text" id="autocomplete-ajax" name="s" id="s" class="searchajax search-query" autocomplete="off" placeholder="<?php _e('Find help! Enter search term here.','guerilla'); ?>">
  <input type="submit" id="searchsubmit" value="<?php _e('Search', 'guerilla'); ?>" class="btn-black">
</form>
<script> _url = '<?php echo home_url(); ?>';</script>