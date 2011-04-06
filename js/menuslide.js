var $j = jQuery.noConflict();
function menuSlide() {
	// Handling Menu Children
	$j(document).ready(function(){

	$j("ul.children, ul.sub-menu").parent().addClass("dropdown"); //Adds a class to the elements that have a sub-menu

	$j("#menu li.dropdown").hover(function() { //When the mouse hovers over a main menu
			$j(this).addClass("subhover"); //Indicate that this item will be hover overed
		}, function(){	//On Hover Out
			$j(this).removeClass("subhover"); //On hover out, remove class "subhover"

		}).hover(function() {
			//Following events are applied to the sub-menu, children items (moving children up and down)
		$j(this).parent().find(".subhover ul.children, .subhover ul.sub-menu").slideDown('fast').show(); //Drop down the subnav when the mouse is over a specific element

		$j(this).parent().hover(function() {
		}, function(){
			$j(this).parent().find("ul.children, ul.sub-menu").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
		});

	});

});
}

$j(document).ready(function() {
	menuSlide();
});
