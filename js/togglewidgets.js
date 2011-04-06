var $q = jQuery.noConflict();
function toggleWidgets() {

	$q(document).ready(function() {

	// Slider for Widgets
	$q('#sidebar h3.widgettitle').addClass('plus');
	
	$q('#sidebar h3.widgettitle').click(function($) {
		$j(this).toggleClass('plus').toggleClass('minus').next().slideToggle(180);
	});	
});

}

$q(document).ready(function() {
	toggleWidgets();
});
