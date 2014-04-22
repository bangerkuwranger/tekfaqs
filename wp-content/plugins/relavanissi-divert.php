<?php
/*
Plugin Name: Relevanssi Divert
Plugin URI: http://www.relevanssi.com/
Description: This plugin diverts relevanissi.
Version: 1.0
Author: Chad A. Carino
Author URI: http://www.chadcacarino.com/
*/
// if ( function_exists('relevanssi_query' ) ) {

	add_filter('pre_get_posts','tekserve_divert_relevanissi');

// }

if ( !function_exists('tekserve_divert_relevanissi') ) {
	function tekserve_divert_relevanissi($query) {
// 		echo print_r($query);
		
// 		echo get_search_query();
		
		if ( ( $query->is_search ) AND ( $_GET['search-option'] == 'products' ) ) {
			$store_url_pre = 'http://www.tekserve.com/catalogsearch/result/?q=';
			$store_url = $store_url_pre . urlencode( $_GET['s'] );
			echo $store_url;
			wp_redirect($store_url);
			exit;
		}
		return $query;
	}
}

if ( !function_exists('tekserve_custom_search') ) {
	function tekserve_custom_search() {
		$this_url = home_url( '/' );
		$info_label = 'Information';
		$is_events = strpos( $this_url, 'events' );
		$is_faq = strpos( $this_url, 'faq' );
		$is_rentals = strpos( $this_url, 'rentals' );
		$is_blog = strpos( $this_url, 'blog' );
		$is_shop = strpos( $this_url, 'store' );
		if ( $is_events !== false ) {
			$info_label = 'Events';
		}
		if ( $is_faq !== false ) {
			$info_label = 'Answers';
		}
		if ( $is_blog !== false ) {
			$info_label = 'Articles';
		}
		if ( $is_rentals !== false ) {
			$this_url =  'http://maintekserve.wpengine.com';
		}
		if ( $is_shop !== false ) {
			$this_url =  'http://maintekserve.wpengine.com';
		}
		$search_text = get_search_query() ? esc_attr( apply_filters( 'the_search_query', get_search_query() ) ) : apply_filters( 'genesis_search_text', esc_attr__( 'Find', 'genesis' ) . '&#x02026;' );
		$onfocus = "onfocus=\"if (this.value == '$search_text') {this.value = '';}\"";
		$onblur  = "onblur=\"if (this.value == '') {this.value = '$search_text';}\"";
		$label = apply_filters( 'genesis_search_form_label', '' );
		$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );
		$xhtml_form = sprintf( '<form method="get" class="searchform search-form" action="%s" role="search" >%s<input type="text" value="%s" name="s" class="s search-input" %s %s /><span class="search-option-menu"><select name="search-option" id="search-option"><option value="content">%s</option><option value="products" selected="selected">Stuff to Buy</option></select></span><input type="submit" class="searchsubmit search-submit" value="%s" /></form>', $this_url, $label, esc_attr( $search_text ), $onfocus, $onblur, $info_label, esc_attr( $button_text ) );
		$html5_form = sprintf( '<form method="get" class="search-form" action="%s" role="search">%s<input type="search" name="s" placeholder="%s" /><span class="search-option-menu"><select name="search-option" id="search-option"><option value="content">%s</option><option value="products" selected="selected">Stuff to Buy</option></select></span><input type="submit" value="%s" /></form>', $this_url, $label, $search_text, $info_label, esc_attr( $button_text ) );
		$form = genesis_html5() ? $html5_form : $xhtml_form;
		return apply_filters( 'genesis_search_form', $form, $search_text, $button_text, $label );
	}
}