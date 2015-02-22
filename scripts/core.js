jQuery(document).ready(function($) {
	
/*--------------------------------------------------------------
Header animations
--------------------------------------------------------------*/
/*	var body = $('html, body');
	var target = $('#logo');
	//ease to target if the user hasn't scrolled already
	setTimeout(function() {
		if (window.pageYOffset == 0) {
			body.animate({ scrollTop: target.offset().top }, 500);
		}
	}, 3000);

	$('body > header').hover(
		//ease to top on target mouseenter
		function() {
			if (window.pageYOffset != 0) {
				body.delay(1000).animate({ scrollTop: 0 }, 500);
			}
		},
		//ease back to target on mouseleave
		//unless the user has scrolled down already
		function() {
			body.stop(true);
			if (window.pageYOffset < target.offset().top) {
				body.animate({ scrollTop: target.offset().top }, 500);
			}
		}
	);*/

/*--------------------------------------------------------------
Normalised Greek small-caps: https://gist.github.com/Arty2/e6855b956e79ee4d2455
fixes erroneous behaviour of browsers that display accents on Greek small-caps
at the time of writing, the latest versions of Firefox, Chrome and Opera behave properly; IE doesn't, of course
--------------------------------------------------------------*/
	if (!jQuery().greek_small_caps) {
		$.fn.greek_small_caps = function() {
			String.prototype.replaceArray = function(search, replace) {
				var text = this;
				for (var i = 0; i < search.length; i++) {
					text = text.replace(search[i], replace[i]);
				}
				return text;
			};
			var text_search = ['άι', 'έι', 'όι', 'ύι', 'άυ', 'έυ', 'ήυ', 'όυ', 'ά', 'έ', 'ή', 'ί', 'ΐ', 'ό', 'ύ', 'ΰ', 'ώ'];
			var text_replace = ['αϊ', 'εϊ', 'οϊ', 'υϊ', 'αϊ', 'εϋ', 'ηϋ', 'οϋ', 'α', 'ε', 'η', 'ι', 'ϊ', 'ο', 'υ', 'ϋ', 'ω'];

			this.each(function() {
				if ($(this).css('text-transform') == 'uppercase' || $(this).css('fontVariant') == 'small-caps') {
					var text = $(this).text();
					text = text.replaceArray(text_search, text_replace);
					$(this).text(text);
				}
			});
		};
	}

	$('dt:lang(el), h1:lang(el), h2:lang(el), h3:lang(el), a:lang(el)').greek_small_caps();

/*--------------------------------------------------------------
Style External links
--------------------------------------------------------------*/
	$('a[href*="//"]:not([href*="' + window.location.hostname + '"])').css('cursor', 'alias');

/*--------------------------------------------------------------
Slide thumbnails on archive view
should be applied on figure:hover
--------------------------------------------------------------*/
	$('main.archive article figure > img').hover(
		function() {
			$(this).css('transform', 'translate(-' + ($(this).width() - $(this).parent().width()) + 'px, 0)');
		},
		function() {
			$(this).css('transform', 'translate(0, 0)');
		}
	);

/*--------------------------------------------------------------
Hyperlink index
--------------------------------------------------------------*/
	/*$('#appendix-hyperlinks').one( "click", function() {
		var ref = 1;

		$('article q[cite], article blockquote[cite], article a[href]:not(a[href^="#"]):not(a[class*="share-"]):not(.tags a):not(header h1 a)').each(function() {
			$(this).after('<sup class="ref">{' + ref + '}</sup>');
			var url = $(this).attr('cite') || $(this).attr('href');
			$('#appendix ol').append('<li>' + url +'</li>');
			ref++;
		});

		$('#appendix h1').css( "display", "block");

		window.print();
	});*/

/*--------------------------------------------------------------
Popup windows
--------------------------------------------------------------*/
	$('.share-twitter, .share-facebook').popupWindow({
		width: 550,
		height: 250,
		centerScreen: 1 
	});


/*--------------------------------------------------------------
Draggables: https://gist.github.com/Arty2/11199162
alternative to jQuery UI’s draggable
based on comments from: http://css-tricks.com/snippets/jquery/draggable-without-jquery-ui/
see: http://popdevelop.com/2010/08/touching-the-web/
--------------------------------------------------------------*/
	if (!jQuery().draggable) {
		$.fn.draggable = function() {
			var _fixMobileEvent = function (e) {
				if (e.originalEvent && e.originalEvent.targetTouches && e.originalEvent.targetTouches[0]) {
					var t = e.originalEvent.targetTouches[0];
					e.pageX = t.clientX;
					e.pageY = t.clientY;
					return true;
				} else {
					return false;
				}
			};
			this
				.css('cursor', 'move')
				.on('mousedown touchstart', function(e) {
					_fixMobileEvent(e);
					var $dragged = $(this);

					var startOffset = $dragged.offset();
					var x = startOffset.left - e.pageX,
						y = startOffset.top - e.pageY,
						z = $dragged.css('z-index');

					if (!$.fn.draggable.stack) {
						$.fn.draggable.stack = 999;
					}
					stack = $.fn.draggable.stack;
					var firstMove = true;
					var $preventClick = null;

					$(window)
						.on('mousemove.draggable touchmove.draggable', function(e) {
							_fixMobileEvent(e);
							//$("#log").text("x: " + e.pageX + "; y: " + e.pageY);

							if (firstMove) {
								firstMove = false;
								$dragged
									.css({'z-index': stack, 'transform': 'scale(1.1)', 'transition': 'transform .3s',
										  'bottom': 'auto', 'right': 'auto'
									});
									/*.find('a').one('click.draggable', function(e) {
										e.preventDefault();
										e.stopImmediatePropagation();
										$("#log").text("link: click prevented " + stack);
									});*/
								var $target = $(e.target);
								if ($target.is('a')) {
									$preventClick = $target;
									$target.one('click.draggable', function(e) {
										e.preventDefault();
										e.stopImmediatePropagation();
										//$("#log").text("link: click prevented " + stack);
									});
								} else if ($dragged.is('a')) {
									$preventClick = $dragged;
									$dragged.one('click.draggable', function(e) {
										e.preventDefault();
										e.stopImmediatePropagation();
										//$("#log").text("dragged: click prevented " + stack);
									});
								}
							}
							$dragged.offset({
								left: x + e.pageX,
								top: y + e.pageY
							});
							e.preventDefault();
						})
						.one('mouseup touchend touchcancel', function() {
							$(this).off('mousemove.draggable touchmove.draggable');
							$dragged.css({'z-index': z, 'transform': 'scale(1)'})
							$.fn.draggable.stack++;
							if (_fixMobileEvent(e)) {
								if ($preventClick) $preventClick.off('click.draggable');
								var endOffset = $dragged.offset();
								//$("#log").text("left :" + startOffset.left + "; top: " + startOffset.top
								//               + "; newLeft: " + endOffset.left + "; newTop: " + endOffset.top);
								if (Math.abs(endOffset.left - startOffset.left) <= 3
										&& Math.abs(endOffset.top - startOffset.top) <= 3) {

									if ($preventClick) {
										$preventClick[0].click();
									} else {
										var $target = $(e.target);
										if ($target.is('a')) {
											e.target.click();
										} else if ($dragged.is('a')) {
											$dragged[0].click();
										}
									}
								}
							}
						});

					e.preventDefault();
				});
			return this;
		};
	}


	$('.format-standard .post-thumbnail, .format-standard header, .format-image figure').draggable();

/*--------------------------------------------------------------
Masonry
--------------------------------------------------------------*/
	/*var $container = $('main.archive');
	$container.imagesLoaded( function() {
		$container.masonry({ 
			itemSelector: 'article',
			// 'isFitWidth': true,
		});
	}).css({'margin': '0 auto'});*/


});

