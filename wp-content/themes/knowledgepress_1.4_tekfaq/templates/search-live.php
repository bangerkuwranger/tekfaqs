<form role="search" method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url('/') ); ?>">
  <label class="hide" for="s"><?php _e('Search for:', 'guerilla'); ?></label>
  <input type="text" value="" name="s" id="autocomplete-ajax" class="searchajax search-query span4" autocomplete="off" placeholder="<?php _e('Enter search term here.','guerilla'); ?>">
</form>
<script> _url = '<?php echo home_url(); ?>';</script>