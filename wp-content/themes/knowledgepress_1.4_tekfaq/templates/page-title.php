<div class="page-title">
  <h1>
    <?php
      if (is_home()) {
        if (get_option('page_for_posts', true)) {
          echo get_the_title(get_option('page_for_posts', true));
        } else {
          _e('Latest Posts', 'guerilla');
        }
      } elseif (is_archive()) {
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        if ($term) {
          echo $term->name;
        } elseif (is_post_type_archive()) {
          echo get_queried_object()->labels->name;
        } elseif (is_day()) {
          printf(__('Daily Archives: %s', 'guerilla'), get_the_date());
        } elseif (is_month()) {
          printf(__('Monthly Archives: %s', 'guerilla'), get_the_date('F Y'));
        } elseif (is_year()) {
          printf(__('Yearly Archives: %s', 'guerilla'), get_the_date('Y'));
        } elseif (is_author()) {
          global $post;
          $author_id = $post->post_author;
          printf(__('Author Archives: %s', 'guerilla'), get_the_author_meta('display_name', $author_id));
        } else {
          single_cat_title();
        }
      } elseif (is_search()) {
      		$wpsq = get_search_query();
      		if ($wpsq == '\t') {
        		printf(__('Results for %s', 'guerilla'), get_search_query());
        	}
        	else {
        		$wpsq = wp_title('»', false);
        		$wpsq = preg_replace("/» Tekserve FAQ/", "", $wpsq);
        		print($wpsq);
        	}
      } elseif (is_404()) {
        _e('File Not Found', 'guerilla');
      } else {
        the_title();
      }
    ?>
  </h1>
</div>