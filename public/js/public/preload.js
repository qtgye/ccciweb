/*
	THIS FILE CONTAINS PRELOAD SCRIPTS
*/
var app = (function haha($,window,document,undefined) {

	
	// declare variables
	var modules = {}; // holder for all the modules



	/*
		slideBar module: controls the sliding nav on mobile and tablet
		@param opts = object:
			{
				bar = the nav element,
				preventScroll = boolean , whether to prevent document scroll on nav-show
			}
	*/
	modules.slideBar = function (elem) {
		
		var s = elem,
			nav = s.find('.nav-main'),
			t = s.find('.nav-toggle'),
			o = s.find('.nav-overlay');

		t.click(function () {
			o.fadeToggle(300);
			s.toggleClass('nav-show');
		});

	}


	/*
		thumbnail
	*/
	modules.thumbnail = function (elem) {		

		elem.each(function () {
			
			var t = $(this),
				tRatio; // the width-height ratio of the thumbnail

			// set tRatio if thumbnail-ratio is defined,
			// otherwise compute the current width-height ratio
			// height is always 1, so the tRatio should be a multiplier of the width relative to the height
			if ( t.attr('thumbnail-ratio') )
			{
				tRatio = Number(t.attr('thumbnail-ratio'));
			}
			else
			{
				tRatio = t.height()/t.width();
			}

			// render the thumbnail size according to ratio
			function calcSize () {
				t.height(t.width()*tRatio);
			}

			// set background size according to tRatio
			if ( tRatio > 1 ) {
				// height > width
				
			};

			$(window).on('resize',function () {
				calcSize();
			});

			calcSize();

		})


	}




	/*
		header module: controls the header
	*/
	modules.header = function (h) {
		
		$(document).scroll(function (e) {
			
			var sTop = $(this).scrollTop();

			if ( sTop > 20 )
			{
				if ( !h.hasClass('header-contract') )
				{
					h.addClass('header-contract')
				}
				
			}
			else
			{
				h.removeClass('header-contract')
			}

		})

	}

	/*
		dropdown module : controls the dropdown feature
	*/
	modules.dropdown = function (elem) {

		var animating = false,
			open;

		elem.each(function () {

			var targetId = '#'+$(this).attr('data-dropdown'),
				target = $(targetId),
				topD = '80%',
				topT = '100%';			
			
			$(this).click(function (e) {

				e.preventDefault();

				if ( !animating  )
				{
					animating = true;

					$(open)
						.animate({
							'opacity' : 0,
							'top':topD
						},200,function () {
							$(this).css('display','none');
							animating = false;
						});


					if ( targetId != open )
					{
						target
							.css('display','block')
							.animate({
								'opacity':1,
								'top':topT
							},200,function () {
								animating = false;
							})

						open = targetId;
					}
					else
					{
						open = null;
					}					
					
				}				

			});

		})

	}
	



	return {
		// opts : object containing the jquery object for html elements initiated at domready
		init : function (opts) {
			
			if (typeof opts == 'object')
			{
				for ( key in opts )
				{
					modules[key] ? modules[key](opts[key]) : null;
				}
			}			

		}
	}

})(jQuery,window,document);