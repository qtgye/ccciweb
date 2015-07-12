// The Dropdown Module
// Singleton

var Dropdown = (function () {
	var open = false,
		animating = false,
		openDropdown = null,
		num = 0;

	// Dropdown class
	function _D(e) {
		var d = this;

		// PROPS
		d.dropDownSelector = null;
		d.open = false;	
		d.toggleId = null;

		// DOM
		d.dom = {
			toggle : $(e),
			dropDown : null
		}

		// METHODS

		// animate dropDown
		// @param bool if true, open dropdown, else close.
		d.slide = function (b) {					
			if (b)
			{				
				d.dom.dropDown
					.slideDown(250)
					.queue(function () {						
						animating = false;						
						$(this).dequeue();
					});				
			}
			else
			{							
				d.dom.dropDown
					.slideUp(250)
					.queue(function () {
						animating = false;						
						$(this).dequeue();
					});
			}
		};		

		// methods
		d.init = function () {
			if (d.dom.dropDown.length < 1 )
			{
				d = null;		
			};
		};


		// IIFE to load defaults
		;(function () {
			d.dropDownSelector = d.dom.toggle.attr('data-dropdown');			
			d.dom.dropDown = $(d.dropDownSelector);	
			d.toggleId = d.dom.dropDown.attr('id');			
			if (d.dom.dropDown.length > 0 )
			{
				// EVENT HANDLERS
				d.dom.toggle.click(function (e) {
					e.preventDefault();
					if (animating == false)
					{				
						animating = true;
						if (openDropdown)
						{
							openDropdown.slide();
							openDropdown.open = false;
							if (openDropdown.toggleId != d.toggleId)
							{
								d.slide(true);
								d.open = true;
								openDropdown = d;
							}
							else
							{
								openDropdown = null;
							}
						}
						else
						{					
							d.slide(true);
							openDropdown = d;
							openDropdown.open = true;					
						}
					};			
				});						
			}
			else
			{
				d = null;
			}

		})();		
		
	}

	// get the instance
	return {		
		create : function (selector) {
					elem = selector.jquery ? selector : $(selector);					
					elem.each(function () {
						var dd =  new _D(this);
						//dd.init();
						return dd;
					});					
				}		
	}	
})();
