<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/tekadds.js"></script>
    <?php favicon_function(); ?>
    <?php wp_head(); ?>
    <!-- theme options from options panel -->
    <?php theme_style_options(); ?>
    <script type="text/javascript">
      function changeCSS() {
 		var light = 'http://3civ7q19xq3z4d2wi812e1iujkj.wpengine.netdna-cdn.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/css/app.css';
 		var dark = 'http://3civ7q19xq3z4d2wi812e1iujkj.wpengine.netdna-cdn.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/css/appdark.css';
        var switcheroo = document.getElementById('contrastAndColor').className;
        var oldlink = document.getElementsByTagName("link").item(9);
 		if(switcheroo == 'light') {
        	var newlink = document.createElement("link")
        	newlink.setAttribute("rel", "stylesheet");
        	newlink.setAttribute("type", "text/css");
        	newlink.setAttribute("href", dark);
        	document.getElementById('contrastAndColor').className = 'dark';
        	document.getElementById('contrastAndColor').innerHTML = 'Increase Color';
        	document.getElementById('contrastAndColorImg').src = 'http://tekserve.wpengine.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/img/color.png';
        	}
        else {
        	var newlink = document.createElement("link")
        	newlink.setAttribute("rel", "stylesheet");
        	newlink.setAttribute("type", "text/css");
        	newlink.setAttribute("href", light);
        	document.getElementById('contrastAndColor').className = 'light';
        	document.getElementById('contrastAndColor').innerHTML = 'Increase Contrast';
        	document.getElementById('contrastAndColorImg').src = 'http://tekserve.wpengine.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/img/contrast.png';
        }
 		
        document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink);
      }
    </script>
<!--     <link rel="stylesheet" href="http://tekserve.wpengine.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/css/appdark.css"> -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>