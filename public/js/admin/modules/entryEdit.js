// EntryEdit Module
// This Module Controls the edit entry page
// This requires the Image Select Module in order to check uploading status of image
;var EntryEdit = (function () {
	// private vars

	// the Entry Edit Class
	// @param elemSelector = string, the css selector for the element containing the edit field
	function _EE(elemSelector) {
		var e = this,
			main = $(elemSelector);
	
		// props



		// DOM structure
		e.dom = {
			main : main,
			fields : [],
			fieldsButtons : {
				publish : main.find('.edit-btn-publish'),
				saveDraft : main.find('.edit-btn-draft')
			}
		}


		// methods





		// event handlers
		// App.eventHandlers(Array(
		// 	{
		// 		event : 'click'	
		// 	}
		// ));		
		App.eventHandlers([
			[
				e.dom.fieldsButtons.publish.add(e.dom.fieldsButtons.saveDraft),'click',
				function (e) {					
					if (ImageSelect.isUploading())
					{
						e.preventDefault();
						log('still uploading');
					}
				}
			]
		]);

	}

	// public vars and methods
	return {
		// initializes the module
		// @param selector = string, the css selector for the containing element
		init : function (selector) {
			var ee = new _EE(selector);			
		}
	}
})();