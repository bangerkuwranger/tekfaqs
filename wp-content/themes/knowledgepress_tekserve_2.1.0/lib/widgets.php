<?php
/**
 * Register sidebars and widgets
 */
function roots_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', PRESSAPPS_TEXT_DOMAIN),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', PRESSAPPS_TEXT_DOMAIN),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="col-sm-3 widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  // Widgets
  register_widget('Roots_Vcard_Widget');
}
add_action('widgets_init', 'roots_widgets_init');

/* ==========================================================================
   Contact widget (Vcard) 
   ========================================================================== */

class Roots_Vcard_Widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title (optional)',
    'street_address' => 'Street Address',
    'locality'       => 'City/Locality',
    'region'         => 'State/Region',
    'postal_code'    => 'Zipcode/Postal Code',
    'tel'            => 'Telephone',
    'email'          => 'Email'
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_roots_vcard', 'description' => __('Use this widget to add contact details', PRESSAPPS_TEXT_DOMAIN));

    $this->WP_Widget('widget_roots_vcard', __('PressApps: Contact', PRESSAPPS_TEXT_DOMAIN), $widget_ops);
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

    $title = apply_filters('widget_title', empty($instance['title']) ? __('vCard', PRESSAPPS_TEXT_DOMAIN) : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      echo $before_title, $title, $after_title;
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
      <span class="tel"><span class="value"><?php echo $instance['tel']; ?></span></span><br>
      <a class="email" href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
    </p>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_roots_vcard', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

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
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", PRESSAPPS_TEXT_DOMAIN); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}


/* ==========================================================================
   Custom recent post 
   ========================================================================== */

class Custom_Recent_Posts_Widget extends WP_Widget {
      
  function __construct() {
      $widget_ops = array(
      'classname'   => 'widget_recent_entries', 
      'description' => __('Display a list of recent post entries from one or more categories.', PRESSAPPS_TEXT_DOMAIN)
    );
      parent::__construct('custom-recent-posts', __('PressApps: Recent Posts', PRESSAPPS_TEXT_DOMAIN), $widget_ops);
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


    ?>

      <li class="crpw-item">

        <i class="icon-fixed-width <?php echo post_icon(); ?>"></i> <a  href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>" class="crpw-title"><?php the_title(); ?></a>
    
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
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', PRESSAPPS_TEXT_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                  

                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', PRESSAPPS_TEXT_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the recent posts list:', PRESSAPPS_TEXT_DOMAIN);?> 
            
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


/* ==========================================================================
   Custom popular posts 
   ========================================================================== */

class Custom_Popular_Posts_Widget extends WP_Widget {
      
  function __construct() {
      $widget_ops = array(
      'classname'   => 'widget_recent_entries', 
      'description' => __('Display a list of popular post entries from one or more categories.', PRESSAPPS_TEXT_DOMAIN)
    );
      parent::__construct('custom-popular-posts', __('PressApps: Popular Posts', PRESSAPPS_TEXT_DOMAIN), $widget_ops);
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


    ?>

      <li class="crpw-item">

        <i class="icon-fixed-width <?php echo post_icon(); ?>"></i> <a  href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>" class="crpw-title"><?php the_title(); ?></a>
    
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
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', PRESSAPPS_TEXT_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                  

                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', PRESSAPPS_TEXT_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the popular posts list:', PRESSAPPS_TEXT_DOMAIN);?> 
            
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
   Twitter 
   ========================================================================== */

add_action( 'widgets_init', 'pressapps_tweets_widgets' );

function pressapps_tweets_widgets() {
  register_widget( 'pressapps_Tweet_Widget' );
}

class pressapps_tweet_widget extends WP_Widget {

  function pressapps_Tweet_Widget() {
  
    $widget_ops = array( 'classname' => 'pressapps_tweet_widget', 'description' => __('A widget that displays your latest tweets.', PRESSAPPS_TEXT_DOMAIN ) );
    $control_ops = array( 'width' => 220, 'height' => 350, 'id_base' => 'pressapps_tweet_widget' );
    $this->WP_Widget( 'pressapps_tweet_widget', __('PressApps: Twitter', PRESSAPPS_TEXT_DOMAIN ), $widget_ops, $control_ops );
  }
  
  function hyperlink_callback($matches){
      
    if(count($matches)>0){
        return '<a href="' . $matches[0] . '">' . $matches[0] . '</a>';
    }
                    
  }
  
  function username_callback($matches){
        if(count($matches)>0){
            return '<a href="http://twitter.com/' . $matches[1] . '">' . $matches[0] . '</a>';
        }
    }
  
  
  
  function widget( $args, $instance ) {
    extract( $args );

    $title = apply_filters('widget_title', $instance['title'] );
    $pressapps_twitter_username = $instance['username'];
    $pressapps_twitter_postcount = $instance['postcount'];
    $tweettext = $instance['tweettext'];
    
    if(empty($instance['consumer_key']) || empty($instance['consumer_secret']))
        return ;
    
    require_once( 'twitter-api.php' );
    
    $credentials = array(
        'consumer_key'    =>  $instance['consumer_key'],
        'consumer_secret' =>  $instance['consumer_secret']
    );
    
    $twitter_api = new Wp_Twitter_Api( $credentials );
    
    $query      = "count={$pressapps_twitter_postcount}&include_entities=true&include_rts=true&screen_name={$pressapps_twitter_username}";
    $result     = $twitter_api->query( $query );
    echo $before_widget;

    if ( $title ) { echo $before_title . $title . $after_title; }
      
    $id = rand(0,999);
    
    if(count($result)>0){
    ?>
        <ul id="twitter_update_list_<?php echo $id; ?>" class="twitter">
            <?php 
            
                for($i=0;$i<count($result);$i++){
                    /**
                     * Linking the Hyper Link
                     */
                    $result[$i]->text = preg_replace_callback("((https?|s?ftp|ssh)\:\/\/[^\"\s\<\>]*[^.,;'\">\:\s\<\>\)\]\!])",array($this,'hyperlink_callback'),$result[$i]->text);
                    /**
                     * Linking the User
                     */
                    $result[$i]->text = preg_replace_callback("/\B@([_a-z0-9]+)/i",array($this,'username_callback'),$result[$i]->text);
                    ?>
                    <li>
                        <span><i class="icon-twitter"></i> <?php echo $result[$i]->text; ?></span>
                    </li>
                    <?php
                }

            ?>
        </ul>
        <?php 
    }
    ?>
    <?php if( !empty($tweettext) ) { ?>
        <a href="http://twitter.com/<?php echo $pressapps_twitter_username; ?>" class="twitter-link"><?php echo $tweettext; ?></a>
    <?php } ?>
    
    <?php 

    echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    $instance['title']              = strip_tags( $new_instance['title'] );
    $instance['username']           = strip_tags( $new_instance['username'] );
    $instance['postcount']          = strip_tags( $new_instance['postcount'] );
    $instance['tweettext']          = strip_tags( $new_instance['tweettext'] );
    $instance['consumer_key']       = strip_tags( $new_instance['consumer_key'] );
    $instance['consumer_secret']    = strip_tags( $new_instance['consumer_secret'] );

    return $instance;
  }
  
  function form( $instance ) {

    $defaults = array(
        'title'             => 'Latest Tweets',
        'username'          => '',
        'postcount'         => '4',
        'tweettext'         => 'Follow Us on Twitter',
        'consumer_key'      => '',
        'consumer_secret'   => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults ); 
    
    ?>

    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', PRESSAPPS_TEXT_DOMAIN ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username:', PRESSAPPS_TEXT_DOMAIN ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (maximum 20)', PRESSAPPS_TEXT_DOMAIN ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Us on Twitter Text', PRESSAPPS_TEXT_DOMAIN ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer Key', PRESSAPPS_TEXT_DOMAIN ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer Secret', PRESSAPPS_TEXT_DOMAIN ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
    </p>
    
  <?php
  }
}

