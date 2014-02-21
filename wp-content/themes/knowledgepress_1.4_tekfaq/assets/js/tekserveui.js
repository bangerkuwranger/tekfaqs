var $j = jQuery; //noconflict declaration

//function to swap programmatically added mobile header image url with existing header image url.
//only runs if plugin tekserve-shared-data has created it. Requires a page width.
function swapHeaderImgs(pageWidth) {
	if($j('#tekserve-shared-data-hours-swap').length != 0) {
		console.log('TSD Obj created');
		var firstImg = $j('#title-area').css('backgroundImage');
		var secondImg = $j('#tekserve-shared-data-hours-swap').html();
		if( $j('#title-area').hasClass('mobileImg') && (pageWidth > 768) ) {
			$j('#title-area').css('backgroundImage', secondImg).removeClass('mobileImg');
			$j('#tekserve-shared-data-hours-swap').html(firstImg);
		}
		if( !( $j('#title-area').hasClass('mobileImg') ) && (pageWidth < 768) ) {
			$j('#title-area').css('backgroundImage', secondImg).addClass('mobileImg');
			$j('#tekserve-shared-data-hours-swap').html(firstImg);
		}
	}
}

function fixDiv() { //fixes nav to top screen as user scrolls down
    var $jdiv = $j("#nav");
    if ($j(window).scrollTop() > $jdiv.data("top")) { 
        $j('#nav').css({'position': 'fixed', 'top': '0', 'width': '100%'}); 
    }
    else {
    	if( $j('#title-area').hasClass('mobileImg') ) {
    		$j('#nav').css({'position': 'relative', 'top': '0', 'width': '100%'});
    	}
    	else {
        	$j('#nav').css({'position': 'relative', 'top': '-10px', 'width': '100%'});
        }
    }
}

$j('document').ready(function() { //call on load
	var clientWidth = document.documentElement.clientWidth;
	console.log(clientWidth);
	if(clientWidth < 769){
		swapHeaderImgs(600); //call on load if window size ≤ 768
	}
	$j("#nav").data("top", $j("#nav").offset().top); // set nav original position on load
	$j(window).scroll(fixDiv);
	$j('#title-area').click(function() {
		window.location = "http://faq.tekserve.com/";
	});
});

$j(window).resize(function() { //call on window resize
	clientWidth = $j(window).width();
	swapHeaderImgs(clientWidth);
});