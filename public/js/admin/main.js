// The App Class
// This holds the whole web app and all the modules
// Each module has its own file.
// 
// @var if jquery is loaded, return the App object, otherwise null
 ;var App = $ === jQuery ? (function ($,window,document,undefined) {

 	var
 	// PRIVATE VARS
 	sumVar = 0, 	

 	// PRIVATE PROPS
 	mainDocument = $('[data-app]'),
 	metaModules = mainDocument.find('meta[name^="module"]'),
 	modulesList = '',
 	modules = {};

 	// PRIVATE METHODS
 	

 	// gets the modules list from the meta tag
 	// IIFE in order to load modules as soon as the App is loaded
 	(function () {
 		modulesList = metaModules.attr('content');
 	})();

 	return {
 		// PROPS
 		// modules : modulesList,
 		

		// DOM
		dom : {
			main : mainDocument,
			metaModules : metaModules
		},
		 	
		// PUBLIC METHODS		
		// loads the modules from the modules list	
		checkModules : function () {
			var arr = this.dom.metaModules.attr('content').split(',');

	 		for (var i = 0; i < arr.length; i++) {
				var moduleName = arr[i];
				if (!window[moduleName])			
				{
					console.warn('The module '+moduleName+' does not exist.');			
				}					
			};
		},

		// initialize modules
		// this calls the Module's init method
		// @param moduleArr = array of module parameters:
		// [
		// 		[ 'ModuleName', [param1,param2,etc..] ]
		// ]
		modulesInit : function (moduleArr) {
			
			for (var i = 0; i < moduleArr.length; i++) {
				var name = moduleArr[i][0],
					params = moduleArr[i][0] ? moduleArr[i][1] : null;

				// run the module's init if valid
				if (window[name] && typeof window[name].init == 'function')
				{
					window[name].init.apply(this,params);
				}
				// else, throw an error
				else
				{
					// console.error(name+' is not a valid module.');
				}
			};

		},

		// event handler helper
		// this accepts an array of event handling objects
		// event handling object example:
		// {
		// 		event : 'click',
		// 		element : $('input.submit'),
		// 		handler : function (event,param) {
		// 			// some methods here;
		// 		}
		// }
		// 
		// @param arr = array of event handling objects
		eventHandlers : function (arr) {	

			// event handler creation
			function createHanlder (el,event,handler) {
				
				// manage event handling on some events
				switch	(event)
				{
					case 'ready' :
						el[event](handler);
						break;

					default :
						el.on(event,handler);
						break;
				}
			}

						
			for (var i = 0; i < arr.length; i++) {
				var evt = arr[i],
					// if the first value of this array is a string, it's a css selector,
					// if it has no jquery property, it's a native html element,
					// otherwise, its a jquery DOM object
					elem = ( typeof evt[0] == 'string' || evt[0].jquery === undefined ) ? $(evt[0]) : evt[0];
				

				

				if (typeof evt[1] != 'string')
				{
					// if the second value of this array is an array,
					// create an event handler for each array value for the same element
					for (var i = 0; i < evt[1].length; i++) {
						createHanlder(elem,evt[1][i][0],evt[1][i][1]);						
					};
				}
				else
				{		
					// if the second value of this array is a string,
					// create a single event handler for this element					
					createHanlder(elem,evt[1],evt[2]);
				}

			};
		}
		
 	}
 })(jQuery,window,document) : null;