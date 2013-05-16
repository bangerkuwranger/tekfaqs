<?php

function roots_widgets_init() {
  // Register widgetized areas
  register_sidebar(array(
    'name' => __('Primary Sidebar', 'guerilla'),
    'id' => 'sidebar-primary',
    'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    'after_widget' => '</div></section>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => __('Footer', 'guerilla'),
    'id' => 'sidebar-footer',
    'before_widget' => '<section id="%1$s" class="widget %2$s span3"><div class="widget-inner">',
    'after_widget' => '</div></section>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));

  // Register widgets
  register_widget('Roots_Vcard_Widget');
}
add_action('widgets_init', 'roots_widgets_init');

// Example vCard widget
class Roots_Vcard_Widget extends WP_Widget {
  function Roots_Vcard_Widget() {
    $widget_ops = array('classname' => 'widget_roots_vcard', 'description' => __('Use this widget to add contact details', 'guerilla'));
    $this->WP_Widget('widget_roots_vcard', __('Custom: Contact', 'guerilla'), $widget_ops);
    $this->alt_option_name = 'widget_roots_vcard';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_roots_vcard', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'guerilla') : $instance['title'], $instance, $this->id_base);
    if (!isset($instance['street_address'])) { $instance['street_address'] = ''; }
    if (!isset($instance['locality'])) { $instance['locality'] = ''; }
    if (!isset($instance['region'])) { $instance['region'] = ''; }
    if (!isset($instance['postal_code'])) { $instance['postal_code'] = ''; }
    if (!isset($instance['tel'])) { $instance['tel'] = ''; }
    if (!isset($instance['email'])) { $instance['email'] = ''; }

    echo $before_widget;
    if ($title) {
      echo $before_title;
      echo $title;
      echo $after_title;
    }
  ?>
    <p class="vcard">
      <a class="fn org url" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a><br>
      <span class="adr">
        <span class="street-address"><?php echo $instance['street_address']; ?></span><br>
        <span class="locality"><?php echo $instance['locality']; ?></span>,
        <span class="region"><?php echo $instance['region']; ?></span>
        <span class="postal-code"><?php echo $instance['postal_code']; ?></span><br>
      </span>
      <i class="icon-phone"></i> <span class="tel"><span class="value"><?php echo $instance['tel']; ?></span></span><br>
      <i class="icon-envelope-alt"></i> <a class="email" href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
    </p>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_roots_vcard', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['street_address'] = strip_tags($new_instance['street_address']);
    $instance['locality'] = strip_tags($new_instance['locality']);
    $instance['region'] = strip_tags($new_instance['region']);
    $instance['postal_code'] = strip_tags($new_instance['postal_code']);
    $instance['tel'] = strip_tags($new_instance['tel']);
    $instance['email'] = strip_tags($new_instance['email']);
    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');
    if (isset($alloptions['widget_roots_vcard'])) {
      delete_option('widget_roots_vcard');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_roots_vcard', 'widget');
  }

  function form($instance) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $street_address = isset($instance['street_address']) ? esc_attr($instance['street_address']) : '';
    $locality = isset($instance['locality']) ? esc_attr($instance['locality']) : '';
    $region = isset($instance['region']) ? esc_attr($instance['region']) : '';
    $postal_code = isset($instance['postal_code']) ? esc_attr($instance['postal_code']) : '';
    $tel = isset($instance['tel']) ? esc_attr($instance['tel']) : '';
    $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title (optional):', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('street_address')); ?>"><?php _e('Street Address:', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('street_address')); ?>" name="<?php echo esc_attr($this->get_field_name('street_address')); ?>" type="text" value="<?php echo esc_attr($street_address); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('locality')); ?>"><?php _e('City/Locality:', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('locality')); ?>" name="<?php echo esc_attr($this->get_field_name('locality')); ?>" type="text" value="<?php echo esc_attr($locality); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('region')); ?>"><?php _e('State/Region:', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('region')); ?>" name="<?php echo esc_attr($this->get_field_name('region')); ?>" type="text" value="<?php echo esc_attr($region); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('postal_code')); ?>"><?php _e('Zipcode/Postal Code:', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('postal_code')); ?>" name="<?php echo esc_attr($this->get_field_name('postal_code')); ?>" type="text" value="<?php echo esc_attr($postal_code); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('tel')); ?>"><?php _e('Telephone:', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel')); ?>" name="<?php echo esc_attr($this->get_field_name('tel')); ?>" type="text" value="<?php echo esc_attr($tel); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:', 'guerilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
    </p>
  <?php
  }
}


// custom recent post widget

class Custom_Recent_Posts_Widget extends WP_Widget {
      
  function __construct() {
      $widget_ops = array(
      'classname'   => 'widget_recent_entries', 
      'description' => __('Display a list of recent post entries from one or more categories.', 'guerilla')
    );
      parent::__construct('custom-recent-posts', __('Custom: Recent Posts', 'guerilla'), $widget_ops);
  }


  function widget($args, $instance) {
           
      extract( $args );
    
      $title = apply_filters( 'widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);  
      
      if ( ! $number = absint( $instance['number'] ) ) $number = 5;
            
      if( ! $cats = $instance["cats"] )  $cats='';
      
            
      // array to call recent posts.
      
      $crpw_args=array(
               
        'showposts' => $number,
      
        'category__in'=> $cats,
         
       // 'orderby' => 'comment_count'

       // 'post_type' => 'faq'
        );
      
      $crp_widget = null;
      
      $crp_widget = new WP_Query($crpw_args);
      
      
      echo $before_widget;
      
      
      // Widget title
      
      echo $before_title;
      
      echo $instance["title"];
      
      echo $after_title;
      
      
      // Post list in widget
      
      echo "<ul>\n";
      
    while ( $crp_widget->have_posts() )

    {

      $crp_widget->the_post();

        if (get_post_format() == 'video') {
        $post_icon = 'icon-film';
      } elseif (get_post_format() == 'image') {
        $post_icon = 'icon-picture';
      } else {
        $post_icon = 'icon-file-alt';
      }

    ?>

      <li class="crpw-item">

        <i class="<?php echo $post_icon; ?>"></i> <a  href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>" class="crpw-title"><?php the_title(); ?></a>
    
      </li>

    <?php

    }

     wp_reset_query();

    echo "</ul>\n";

    echo $after_widget;

  }
  
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
          $instance['cats'] = $new_instance['cats'];
    $instance['number'] = absint($new_instance['number']);
       
            return $instance;
  }
  
  
  function form( $instance ) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
    $number = isset($instance['number']) ? absint($instance['number']) : 5;
    
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'guerilla'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                  

                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'guerilla'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the recent posts list:', 'guerilla');?> 
            
                <?php
                   $categories=  get_categories('hide_empty=0');
                     echo "<br/>";
                     foreach ($categories as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if(isset($instance['cats'])) {
                              if (is_array($instance['cats'])) {
                                  foreach ($instance['cats'] as $cats) {
                                      if($cats==$cat->term_id) {
                                           $option=$option.' checked="checked"';
                                      }
                                  }
                              }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
        
                            $option .= $cat->cat_name;
                            
                            $option .= '<br />';
                            echo $option;
                         }
                    
                    ?>
            </label>
        </p>
        
<?php
  }
}

function crpw_register_widgets() {
  register_widget( 'Custom_Recent_Posts_Widget' );
}

add_action( 'widgets_init', 'crpw_register_widgets' );


// custom most popular posts widget

class Custom_Popular_Posts_Widget extends WP_Widget {
      
  function __construct() {
      $widget_ops = array(
      'classname'   => 'widget_recent_entries', 
      'description' => __('Display a list of popular post entries from one or more categories.', 'guerilla')
    );
      parent::__construct('custom-popular-posts', __('Custom: Popular Posts', 'guerilla'), $widget_ops);
  }


  function widget($args, $instance) {
           
      extract( $args );
    
      $title = apply_filters( 'widget_title', empty($instance['title']) ? 'Popular Posts' : $instance['title'], $instance, $this->id_base);  
      
      if ( ! $number = absint( $instance['number'] ) ) $number = 5;
            
      if( ! $cats = $instance["cats"] )  $cats='';
      
            
      // array to call recent posts.
      
      $cppw_args=array(
               
        'showposts' => $number,
      
        'category__in'=> $cats,
         
        'orderby' => 'comment_count'

       // 'post_type' => 'faq'
        );
      
      $cpp_widget = null;
      
      $cpp_widget = new WP_Query($cppw_args);
      
      
      echo $before_widget;
      
      
      // Widget title
      
      echo $before_title;
      
      echo $instance["title"];
      
      echo $after_title;
      
      
      // Post list in widget
      
      echo "<ul>\n";
      
    while ( $cpp_widget->have_posts() )

    {

      $cpp_widget->the_post();

        if (get_post_format() == 'video') {
        $post_icon = 'icon-film';
      } elseif (get_post_format() == 'image') {
        $post_icon = 'icon-picture';
      } else {
        $post_icon = 'icon-file-alt';
      }

    ?>

      <li class="crpw-item">

        <i class="<?php echo $post_icon; ?>"></i> <a  href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>" class="crpw-title"><?php the_title(); ?></a>
    
      </li>

    <?php

    }

     wp_reset_query();

    echo "</ul>\n";

    echo $after_widget;

  }
  
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
          $instance['cats'] = $new_instance['cats'];
    $instance['number'] = absint($new_instance['number']);
       
            return $instance;
  }
  
  
  function form( $instance ) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : 'Popular Posts';
    $number = isset($instance['number']) ? absint($instance['number']) : 5;
    
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'guerilla'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                  

                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'guerilla'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the popular posts list:', 'guerilla');?> 
            
                <?php
                   $categories=  get_categories('hide_empty=0');
                     echo "<br/>";
                     foreach ($categories as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if(isset($instance['cats'])) {
                              if (is_array($instance['cats'])) {
                                  foreach ($instance['cats'] as $cats) {
                                      if($cats==$cat->term_id) {
                                           $option=$option.' checked="checked"';
                                      }
                                  }
                              }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
        
                            $option .= $cat->cat_name;
                            
                            $option .= '<br />';
                            echo $option;
                         }
                    
                    ?>
            </label>
        </p>
        
<?php
  }
}

function cppw_register_widgets() {
  register_widget( 'Custom_Popular_Posts_Widget' );
}

add_action( 'widgets_init', 'cppw_register_widgets' );


/* ==========================================================================
   Flickr 
   ========================================================================== */


add_action( 'widgets_init', 'guerilla_flickr_widgets' );

function guerilla_flickr_widgets() {
  register_widget( 'guerilla_FLICKR_Widget' );
}

class guerilla_flickr_widget extends WP_Widget {
  
function guerilla_FLICKR_Widget() {

  $widget_ops = array(
    'classname' => 'guerilla_flickr_widget',
    'description' => __('Displays Flickr Photos.', 'guerilla')
  );

  $control_ops = array(
    'width' => 220,
    'height' => 350,
    'id_base' => 'guerilla_flickr_widget'
  );

  $this->WP_Widget( 'guerilla_flickr_widget', __('Custom Flickr Photos', 'guerilla'), $widget_ops, $control_ops );
  
}
  
function widget( $args, $instance ) {
  extract( $args );

  $title = apply_filters('widget_title', $instance['title'] );
  $flickrID = $instance['flickrID'];
  $postcount = $instance['postcount'];
  $type = $instance['type'];
  $display = $instance['display'];

  echo $before_widget;

  if ( $title ) { echo $before_title . $title . $after_title; }
?>
    
  <div class="flickr_badge_wrapper clearfix">
    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
  </div>
  
<?php
  echo $after_widget;
}

function update( $new_instance, $old_instance ) {
  $instance = $old_instance;
  $instance['title'] = strip_tags( $new_instance['title'] );
  $instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
  $instance['postcount'] = $new_instance['postcount'];
  $instance['type'] = $new_instance['type'];
  $instance['display'] = $new_instance['display'];

  return $instance;
}

function form( $instance ) {

  $defaults = array(
    'title' => 'Flickr Photos',
    'flickrID' => '',
    'postcount' => '8',
    'type' => 'user',
    'display' => 'latest',
  );
  
  $instance = wp_parse_args( (array) $instance, $defaults ); 
  ?>

  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'guerilla') ?></label>
    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
  </p>

  <p>
    <label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'guerilla') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'guerilla') ?></label>
    <select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
      <option <?php if ( '3' == $instance['postcount'] ) echo 'selected="selected"'; ?>>3</option>
      <option <?php if ( '4' == $instance['postcount'] ) echo 'selected="selected"'; ?>>4</option>
      <option <?php if ( '6' == $instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
      <option <?php if ( '8' == $instance['postcount'] ) echo 'selected="selected"'; ?>>8</option>
      <option <?php if ( '9' == $instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
    </select>
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'guerilla') ?></label>
    <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
      <option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
      <option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
    </select>
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'guerilla') ?></label>
    <select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
      <option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
      <option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
    </select>
  </p>
    
  <?php
  }
}

/* ==========================================================================
   Twitter 
   ========================================================================== */
add_action( 'widgets_init', 'guerilla_tweets_widgets' );

function guerilla_tweets_widgets() {
  register_widget( 'guerilla_Tweet_Widget' );
}

function guerilla_twitter_js() {
  wp_enqueue_script('jquery'); 
  wp_register_script('guerilla-twitter-widget', get_stylesheet_directory_uri() . '/assets/js/vendor/twitter.js', array('jquery'));
  wp_enqueue_script('guerilla-twitter-widget');
}
add_action('wp_enqueue_scripts', 'guerilla_twitter_js');

class guerilla_tweet_widget extends WP_Widget {

  function guerilla_Tweet_Widget() {
  
    $widget_ops = array( 'classname' => 'guerilla_tweet_widget', 'description' => __('A widget that displays your latest tweets.', 'guerilla') );
    $control_ops = array( 'width' => 220, 'height' => 350, 'id_base' => 'guerilla_tweet_widget' );
    $this->WP_Widget( 'guerilla_tweet_widget', __('Custom Tweets', 'guerilla'), $widget_ops, $control_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    $title = apply_filters('widget_title', $instance['title'] );
    $guerilla_twitter_username = $instance['username'];
    $guerilla_twitter_postcount = $instance['postcount'];
    $tweettext = $instance['tweettext'];

    echo $before_widget;

    if ( $title ) { echo $before_title . $title . $after_title; }
      
    $id = rand(0,999);

    ?>
      <script type="text/javascript">
          jQuery(document).ready(function($){
            $.getJSON('http://api.twitter.com/1/statuses/user_timeline.json?include_rts=true&screen_name=<?php echo $guerilla_twitter_username; ?>&count=<?php echo $guerilla_twitter_postcount; ?>&callback=?', function(tweets){
              $("#twitter_update_list_<?php echo $id; ?>").html(guerilla_format_twitter(tweets));
            });
          });
      </script>
            <ul id="twitter_update_list_<?php echo $id; ?>" class="twitter">
                <li><p></p></li>
            </ul>
            
            <?php if( !empty($tweettext) ) { ?>
                <a href="http://twitter.com/<?php echo $guerilla_twitter_username; ?>" class="twitter-link"><?php echo $tweettext; ?></a>
            <?php } ?>
    
    <?php 

    echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['username'] = strip_tags( $new_instance['username'] );
    $instance['postcount'] = strip_tags( $new_instance['postcount'] );
    $instance['tweettext'] = strip_tags( $new_instance['tweettext'] );

    return $instance;
  }
  
  function form( $instance ) {

    $defaults = array(
    'title' => 'Latest Tweets',
    'username' => '',
    'postcount' => '4',
    'tweettext' => 'Follow Us on Twitter',
    );
    $instance = wp_parse_args( (array) $instance, $defaults ); 
    
    ?>

    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'guerilla') ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username:', 'guerilla') ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (maximum 20)', 'guerilla') ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Us on Twitter Text', 'guerilla') ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
    </p>
    
  <?php
  }
}
