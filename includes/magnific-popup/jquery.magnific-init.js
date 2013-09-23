//http://dimsemenov.com/plugins/magnific-popup/documentation.html
jQuery(document).ready(function($) {
	$('.entry-content a[href*=".jpg"], .entry-content a[href*=".jpeg"], .entry-content a[href*=".png"], .entry-content a[href*=".gif"]').each(function(){
		//single image popup
		if ($(this).parents('.gallery').length == 0) {
			$(this).magnificPopup({
				type:'image'/*,
				zoom: {
					enabled: true,

					duration: 300,
					easing: 'ease-in-out'
				}*/
			});
		}
	});
	//gallery popup
	$('.gallery').each(function() {
		$(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {enabled:true}
		});
	});
});
