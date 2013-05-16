<div id="social-icons">
	<ul>
	<?php if (gt_get_option('twitter_icon')) { ?>
		<li class="social-icon twitter">
			<a class="fade-img" href="<?php echo gt_get_option('twitter_icon'); ?>" target="_blank" rel="tooltip" title="Twitter">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_twitter.png" alt="Twitter" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('facebook_icon')) { ?>
		<li class="social-icon facebook">
			<a class="fade-img" href="<?php echo gt_get_option('facebook_icon'); ?>" target="_blank" rel="tooltip" title="Facebook">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_facebook.png" alt="Facebook" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('gplus_icon')) { ?>
		<li class="social-icon gplus">
			<a class="fade-img" href="<?php echo gt_get_option('gplus_icon'); ?>" target="_blank" rel="tooltip" title="Google+">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_google.png" alt="Google+" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('linkedin_icon')) { ?>
		<li class="social-icon linkedin">
			<a class="fade-img" href="<?php echo gt_get_option('linkedin_icon'); ?>" target="_blank" rel="tooltip" title="LinkedIn">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_linkedin.png" alt="LinkedIn" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('vimeo_icon')) { ?>
		<li class="social-icon vimeo">
			<a class="fade-img" href="<?php echo gt_get_option('vimeo_icon'); ?>" target="_blank" rel="tooltip" title="Vimeo">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_vimeo.png" alt="Vimeo" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('youtube_icon')) { ?>
		<li class="social-icon youtube">
			<a class="fade-img" href="<?php echo gt_get_option('youtube_icon'); ?>" target="_blank" rel="tooltip" title="YouTube">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_youtube.png" alt="YouTube" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('flickr_icon')) { ?>
		<li class="social-icon flickr">
			<a class="fade-img" href="<?php echo gt_get_option('flickr_icon'); ?>" target="_blank" rel="tooltip" title="Flickr">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_flickr.png" alt="Flickr" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('pinterest_icon')) { ?>
		<li class="social-icon pinterest">
			<a class="fade-img" href="<?php echo gt_get_option('pinterest_icon'); ?>" target="_blank" rel="tooltip" title="Pinterest">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_pinterest.png" alt="Pinterest" />
			</a>
		</li>
	<?php } ?>
	<?php if (gt_get_option('rss_icon')) { ?>
		<li class="social-icon rss">
			<a class="fade-img" href="<?php echo gt_get_option('rss_icon'); ?>" target="_blank" rel="tooltip" title="RSS">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/social/icons_rss.png" alt="RSS" />
			</a>
		</li>
	<?php } ?>
    </ul>
</div>