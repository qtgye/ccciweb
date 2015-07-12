// Sticky Plugin
// Makes navs and menus stick to window upon scroll
;$.fn.sticky = function () {

	// Sticky Object Constructor
	function Sticky (elem) {
		var s = this,
			e = $(elem),
			w = $('<div>').insertBefore(e),
			wC = $('<div>').appendTo(w),
			fixed = false;

		// props
		s.prop = {
			offsetTop : 0,
			offsetLeft : 0,
			width : 0,
			height : 0
		};

		// dom structure
		s.domMain = e;
		s.domMain
			.css({
				'z-index':'997',
				'top':0,
				'left':0
			});

		// methods
		// init
		s.init = function () {
			s.prop.width = w.width();
			s.prop.height = w.height();	
			s.prop.offsetTop = w.offset().top;	
			s.prop.offsetLeft = w.offset().left;			
		};


		s.fix = function (b) {
			if (b === true)
			{
				wC									
					.addClass('sticky-fixed')
					.css({
						'width':s.prop.width,
						'height':s.prop.height
					});	

				w.css({						
						'width':s.prop.width,
						'height':s.prop.height
					});

				wC.css({'left':s.prop.offsetLeft});
					
				fixed = true;
			}
			else
			{				
				wC
					.removeClass('sticky-fixed')
					.css({
						'width':'auto',
						'height':'auto'
					});

				w.css({
						'width':'auto',
						'height':'auto'
					});

				wC.css({'left':0});
				
				fixed = false;
			}
			
		}
		s.stick = function () {
			var sTop = $(window).scrollTop();
				if (sTop >= s.prop.offsetTop) {
					if (!fixed) {
						s.fix(true);
					};
				}
				else
				{
					if (fixed) {
						s.fix(false);
					};				
				}
		}

		// IIFE
		// wrap the element, and set fixed height and width for the wrapper
		;(function () {
					
		})();

		// event handlers
		App.eventHandlers([
			[
				$(document), 'ready',
				function () {
					
					e.appendTo(wC);		
					
					s.init();

					s.stick();					
				}
			],
			[
				$(window), 'resize',
				function () {

					s.init();
					s.stick();

				}
			],
			[
				$(document), 'scroll',
				function () {					
					s.stick();					
				}
			]			
		]);	
		
	}

	// Sticky Object Instantiation
	return this.each(function () {		
		var sticky = new Sticky(this);
	})
};