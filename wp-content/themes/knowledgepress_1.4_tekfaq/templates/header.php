<div id="wrap" class="container">
<div id="header">
<div id="title-area" style="background-image: url(http://maintekserve.wpengine.com/wp-content/themes/apparition1.1_tekserve/images/header.9-8.11-6@2x.svg);">
	<p id="title">
		<a href="http://faq.tekserve.com/" title="Tekserve FAQ"></a>
	</p>
</div>
<span id="tekserve-shared-data-hours-swap" style="display: none;">url(http://maintekserve.wpengine.com/wp-content/uploads/2014/02/mobileheader.9-8.11-6@2x.svg)</span>
</div>
</div>
<div id="nav" style="position: relative; top: -10px; width: 100%;">
<nav id="nav-main" role="navigation">
<?php
	if (has_nav_menu('primary_navigation')) {
		wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_id' => 'menu', 'menu_class' => '', 'container' => false, 'depth' => 0, 'link_before' => '' ) );
	}
?>
</nav>
</div>
</div>
</header>
<?php
if (!is_page_template('page-home.php')) {
get_template_part('templates/page', 'header'); 
wp_head();
}
?>
