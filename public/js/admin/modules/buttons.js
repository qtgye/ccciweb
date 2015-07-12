// The Button Module
// Enables the button elements (elements meant as buttons) to behave as buttons
// Enhances User Interactions and Feedbacks
;var Buttons = (function () {

	// Button class
	// @param e = html object
	function _Btn(e) {
		var b = this;

		// PROPS
		
		
		// DOM
		b.dom = {
			button : null
		}

		// METHODS		


		// IIFE to load defaults
		;(function () {

			// update properties
			b.dom.button = $(e);

			// EVENT HANDLERS
			b.dom.button.mousedown(function () {
				b.dom.button.addClass('btn-pressed');							
			})
			.mouseup(function () {
				b.dom.button.removeClass('btn-pressed');							
			});

		})();
	}

	// get the instance
	return {		
		// intializes all elements by selector to behave as buttons
		init : function (selector) {
					elem = selector.jquery ? selector : $(selector);					
					elem.each(function () {
						var bb =  new _Btn(this);
						return bb;
					});					
				}		
	}	
})();