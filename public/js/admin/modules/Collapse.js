// The Dropdown Module
// Singleton

var Collapse = (function () {
	var animating = false,
		collapseGroups = {},
		slideSpeed = 150,
		num = 0;

	// Dropdown class
	function _C(e) {
		var c = this;

		// PROPS
		c.collapseSelector = null; // the css selector for the collapse element	e.g. (data-collapse="#collapsible1")	
		c.collapseId = null; // the id attribute of the collapse element 
		c.group = null; // the name of the collapse group to where this belongs (collapse-group="collapsibles")	
		c.preventDefault = true // whether toggle clicks should prevent default actions or not. Default is true. (collapse-preventDefault="false")
		
		// DOM
		c.dom = {
			toggle : $(e),
			collapsible : null
		}

		// METHODS

		// animate collapsible
		// @param bool if true, open dropdown, else close.
		c.slide = function (b) {					
			if (b === true)
			{				
				c.dom.collapsible
					.slideDown(slideSpeed,'swing')
					.queue(function () {						
						animating = false;						
						$(this).dequeue();
					});				
			}
			else if (b === false)
			{							
				c.dom.collapsible
					.slideUp(slideSpeed,'swing')
					.queue(function () {
						animating = false;						
						$(this).dequeue();
					});
			}
			else
			{
				c.dom.collapsible
					.slideToggle(slideSpeed,'swing')
					.queue(function () {
						animating = false;						
						$(this).dequeue();
					});
			}			
		};

		// collapse all dropdowns
		c.collapseAll = function () {
			c.dom.collapsible.toggle(false);
		}

		// add this dropdown group to collapseGroups list if not yet listed
		c.addGroup = function () {
			c.group = c.dom.toggle.attr('collapse-group');

			if (c.group)
			{
				if (!collapseGroups['n'] )
				{
					// add the group name as a property of collapseGroups (like an associative array)
					// group should be an object
					collapseGroups[c.group] = {						
						expanded : null, // list which collapsible is expaned						
					}

					
				}				
			}
			
		}		

		// methods
		c.init = function () {			
			
		};


		// IIFE to load defaults
		;(function () {

			// update properties
			c.preventDefault = c.dom.toggle.attr('collapse-preventDefault') || true;
			c.collapseSelector = c.dom.toggle.attr('data-collapse');			
			c.dom.collapsible = $(c.collapseSelector).css('display','none');	
			c.collapseId = c.dom.collapsible.attr('id');


			if (c.dom.collapsible.length > 0 )
			{
				// default methods
				c.addGroup();				

				// EVENT HANDLERS
				c.dom.toggle.click(function (e) {

					// prevent default actions if true
					if (c.preventDefault === true)
					{
						e.preventDefault();
					};

					if (animating == false)
					{				
						animating = true;

						// if this has no collapse group, it wont affect other collapsibles
						if (!c.group) {
							c.slide();
						}
						else
						{
							// if there is an expanded member
							if (collapseGroups[c.group].expanded)
							{		

								// if this is not the expanded member
								if (collapseGroups[c.group].expanded.collapseId != c.collapseId)
								{
									c.slide(true);		
									collapseGroups[c.group].expanded.slide();
									collapseGroups[c.group].expanded = c;
								}
								else
								{									
									c.slide(false);
									collapseGroups[c.group].expanded = null;									
								}
							}
							else
							{					
								c.slide(true);								
								collapseGroups[c.group].expanded = c;								
							}
						}
						
					};
							
				});						
			}
			else
			{
				c = null;
			}			

		})();		
		
	}

	// get the instance
	return {		
		init : function (selector) {
					elem = selector.jquery ? selector : $(selector);					
					elem.each(function () {
						var dd =  new _C(this);						
						return dd;
					});
				}
	}	
})();
