function filterQsBy(filterTerm) {
	$('.activeFilter').removeClass().addClass('inactiveFilter');
	$('.currentContent').removeClass().addClass('hiddenContent');
	$('#'+filterTerm).removeClass().addClass('currentContent');
	$('#'+filterTerm+'A').parent().removeClass().addClass('activeFilter');
}
