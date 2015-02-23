//http://dimsemenov.com/plugins/magnific-popup/documentation.html
jQuery(document).ready(function($) {
	$('main a[href*=".jpg"], main a[href*=".jpeg"], main a[href*=".png"], main a[href*=".gif"]').each(function(){
		// Single image popup
		if ($(this).parents('.gallery').length == 0) {
			$(this).magnificPopup({
				type:'image',
				closeMarkup: ''
			});
		}
	});

	// Group gallery images
	$('.gallery').each(function() {
		$(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {enabled:true},
			closeMarkup: ''
		});
	});
	
	// Group main.archive images
	$('.format-image .post-thumbnail').magnificPopup({
		type: 'image',
		gallery:{enabled:true},
		closeMarkup: '',
		mainClass: 'mfp-with-zoom',
		zoom: {
			enabled: true,

			duration: 300,
			easing: 'ease-in-out',
			opener: function(openerElement) {
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	});
});
