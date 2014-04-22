<?php
/**
 * Plugin Name: Tekserve Single Post Shortcode
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin to create a shortcode for showing the title, post info, excerpt, and thumbnail for a single post.
 * Version: 1.4
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2013 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


/** shortcode to display a single post */

// add shortcode
function tekserve_single_post( $atts ) {

	// attributes
	extract( shortcode_atts(
		array(
			'id' => '',
			'showimage' => '',
			'buttontext' => '',
		), $atts )
	);

	// display code
	$title = '<h2 class="tekserve-single-post-title">' . get_the_title( $id ) . '</h2>';
	$authorid = get_post_field( 'post_author', $id );
	$author = get_the_author_meta( 'display_name', $authorid );
	// php process date to pretty format
	$datestr = get_post_field( 'post_date', $id );
	$date = DateTime::createFromFormat('Y-m-d H:i:s', $datestr);
	$date = $date->format('D, M j, Y');
	$excerpt = substr(get_post_field( 'post_content', $id, 'raw' ), 0, 90);
	$excerpt = '<div id="tekserve-single-post-excerpt">' . strip_tags($excerpt) . '...</div>';
	if( get_post_field( 'post_excerpt', $id ) != '' ) {
		$excerpt = get_post_field( 'post_excerpt', $id );
		$excerpt = '<div class="tekserve-single-post-excerpt">' . rtrim($excerpt) . '...</div>';
	}
	$meta = '<div class="tekserve-single-post-meta">' . $date . ' by ' . $author . '</div>';
	$thumb = get_the_post_thumbnail($id, array(200,200));
	//show continue button if selected with selected text
	if($buttontext) {
		$excerpt = $excerpt . '<div class="tekserve-single-post-button">' . $buttontext . '</div>';
	}
	// show or hide thumb based on attr
	if($showimage == "show") {
		return '<div id="single-post-' . $id . '" class="tekserve-single-post"> <a href="' . get_permalink( $id ) . '">' . $thumb . $title . $meta . $excerpt . '</a></div>';
	}
	else {
		return '<div id="single-post-' . $id . '" class="tekserve-single-post"> <a href="' . get_permalink( $id ) . '">' . $title . $meta . $excerpt . '</a></div>';
	}
}
add_shortcode( 'single_post', 'tekserve_single_post' );

/** widget to display a single post */

class Tekserve_Single_Post_Widget extends WP_Widget {

	public function __construct() {
		// widget actual processes
		parent::__construct(
			'tekserve_single_post_widget', // Base ID
			__('Tekserve Single Post Widget', 'text_domain'), // Name
			array( 'description' => __( 'Display a single post preview based on post id', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		// these are the widget options
		$id = $instance['id'];
		$showimage = $instance['showimage'];
		$buttontext = $instance['buttontext'];
		echo $before_widget;
		// Display the widget
		// check if id is set
		if( $id ) {
			echo '<div id="single-post-' . $id . '" class="tekserve-single-post"> <a href="' . get_permalink( $id ) . '">';
			// check if showimage is checked, show image if so
			//if( $showimage AND $showimage == '1' ) {
				echo get_the_post_thumbnail( $id, array(200,200) );
			//}
			echo '<h2 class="tekserve-single-post-title">' . get_the_title( $id ) . '</h2>';
			//php process author name
			$author = get_post_field( 'post_author', $id );
			$author = get_the_author_meta( 'display_name', $author );
			// php process date to pretty format
			$datestr = get_post_field( 'post_date', $id );
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $datestr);
			$date = $date->format('D, M j, Y');
			//concat meta
			$meta = '<div class="tekserve-single-post-meta">' . $date . ' by ' . $author . '</div>';
			echo $meta;
			//process excerpt
			$excerpt = substr(get_post_field( 'post_content', $id ), 0, 90);
			if( get_post_field( 'post_excerpt', $id ) != '' ) {
				$excerpt = get_post_field( 'post_excerpt', $id );
			}
			$excerpt = '<div class="tekserve-single-post-excerpt">' . rtrim($excerpt) . '...</div>';
			echo $excerpt;
			if( $buttontext ) {
				$buttontext = '<div class="tekserve-single-post-button">' . $buttontext . '</div>';
				echo $buttontext;
			}
			echo '</a></div>';
		}
		echo $after_widget;
	}

 	public function form( $instance ) {
		// outputs the options form on admin
		
		// check values
		if( $instance) {
			 $id = esc_attr($instance['id']);
			 $showimage = esc_textarea($instance['showimage']);
			 $buttontext = esc_textarea($instance['buttontext']);
		} else {
			 $id = '';
			 $showimage = '';
			 $buttontext = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Post ID:', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('showimage'); ?>" name="<?php echo $this->get_field_name('showimage'); ?>" type="checkbox" value="1" <?php checked( '1', $showimage ); ?> />
			<label for="<?php echo $this->get_field_id('showimage'); ?>"><?php _e('Show Image?', 'wp_widget_plugin'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php _e('Text for Button (leave blank for none):', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" type="text" value="<?php echo $buttontext; ?>" />
		</p>
		<?php
	}


	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
    	// Fields
    	$instance['id'] = strip_tags($new_instance['id']);
    	$instance['showimage'] = strip_tags($new_instance['showimage']);
    	$instance['buttontext'] = strip_tags($new_instance['buttontext']);
    	return $instance;
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'Tekserve_Single_Post_Widget' );
});