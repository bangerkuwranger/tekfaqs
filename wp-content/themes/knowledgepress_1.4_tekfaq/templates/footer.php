<div id="footer-container">
  <footer id="content-info" class="container" role="contentinfo">
  	<div class="row">
      <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>
  </footer>
</div>
<div id="footer-sub">
  <footer class="container" role="contentinfo">
  	<?php copyright_text_function(); ?>
  </footer>
  <?php wp_footer(); ?>
</div>
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
<script type="text/javascript">
var fby = fby || [];
fby.push(['showTab', {id: '6779', position: 'left', color: '#40A8C9'}]);
(function () {
    var f = document.createElement('script'); f.type = 'text/javascript'; f.async = true;
    f.src = '//cdn.feedbackify.com/f.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(f, s);
})();
</script>