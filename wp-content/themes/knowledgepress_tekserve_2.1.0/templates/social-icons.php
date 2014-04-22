<?php $options = get_option( PRESSAPPS_OPTIONS ); ?>
<?php if ($options['twitter_icon'] || $options['facebook_icon'] || $options['gplus_icon'] || $options['linkedin_icon'] || $options['vimeo_icon'] || $options['youtube_icon'] || $options['flickr_icon'] || $options['dribbble_icon'] || $options['rss_icon']) { ?>
		<ul class="social-icons">
		<?php if ($options['twitter_icon']) { ?>
			<li class="btn-social btn-twitter">
				<a href="<?php echo $options['twitter_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_twitter.png" alt="Twitter" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['facebook_icon']) { ?>
			<li class="btn-social btn-facebook">
				<a href="<?php echo $options['facebook_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_facebook.png" alt="Facebook" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['gplus_icon']) { ?>
			<li class="btn-social btn-google">
				<a href="<?php echo $options['gplus_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_google.png" alt="Google+" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['linkedin_icon']) { ?>
			<li class="btn-social btn-linkedin">
				<a href="<?php echo $options['linkedin_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_linkedin.png" alt="LinkedIn" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['vimeo_icon']) { ?>
			<li class="btn-social btn-vimeo">
				<a href="<?php echo $options['vimeo_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_vimeo.png" alt="Vimeo" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['youtube_icon']) { ?>
			<li class="btn-social btn-youtube">
				<a href="<?php echo $options['youtube_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_youtube.png" alt="YouTube" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['flickr_icon']) { ?>
			<li class="btn-social btn-flickr">
				<a href="<?php echo $options['flickr_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_flickr.png" alt="Flickr" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['dribbble_icon']) { ?>
			<li class="btn-social btn-dribbble">
				<a href="<?php echo $options['dribbble_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_dribbble.png" alt="Dribbble" />
				</a>
			</li>
		<?php } ?>
		<?php if ($options['rss_icon']) { ?>
			<li class="btn-social btn-rss">
				<a href="<?php echo $options['rss_icon']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/social/white/icons_rss.png" alt="RSS" />
				</a>
			</li>
		<?php } ?>
	    </ul>
<?php } ?>