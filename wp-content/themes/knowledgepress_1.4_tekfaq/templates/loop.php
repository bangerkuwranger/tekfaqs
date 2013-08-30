  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
      <h2><i class="icon-file-alt"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php 
        if (comments_open()) {
          echo '<div class="loop-like"><span class="label label-likes"><i class="icon-comment"></i> ';
          comments_number( '0', '1', '%' );
          echo '</span></div>';
        }
      ?>    
    </header>
    <div class="entry-content">
      <?php the_excerpt(); ?>
    </div>
    <footer class="post-meta">
      <?php roots_entry_meta(); ?>
      <?php the_tags('<i class="icon-tags"></i> '); ?>
      <div class="categoryList">
<?php
// get the category IDs assigned to post
$categories = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
// separator between links
  	$separator = '  <img style="height: 12px; vertical-align: -1px;" src="http://tekserve.wpengine.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/img/leftorgarrow.png" />  ';
	$maclogo = '> <img src="http://tekserve.wpengine.com/wp-content/uploads/2013/06/Mac-Logo.png" alt="Mac" title="Mac" /> <';
	$ioslogo = '> <img src="http://tekserve.wpengine.com/wp-content/uploads/2013/06/IOS_Logo.png" alt="iOS" title="iOS" /> <';
if ( $categories ) {

	$cat_ids = implode( ',' , $categories );
	$cats = wp_list_categories( 'title_li=&style=none&echo=0&include=' . $cat_ids );
	$cats = rtrim( trim( str_replace( '<br />',  ' ~~~ ', $cats ) ), '~~~' );
	
	// replace parent with logo and display post categories
	$cats = str_replace( '>Download Other Versions and Formats<',  '><', $cats );
	$cats = str_replace( '>Mac<',  $maclogo, $cats );
	$cats = str_replace( '>iOS<',  $ioslogo, $cats );
	echo  str_replace( '~~~', $separator, $cats );
}
?>
</div>
    </footer>
  </article>
  
