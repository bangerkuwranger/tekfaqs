/* Bootstrap menu fix
jQuery(document).ready(function ($) {
  $('nav > ul > li:has(ul) > a').attr('href', function (i, val) { this.removeAttribute("data-toggle"); });
  $('nav > ul > li:has(ul) > a').attr('href', function (i, val) { this.removeAttribute("class"); });
}); 
*/
/***************************************************
			SuperFish Menu
***************************************************/	
// initialise plugins
	jQuery.noConflict()(function(){
			jQuery('ul#menu').superfish({ 
						delay:       400,                            // one second delay on mouseout 
						animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
						speed:       100,  		                      // faster animation speed 
						autoArrows:  false,                           // disable generation of arrow mark-up 
						dropShadows: false                            // disable drop shadows 
					}); 
	});
	
	
	
jQuery.noConflict()(function($) {
  if ($.browser.msie && $.browser.version.substr(0,1)<7)
  {
	$('li').has('ul').mouseover(function(){
		$(this).children('ul').css('visibility','visible');
		}).mouseout(function(){
		$(this).children('ul').css('visibility','hidden');
		})
  }
});

/***************************************************
			Responsive Menu
***************************************************/
jQuery.noConflict()(function($){
	   
      // Create the dropdown base
      $("<select />").appendTo("#nav-main");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Please choose page"
      }).appendTo("#nav-main select");
      
      // Populate dropdown with menu items
      $("#nav-main a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("#nav-main select");
      });
      
	   // To make dropdown actually work
	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
      $("#nav-main select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
});

jQuery.noConflict()(function($){
	   
      // Create the dropdown base
      $("<select />").appendTo("#nav-footer");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Please choose page"
      }).appendTo("#nav-footer select");
      
      // Populate dropdown with menu items
      $("#nav-footer a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("#nav-footer select");
      });
      
	   // To make dropdown actually work
	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
      $("#nav-footer select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
});


/* imgsizer (flexible images for fluid sites) */
var imgSizer={Config:{imgCache:[],spacer:"/path/to/your/spacer.gif"},collate:function(aScope){var isOldIE=(document.all&&!window.opera&&!window.XDomainRequest)?1:0;if(isOldIE&&document.getElementsByTagName){var c=imgSizer;var imgCache=c.Config.imgCache;var images=(aScope&&aScope.length)?aScope:document.getElementsByTagName("img");for(var i=0;i<images.length;i++){images[i].origWidth=images[i].offsetWidth;images[i].origHeight=images[i].offsetHeight;imgCache.push(images[i]);c.ieAlpha(images[i]);images[i].style.width="100%";}
if(imgCache.length){c.resize(function(){for(var i=0;i<imgCache.length;i++){var ratio=(imgCache[i].offsetWidth/imgCache[i].origWidth);imgCache[i].style.height=(imgCache[i].origHeight*ratio)+"px";}});}}},ieAlpha:function(img){var c=imgSizer;if(img.oldSrc){img.src=img.oldSrc;}
var src=img.src;img.style.width=img.offsetWidth+"px";img.style.height=img.offsetHeight+"px";img.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='scale')"
img.oldSrc=src;img.src=c.Config.spacer;},resize:function(func){var oldonresize=window.onresize;if(typeof window.onresize!='function'){window.onresize=func;}else{window.onresize=function(){if(oldonresize){oldonresize();}
func();}}}}

// add twitter bootstrap classes and color based on how many times tag is used
function addTwitterBSClass(thisObj) {
  var title = $(thisObj).attr('title');
  if (title) {
    var titles = title.split(' ');
    if (titles[0]) {
      var num = parseInt(titles[0]);
      if (num > 0)
        $(thisObj).addClass('label');
      if (num == 2)
        $(thisObj).addClass('label label-info');
      if (num > 2 && num < 4)
        $(thisObj).addClass('label label-success');
      if (num >= 5 && num < 10)
        $(thisObj).addClass('label label-warning');
      if (num >=10)
        $(thisObj).addClass('label label-important');
    }
  }
  else
    $(thisObj).addClass('label');
  return true;
}

/***************************************************
      As the page loads, cal these scripts
***************************************************/

jQuery(document).ready(function ($) {
//$(document).ready(function() {

  // modify tag cloud links to match up with twitter bootstrap
  $("#tag-cloud a").each(function() {
      addTwitterBSClass(this);
      return true;
  });
  
  $("p.tags a").each(function() {
    addTwitterBSClass(this);
    return true;
  });
  
  $("ol.commentlist a.comment-reply-link").each(function() {
    $(this).addClass('btn btn btn-mini');
    return true;
  });
  
  $('#cancel-comment-reply-link').each(function() {
    $(this).addClass('btn btn btn-mini');
    return true;
  });
  
  $('article.post').hover(function(){
    $('a.edit-post').show();
  },function(){
    $('a.edit-post').hide();
  });
  
  // Input placeholder text fix for IE
  $('[placeholder]').focus(function() {
    var input = $(this);
    if (input.val() == input.attr('placeholder')) {
    input.val('');
    input.removeClass('placeholder');
    }
  }).blur(function() {
    var input = $(this);
    if (input.val() == '' || input.val() == input.attr('placeholder')) {
    input.addClass('placeholder');
    input.val(input.attr('placeholder'));
    }
  }).blur();
  
  // Prevent submission of empty form
  $('[placeholder]').parents('form').submit(function() {
    $(this).find('[placeholder]').each(function() {
    var input = $(this);
    if (input.val() == input.attr('placeholder')) {
      input.val('');
    }
    })
  });

  $('.alert-message').alert();
  $('.dropdown-toggle').dropdown();
  $('.collapse').collapse();

  $('.accordion-group .accordion-toggle').click(function() {
      var parent = $(this).parents('.accordion-group');
      parent.siblings().removeClass('active').find('.accordion-body').stop(true,true).hide(300);
      if(!parent.hasClass('active')) {
        parent.addClass('active').find('.accordion-body').stop(true,true).fadeIn(400);
      } else { 
        parent.removeClass('active').find('.accordion-body').stop(true,true).hide(200);
      }
    });

// popover 
  $("a[data-toggle=popover]")
    .popover()
    .click(function(e) {
      e.preventDefault()
    });

  $('a[rel=tooltip]').tooltip({
        'placement' : 'top'   
        });

  $('.social-icon').tooltip();

  // Target your .container, .wrapper, .post, etc.
  $('.fitvids').fitVids();

  // make code pretty
  window.prettyPrint && prettyPrint()
  
  
}); /* end of as page load scripts */
