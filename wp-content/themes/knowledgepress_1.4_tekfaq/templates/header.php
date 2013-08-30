<header id="banner" role="banner">
	<div class="container" style="height: 27px;">
	<script type="text/javascript">// <![CDATA[
  (function() {
    var cx = '003583211974452810920:WMX1719049726';
    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
  })();
// ]]></script>
<table id="header_contact" style="color: white;">
<tbody>
<tr>
<td id="top-contact-left" style="padding-right: 15px; white-space: nowrap;"><span style="white-space: nowrap;"><span style="color: #f36f37; font-weight: bolder;">FAQs</span><span style="padding-left: 1px; padding-right: 1px; color: #fff;"> | </span><a style="padding-left: 1px; padding-right: 1px; color: #fff;"href="http://www.tekserve.com">Store</a></span><span style="padding-left: 1px; padding-right: 1px; color: #fff;"> | </span><a style="padding-left: 1px; padding-right: 1px; color: #fff;"href="http://www.tekserve.com/business">Business Solutions</a></span></td>
<td id="top-contact-right"><span style="white-space: nowrap;"><a style="padding-left: 1px; padding-right: 1px; color: #fff; text-decoration: none;" href="http://www.tekserve.com/about/store-location-and-hours"><span style="padding-left: 1px; padding-right: 1px; color: #fff;">119 W. 23rd Street. NYC 10011 | </span></a><span id="desktoppnlink"><a id="desktopPhNo" style="padding-left: 1px; padding-right: 1px; color: #fff;" href="http://www.tekserve.com/about/store-location-and-hours">212.929.3645</a></span><span id="mobilepnlink" style="padding-left: 1px; padding-right: 1px; color: #fff; display: none;"><a id="mobilePhNo" style="padding-left: 1px; padding-right: 1px; color: #fff;" href="tel:2129293645">212.929.3645</a></span><a style="padding-left: 1px; padding-right: 1px; color: #fff; text-decoration: none;" href="http://www.tekserve.com/about/store-location-and-hours"><span style="padding-left: 1px; padding-right: 1px; color: #fff;"> | <strong>Store Hours</strong> Mon-Fri 9am-8pm  | Sat-Sun 12pm-6pm </span></a></td>
</tr>
</tbody>
</table>
<script type="text/javascript">// <![CDATA[
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
if( isMobile.any() ){
document.getElementById('desktoppnlink').style.display='none';
document.getElementById('mobilepnlink').style.display='inline';
}
// ]]></script>
<script type="text/javascript">
var linkNo;

function setPhNumber(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}
function getPhNumber(c_name)
{
var c_value = document.cookie;
var c_start = c_value.indexOf(" " + c_name + "=");
if (c_start == -1)
  {
  c_start = c_value.indexOf(c_name + "=");
  }
if (c_start == -1)
  {
  c_value = null;
  }
else
  {
  c_start = c_value.indexOf("=", c_start) + 1;
  var c_end = c_value.indexOf(";", c_start);
  if (c_end == -1)
  {
c_end = c_value.length;
}
c_value = unescape(c_value.substring(c_start,c_end));
}
return c_value;
}
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
function checkPhNumber()
{
var phoneNumber=getPhNumber("phoneNumber");
var isGoog=getPhNumber("gclid");
  if (phoneNumber!=null && phoneNumber!="")
  {
  	return phoneNumber;
  }
else 
  {
  var whichNo = getQueryVariable('callppc');
	if (whichNo == 'y') {
		setPhNumber('phoneNumber','212.433.2312',90);
		return '212.433.2312';
	}
	else {
		if  (isGoog != '' && isGoog != null) {
			setPhNumber('phoneNumber','212.433.2313',90);
			return '212.433.2313';
		}
		else {
			return '212.929.3645';
		}
  }
}
}
var linkNo = checkPhNumber();
var deska = document.getElementById('desktopPhNo');
var mobilea = document.getElementById('mobilePhNo');
deska.innerHTML = linkNo;
mobilea.innerHTML = linkNo;
mobilea.href = "tel:" + linkNo;
</script>
	</div>

  <div class="container">
  <?php 
  if (!is_page_template('page-home.php') && !is_page_template('page-knowledge-base.php')) {
?>
<!--   	<h4 id="stylePal"><img id="contrastAndColorImg" onclick="changeCSS();" src="http://tekserve.wpengine.com/wp-content/themes/knowledgepress_1.4_tekfaq/assets/img/contrast.png" /><a href="#!" id="contrastAndColor" class="light" onclick="changeCSS();">Increase Contrast</a></h4> -->
    <?php }
    if (gt_get_option('logo_image')) { ?>
      <div class="logo">
        <a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>/?noplace=home"><img src="<?php echo gt_get_option('logo_image'); ?>" alt="<?php bloginfo('name'); ?>"/></a>
      </div>
    <?php }
    else { ?>
      <div class="logo logo-text">
        <h1><a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      </div>
    <?php }
    ?>
    <nav id="nav-main" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) {
          wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_id' => 'menu', 'menu_class' => '', 'container' => false, 'depth' => 0, 'link_before' => '' ) );
        }
      ?>
    </nav>
  </div>

</header>
<?php 
  if (!is_page_template('page-home.php')) {
    get_template_part('templates/page', 'header'); 
    wp_head();
  }
?>
