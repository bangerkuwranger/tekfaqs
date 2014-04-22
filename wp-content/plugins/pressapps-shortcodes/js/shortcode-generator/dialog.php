<?php 
// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );
                                   
$gp_framework_version = get_option( 'gp_framework_version' );

//$gp_framework_path = dirname(__FILE__) .  '/../../';

$gp_framework_url = plugins_url('',dirname(__FILE__));

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="gp-dialog">

<div id="gp-options-buttons" class="clear">
	<div class="alignleft">
	
	    <input type="button" id="gp-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
	    
	</div>
	<div class="alignright">
	
	    <input type="button" id="gp-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />
	    
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#gp-options-buttons .clear-->

<div id="gp-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'pressapps' ); ?></h3>
    
	<table id="gp-options-table">
	</table>

</div>

<div class="clear"></div>


<script type="text/javascript" src="<?php echo $gp_framework_url; ?>/shortcode-generator/js/column-control.js"></script>
<script type="text/javascript" src="<?php echo $gp_framework_url; ?>/shortcode-generator/js/tab-control.js"></script>
<script type="text/javascript" src="<?php echo $gp_framework_url; ?>/shortcode-generator/js/dialog-js.php"></script>

</div>

</body>
</html>