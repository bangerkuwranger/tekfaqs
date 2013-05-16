<?php

// Return post entry meta information
function roots_entry_meta() {
    //echo '<i class="icon-user"></i> <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a> <time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s at %s.', 'guerilla'), get_the_date(), get_the_time()) .'</time>';
    echo ' <time class="updated" datetime="'. get_the_modified_date('c') .'" pubdate>' . __('Last Updated:', 'guerilla') . ' '. human_time_diff(get_the_modified_date('U'), current_time('timestamp')) . ' ' . __('ago', 'guerilla') . ' </time>';
	
}
