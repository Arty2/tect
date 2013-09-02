jQuery(document).ready(function($) {
	//add popup functionality to all image links
	$('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').magnificPopup({type:'image'});
	//initialize for wordpress galleries
	$('.gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {
			enabled: true
		}
	});
});