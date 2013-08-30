<?php
$nonce = wp_create_nonce  ('awqsfsearch');
$taxo = get_post_meta($id, 'awqsf-taxo', true);
$cmf = get_post_meta($id, 'awqsf-cmf', true);
$options = get_post_meta($id, 'awqsf-relbool', true);
echo '<div id="aqsfformid">';
if($formtitle){
echo '<span id="advTitle" class="form_title" onclick="showHideAdvSearch();" style="cursor: pointer;">'.get_the_title($id).'</span><img onclick="showHideAdvSearch();" id="expandArrow" class="" cursor: pointer;" src="http://3civ7q19xq3z4d2wi812e1iujkj.wpengine.netdna-cdn.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/img/leftorgarrow.png" />';}
echo '<div id="advSearch" class="row-fluid" style="display: none;">';
echo '<form method="get" name="advSearchForm" onsubmit="return useKeywordKthx();" id="awqsf_search_form_'.$id.'" action="'.home_url( '/' ).'">';
echo '<input type="hidden" name="s" value="'.$nonce.'" /><input type="hidden" name="formid" value="'.$id.'">';
if(!empty($taxo)){
 $c = 0;
 foreach($taxo as $k => $v){
		$eid = explode(",", $v['exc']);
		$args = array('hide_empty'=>$v['hide'],'exclude'=>$eid );	
                $terms = get_terms($v['taxname'],$args);
 	       $count = count($terms);
		if($v['type'] == 'dropdown'){
			include "taxdropdown.php";
		}
		if($v['type'] == 'checkbox'){
 			include "taxcheckbox.php";
		}
		if($v['type'] == 'radio'){
 			include "taxradio.php";
		}
	      if(empty($v['type'])){include "taxdropdown.php";}
	$c++;			
  }
}

if(!empty($cmf)){  
   $i=0;
    foreach($cmf as $k => $v){
	if(isset($v['type'])){
      	
      if($v['type'] == 'dropdown'){
   	include "cmfdropdown.php";
      }
      if($v['type'] == 'radio'){
 	include "cmfradio.php";
      }	
      if($v['type'] == 'checkbox'){
 	include "cmfcheckbox.php";
      }		
	
     }else{include "cmfdropdown.php";}
     $i++;
   }	
}

if(isset($options[0]['strchk']) && ($options[0]['strchk'] == '1') ){
		echo '<div id="awqsf_keyword_box" class="awqsf_box span3"><center><label class="awqsf-label-keyword">'.$options[0]['strlabel'].'<span style="color: #f36f37; line-height: 0em; font-size: 2em;">*</span></center></label>';
		echo '<input id="awqsf_keyword" type="text" name="skeyword" value="" />';
                echo '<br></div>';
}
echo '<div class="awqsf_box span3"><p class="awqsf-button"><input type="submit" id="awqsf_submit" value="'.$options[0]['button'].'" alt="[Submit]" name="wqsfsubmit" title="Search" /></p></div>';
echo ' </div>';				
echo '</form>';


echo '</div>';
echo '<script type="text/javascript">function useKeywordKthx()
{
var x=document.forms["advSearchForm"]["skeyword"].value;
if (x==null || x=="")
  {
  alert("Too many results; please enter a keyword.");
  return false;
  }
}</script>'

?>
