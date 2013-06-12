function filterQsBy(filterTerm) {
	$('.activeFilter').removeClass().addClass('inactiveFilter');
	$('.currentContent').removeClass().addClass('hiddenContent');
	$('#'+filterTerm).removeClass().addClass('currentContent');
	$('#'+filterTerm+'A').removeClass().addClass('activeFilter');
}
