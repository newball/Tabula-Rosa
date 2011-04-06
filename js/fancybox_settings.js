	var $fancybox = jQuery.noConflict();
	
	$fancybox(document).ready(function() {
	
			
		$fancybox(".gallery a").attr('rel', function() {
			return $fancybox(".gallery").attr('id') + '-fancybox-gallery'
		}).fancybox({
		/* You can change these Settings. For their options, visit: http://fancybox.net/api */
			'transitionIn' : 'fade',
			'transitionOut' : 'fade',
			'speedIn' : 500,
			'speedOut' : 250,
			'titlePosition' : 'over'
		});	
	});
