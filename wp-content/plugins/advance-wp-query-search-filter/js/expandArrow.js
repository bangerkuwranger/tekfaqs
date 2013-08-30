// function expandAdvancedSearch(){
// 
// }
$('.form_title').click(function() {
if ($('#expandArrow').hasClass('rotated')){
	$('#advSearch').slideUp('slow', function() {
  	});
}
else {
$('#advSearch').slideDown('slow', function() {
  	});
}
$('#expandArrow').toggleClass('rotated');
});
// $('#expandArrow').click(function() {
// if ($('#expandArrow').hasClass('rotated')){
// 	$('#advSearch').slideUp('slow', function() {
//   	});
// }
// else {
// $('#advSearch').slideDown('slow', function() {
//   	});
// }
// $('#expandArrow').toggleClass('rotated');
// });
function showHideAdvSearch() 
{
if ($('#expandArrow').hasClass('rotated')){
	$('#advSearch').slideUp('slow', function() {
  	});
}
else {
$('#advSearch').slideDown('slow', function() {
  	});
}
$('#expandArrow').toggleClass('rotated');
}
$('.form_title').click('showHideAdvSearch()');