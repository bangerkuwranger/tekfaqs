<?php
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

1. Setup
2. Icons
3. Devider
4. Alerts
5. Block Messages
6. Blockquotes
7. YouTube
8. Vimeo
9. Columns
10. Tabs
11. Accordion
12. Hero
13. Label
14. Table
15. Badge
16. Code
18. Tagline
19. Tooltip
21. Buttons

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* 1. Guerilla Shortcodes Setup */
/*-----------------------------------------------------------------------------------*/

// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

/*-----------------------------------------------------------------------------------*/
/* 2. Icons */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_icons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => '', /* ie camera-retro */
	'size' => '20px', /* 20px */
	'color'  => '', /* red or #3390B1 */
	), $atts ) );
	
	$output = '<i class="icon-' . $type . '" style="font-size:' . $size . '; color:' . $color . ';"></i>';
	
	return $output;
}

add_shortcode('icon', 'gt_shortcode_icons'); 

/*-----------------------------------------------------------------------------------*/
/* 3. Devider */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_divider( $atts, $content = null ) {

	$output = '<ul class="nav nav-list"><li class="divider page-divider"></li></ul>';
	return $output;}

add_shortcode('divider', 'gt_shortcode_divider');

/*-----------------------------------------------------------------------------------*/
/* 4. Alerts */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'gt_shortcode_alerts');

/*-----------------------------------------------------------------------------------*/
/* 5. Block Messages */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'gt_shortcode_block_messages');

/*-----------------------------------------------------------------------------------*/
/* 6. Blockquotes */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'gt_shortcode_blockquotes'); 
 
/*-----------------------------------------------------------------------------------*/
/* 7. YouTube */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_youtube($atts) {
	$atts = shortcode_atts(
		array(
			'id' => '',
			'width' => 600,
			'height' => 360
		), $atts);
	
		return '<div class="video-shortcode fitvids"><iframe title="YouTube video player" width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://www.youtube.com/embed/' . $atts['id'] . '?wmode=transparent&rel=0&amp;showinfo=0" frameborder="0" allowfullscreen wmode="Opaque"></iframe></div>';
}

add_shortcode('youtube', 'gt_shortcode_youtube');
	
/*-----------------------------------------------------------------------------------*/
/* 8. Vimeo */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_vimeo($atts) {
	$atts = shortcode_atts(
		array(
			'id' => '',
			'width' => 600,
			'height' => 360
		), $atts);
	
		return '<div class="video-shortcode fitvids"><iframe src="http://player.vimeo.com/video/' . $atts['id'] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="' . $atts['width'] . '" height="' . $atts['height'] . '" frameborder="0"></iframe></div>';
}
 
add_shortcode('vimeo', 'gt_shortcode_vimeo');

/*-----------------------------------------------------------------------------------*/
/* 9. Columns */
/*-----------------------------------------------------------------------------------*/

function column_full( $atts, $content = null )
{	
	$column_full =  '<div class="row-fluid"><div class="span12">' . do_shortcode( $content ) . '</div></div>';
	
	return $column_full;
}

add_shortcode('column_full', 'column_full');


function column_wrap( $atts, $content = null )
{	
	$column_wrap =  '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
	
	return $column_wrap;
}

add_shortcode('column_wrap', 'column_wrap');


function column_half( $atts, $content = null )
{	
	$column_half =  '<div class="span6">' . do_shortcode( $content ) . '</div>';
	
	return $column_half;
}

add_shortcode('column_half', 'column_half');


function column_two_third( $atts, $content = null )
{	
	$column_two_third =  '<div class="span8">' . do_shortcode( $content ) . '</div>';
	
	return $column_two_third;
}

add_shortcode('column_two_third', 'column_two_third');

function column_one_third( $atts, $content = null )
{	
	$column_one_third =  '<div class="span4">' . do_shortcode( $content ) . '</div>';
	
	return $column_one_third;
}

add_shortcode('column_one_third', 'column_one_third');


function column_three_fourth( $atts, $content = null )
{	
	$column_three_fourth =  '<div class="span9">' . do_shortcode( $content ) . '</div>';
	
	return $column_three_fourth;
}

add_shortcode('column_three_fourth', 'column_three_fourth');

function column_one_fourth( $atts, $content = null )
{	
	$column_one_fourth =  '<div class="span3">' . do_shortcode( $content ) . '</div>';
	
	return $column_one_fourth;
}

add_shortcode('column_one_fourth', 'column_one_fourth');


function column_five_sixth( $atts, $content = null )
{	
	$column_five_sixth =  '<div class="span10">' . do_shortcode( $content ) . '</div>';
	
	return $column_five_sixth;
}

add_shortcode('column_five_sixth', 'column_five_sixth');

function column_one_sixth( $atts, $content = null )
{	
	$column_one_sixth =  '<div class="span2">' . do_shortcode( $content ) . '</div>';
	
	return $column_one_sixth;
}

add_shortcode('column_one_sixth', 'column_one_sixth');


function column_eleven_twelveth( $atts, $content = null )
{	
	$column_eleven_twelveth =  '<div class="span11">' . do_shortcode( $content ) . '</div>';
	
	return $column_eleven_twelveth;
}

add_shortcode('column_eleven_twelveth', 'column_eleven_twelveth');

function column_one_twelveth( $atts, $content = null )
{	
	$column_one_twelveth =  '<div class="span1">' . do_shortcode( $content ) . '</div>';
	
	return $column_one_twelveth;
}

add_shortcode('column_one_twelveth', 'column_one_twelveth');

/*-----------------------------------------------------------------------------------*/
/* 10. Tabs */
/*-----------------------------------------------------------------------------------*/

function tabset( $atts, $content = null )
{
	$tabset =  '<div>' . do_shortcode( $content ) . '</div>';
	
	return $tabset;
}
  
add_shortcode('tabset', 'tabset');
	
function tab_head( $atts, $content = null )
{
	$tab_head = '<ul class="nav nav-tabs">' . do_shortcode( $content ) . '</ul>';
	
	return $tab_head;
}
  
add_shortcode('tab_head', 'tab_head');

function tab_title( $atts, $content = null )
{
	extract( shortcode_atts( array( 'active' => '',
									'sequence' => ''), $atts ) );
									
	$tab_title = '<li class="' . $active . '"><a href="#' . $sequence . '" data-toggle="tab">' . $content . '</a></li>';
	
	return $tab_title;
}
  
add_shortcode('tab_title', 'tab_title');

function tab_content( $atts, $content = null )
{
	$tab_content = '<div class="tab-content">' . do_shortcode( $content ) . '</div>';
	
	return $tab_content;
}
  
add_shortcode('tab_content', 'tab_content');

function tab_pane( $atts, $content = null )
{
	extract( shortcode_atts( array( 'active' => '',
									'sequence' => ''), $atts ) );
	
	$tab_pane = '<div class="tab-pane ' . $active . '" id="' . $sequence . '"><p>' . do_shortcode( $content ) . '</p></div>';
	
	return $tab_pane;
}

add_shortcode('tab_pane', 'tab_pane');
	
/*-----------------------------------------------------------------------------------*/
/* 11. Accordion */
/*-----------------------------------------------------------------------------------*/

function accordion( $atts, $content = null )
{
	$accordion =  '<div class="accordion">' . do_shortcode( $content ) . '</div>';
	
	return $accordion;
}

add_shortcode('accordion', 'accordion');

function accordion_pane( $atts, $content = null )
{
	extract( shortcode_atts( array('accordion_title' => ''), $atts ) );
									
	$accordion_pane = '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle"><i class="icon-active icon-chevron-down"></i> <i class="icon-passive icon-chevron-right"></i> ' . $accordion_title . '</a></div><div class="accordion-body"><div class="accordion-inner">' . do_shortcode( $content ) . '</div></div></div>';
	
	return $accordion_pane;
}

add_shortcode('accordion_pane', 'accordion_pane');

/*-----------------------------------------------------------------------------------*/
/* 12. Hero */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_hero( $atts, $content = null )
{
	extract( shortcode_atts( array('hero_title' => 'Title', 'hero_button_type' => 'btn-primary', 'hero_button_title' => 'Click Here!', 'hero_button_link' => '#'), $atts ) );
	
	if ( !$hero_title == "" )
	{
		$hero_title_out =  "<h1><b>$hero_title</b></h1>";
	}
	else
	{
		$hero_title_out =  "";
	}
	
	if ( !$hero_button_type == "" )
	{
		$hero_button_out =  '<p><a href="' . $hero_button_link . '" class="btn ' . $hero_button_type . ' btn-large"><b>' . $hero_button_title . '</b></a></p>';
	}
	else
	{
		$hero_button_out =  "";
	}

	$hero_unit =  '<div class="hero-unit sep_bg">' . $hero_title_out . '<p>' . do_shortcode( $content ) . '</p>' . $hero_button_out . '</div>';
	
	return $hero_unit;
}

add_shortcode('hero', 'gt_shortcode_hero');	

/*-----------------------------------------------------------------------------------*/
/* 13. Label */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_label( $atts, $content = null )
{
	extract( shortcode_atts( array( 'color' => 'grey' ), $atts ) );
	
	if ( $color == 'grey')
	{
		$color_out = '';
	}
	elseif ( $color == 'green')
	{
		$color_out = 'label-success';
	}
	elseif ( $color == 'yellow')
	{
		$color_out = 'label-warning';
	}
	elseif ( $color == 'red')
	{
		$color_out = 'label-important';
	}
	elseif ( $color == 'blue')
	{
		$color_out = 'label-info';
	}
	elseif ( $color == 'black')
	{
		$color_out = 'label-inverse';
	}
	
	$label =  '<span class="label ' . $color_out . '">' . do_shortcode( $content ) . '</span>';
	
	return $label;
}

add_shortcode('label', 'gt_shortcode_label');
	
/*-----------------------------------------------------------------------------------*/
/* 14. Table */
/*-----------------------------------------------------------------------------------*/

function table_wrap( $atts, $content = null )
{
	$table_wrap =  '<table class="table table-hover table-bordered">' . do_shortcode( $content ) . '</table>';
	
	return $table_wrap;
}

add_shortcode('table_wrap', 'table_wrap');

function table_columns( $atts, $content = null )
{
	$table_columns =  '<thead><tr>' . do_shortcode( $content ) . '</tr></thead>';
	
	return $table_columns;
}

add_shortcode('table_columns', 'table_columns');

function table_column( $atts, $content = null )
{
	$table_column =  '<th>' . do_shortcode( $content ) . '</th>';
	
	return $table_column;
}

add_shortcode('table_column', 'table_column');

function table_content( $atts, $content = null )
{
	$table_content =  '<tbody>' . do_shortcode( $content ) . '</tbody>';
	
	return $table_content;
}

add_shortcode('table_content', 'table_content');

function table_row( $atts, $content = null )
{
	$table_row =  '<tr>' . do_shortcode( $content ) . '</tr>';
	
	return $table_row;
}

add_shortcode('table_row', 'table_row');

function table_cell( $atts, $content = null )
{
	$table_cell =  '<td>' . do_shortcode( $content ) . '</td>';
	
	return $table_cell;
}

add_shortcode( 'table_cell', 'table_cell' );	
		
/*-----------------------------------------------------------------------------------*/
/* 15. Badge */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_badge( $atts, $content = null )
{
	extract( shortcode_atts( array( 'color' => 'grey' ), $atts ) );
	
	if ( $color == 'grey')

	{
		$color_out = '';
	}
	elseif ( $color == 'green')
	{
		$color_out = 'badge-success';
	}
	elseif ( $color == 'yellow')
	{
		$color_out = 'badge-warning';
	}
	elseif ( $color == 'red')
	{
		$color_out = 'badge-important';
	}
	elseif ( $color == 'blue')
	{
		$color_out = 'badge-info';
	}
	elseif ( $color == 'black')
	{
		$color_out = 'badge-inverse';
	}
	
	$label =  '<span class="badge ' . $color_out . '">' . do_shortcode( $content ) . '</span>';
	
	return $label;
}

add_shortcode('badge', 'gt_shortcode_badge');
	
/*-----------------------------------------------------------------------------------*/
/* 16. Code */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_code( $atts, $content = null )
{		
	$code =  '<pre class="prettyprint">' . do_shortcode( $content ) . '</pre>';
	
	return $code;
}

add_shortcode('code', 'gt_shortcode_code');

/*-----------------------------------------------------------------------------------*/
/* 18. Tagline */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_tagline( $atts, $content = null )
{
	$tagline =  '<div class="presentation"><h1>' . do_shortcode( $content ) . '</h1></div>';
	
	return $tagline;
}

add_shortcode('tagline', 'gt_shortcode_tagline');

/*-----------------------------------------------------------------------------------*/
/* 19. Tooltip */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_tooltip( $atts, $content = null )
{
	extract( shortcode_atts( array('tip' => ''), $atts ) );
	
	$tip_out = 'title="' . $tip . '"';
	
	$tooltip =  '<a href="#" rel="tooltip" ' . $tip_out . '> ' . do_shortcode( $content ) . '</a>';
	
	return $tooltip;
}

add_shortcode('tooltip', 'gt_shortcode_tooltip');

/*-----------------------------------------------------------------------------------*/
/* 21. Buttons */
/*-----------------------------------------------------------------------------------*/

function gt_shortcode_buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'medium', /* small, medium, large */
	'url'  => '',
	'text' => '',
	'icon' => 'none',
	'iconcolor' => 'white',
	'target' => '_self',
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "medium"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	if($icon == 'none'){
		$icon = '';
	}
	else{
		$icon = '<i class="icon-'. $icon . '" style="color: ' . $iconcolor . '"></i> ';
	}
	
	$output = '<a href="' . $url . '" target="' . $target . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $icon;
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'gt_shortcode_buttons'); 

?>