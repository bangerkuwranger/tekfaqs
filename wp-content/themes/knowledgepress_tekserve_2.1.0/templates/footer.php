<?php $options = get_option( PRESSAPPS_OPTIONS ); ?>
<footer id="content-info" class="content-info" role="contentinfo">
  <div class="footer-widgets">
	  <div class="container">
		  <div class="row">
		  	<?php dynamic_sidebar('sidebar-footer'); ?>
		  </div>
	  </div>
  </div>
  <div class="footer-info">
	  <div class="container">
		  <div class="row">
		    <div class="col-lg-12">
				<?php get_template_part('templates/social-icons'); ?>
		        <?php if (has_nav_menu('footer_navigation')) { ?>
		        	<nav role="navigation">
		            	<?php wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'depth' => 1 ) ); ?>
		            </nav>
		        <?php } ?>
				<?php if ($options['copyright']) {
					echo '<p class="copyright">' . $options['copyright'] . '</p>'; 
				} ?>
		    </div>
		  </div>
	  </div>
  </div>
</footer>
<script type="text/javascript">
piAId = '35292';
piCId = '1096';

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>
<?php wp_footer(); ?>

<?php if ( is_page_template('template-home.php') || is_page_template('template-home2.php') ) {
	hero_background();
} ?>