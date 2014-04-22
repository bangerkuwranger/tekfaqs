<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
	<div class="append-icon">
		<input type="text" value="" name="s" id="autocomplete-ajax" class="searchajax search-query form-control input-lg" autocomplete="off" placeholder="<?php _e('Enter search term here.',PRESSAPPS_TEXT_DOMAIN); ?>">
		<span><i class="icon-search"></i></span>
	</div>
</form>
<script> _url = '<?php echo home_url(); ?>';</script>
