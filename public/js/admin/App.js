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
// The Facebook module
// This module handles operations that uses the Facebook Javascript SDK
// This module should be initiated directly after the FB.init() method


;var Facebook = (function () {
	
	// some private vars here
	var FBInitParams  = {
	          appId      : '1504042413186568',	          
	          xfbml      : true,
	          version    : 'v2.1'
	        },
	    opts = {
	    	appId : '1504042413186568',
	    	appSecret : 'bdfa7723d9aa2d5cbd777d79ebe76217',	
	    	group : {
				id : '135309263223390',
				access_token : 'CAAVX6ynD3ggBAPqO6PqlRUOOfe47dchWLEMZBMNG7oeIVe5FIFZAPYcADCZB7w2FfhULfdX1AQiD5ecQdzZCmSfGT0n63Bjg8UOXhEbM681Xdwj7ZCocdRZCYS8I6UippRx9DWPzNiM49YWPkd25jfz7DZCjyARwvyutQYsWrOthTIo8UnzKxtzfjYL8wZAMzEPGDLSF4SbZBZBteSqVWRcoFB'
			},
			page : {
				id : '146340972105458',
				access_token : 'CAAVX6ynD3ggBANzevl2Ql7DsQUWEuODdJbZBOJlcKvE5BgZApdHEfFIuMYz7YvZCt9I6LpZAoWttUghZBtMrSmJXRqDiqXF2mSB4Xn9gNeipTE3dgQbPzuw61YZA6qefquZAtYruUf3OCB25nnsjpfVhi5vPDNtiCK26VZChEGb2cyNFnu96OHAG3cZCcJ8uI7pAZD'
			},
			admin : {
				id : '872621992749168',
				access_token : 'CAAVX6ynD3ggBAC9IWzOVLUAFfw6ZBL3tui3hZCHWugqGbOGflY3S3SxvsNmqoS1yKcr5yuJZCZCABBadmWWW7yYyK8Btx9vI88z8q0toEa0u2ssCfz5ReZBQbrjpQ5GBnrWaIMEgOZA73JDvM29gBiDUWNXSa2NyqtyAQSxs5We2m2uYn4Vs4S2521MikKzjeuUdgMtM7KEZBRPszpSEz8i'
			}
	    };	

	// extension object
	var extObj = {
		connected : true,		
		sendPost : function (postParams,callback) {
			// send post to page			

			FB.api(
				opts.page.id+'/feed/?access_token='+opts.page.access_token,
				'post',
				postParams,
				function (res) {

					console.log(res);

					// if error
					if (res.error)
					{
						res.error.customMessage = 'However, the entry was not posted to Facebook.';
						callback(res);
					}
					// else, send to group
					else
					{
						// FB.api(
						// 	opts.group.id+'/feed/?access_token='+opts.group.access_token,
						// 	'post',
						// 	postParams,
						// 	function (res2) {

						// 		var res = res2;

						// 		// if error
						// 		if (res.error)
						// 		{
						// 			res.error.customMessage = 'The entry was posted on Facebook Page, but not on Facebook Group.';
						// 			callback(res);
						// 		}
						// 		// else, run callback function immediately
						// 		else
						// 		{
						// 			callback(res);
						// 		}
						// 	}
						// );
					}
					
				}
			);			
		}
	}    

	// some private functions here
	function getFBInitParams () {
		return FBInitParams;
	}

	



	// The Class
	// @param fbObject = object, the FB main object
	function _FB(fbObject)
	{
		var f = this,
			FB = fbObject;


		// extend the main Facebook Module upon loading this class
		f.extendModule  = function () {
			$.extend(Facebook,extObj);
		};		

		f.init = function() {			

			console.log('Testing Facebook App connection...');

			// perform api test that restarts on failure or timeout of 5sec
			var connectLoop = setTimeout(function () {

				clearTimeout(connectLoop);
				f.init();

			},5000);

			// test api if connected succesfully
			FB.api(
				// opts.group.id+'/?access_token='+opts.group.access_token,
				'me/?access_token='+opts.group.access_token,
				'get',
				function (res) {

					clearTimeout(connectLoop);

					if (!res.error)
					{
						// connected
						f.extendModule();
						console.info('Successfully connected to CCCI Web App.');						

					}
					else
					{
						// handle connect error here;
						console.warn('Unable to connect to Facebook App.');
						f.init();
					}
				}
			);
		};

	}	
	


	// The return object returned
	return {

		// load the Facebook JS SDK
		appConnect : function () {			
	        window.fbAsyncInit = function () {
	        	FB.init(getFBInitParams());
	        	Facebook.init();
	        };

		    (function(d, s, id){
		    	var js, fjs = d.getElementsByTagName(s)[0];
		    	if (d.getElementById(id)) {return;}
		    	js = d.createElement(s); js.id = id;
		    	js.src = "//connect.facebook.net/en_US/sdk.js";
		    	fjs.parentNode.insertBefore(js, fjs);
		    }(document, 'script', 'facebook-jssdk'));
		},

		// instantiate the _FB class
		init : function () {

			// check whether a valid FB object exists			
			if (typeof FB == 'object' && FB.XFBML)
			{
				var fb = new _FB(FB);
				fb.init();
			}
			else
			{
				console.warn('The Facebook Javascript SDK was not loaded.');
				return;
			}
			
		}
	}



})();
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
// Items List Module
// This controls the items list page.
// Behaviors and User
;var ItemsList = (function () {
	
	// private variables
	var checkedValuesArray = [],
		checkedCount = 0;

	// the ItemsList Class
	function _L() {
		
		// vars
		var l = this; 

		// dom structure
		l.dom = {
			main : $('.content'),
			options : $('.main-actions-collapse'),
			btnCheckAll : $('#check_uncheck, #check_uncheck_2'),
			checkedOptions : $('.multiple-actions-dropdown'),
				trashChecked : $('[name="multiple_trash"]'),
				deleteChecked : $('[name="multiple_delete"]'),
			itemsList :  $('.query-list'),
			items : $('.query-item'),
			itemsCheckboxes : $('input[name="items_checked[]"]')
		};

		// methods of the class
		l.methods = {
			init : function () {	

				l.dom.options.sticky();

			},
			checkAllItems : function (bool) {				
				l.dom.itemsCheckboxes.prop('checked',bool);
				l.methods.updateCheckedCount();
			},
			toggleCheckedOptions : function (bool) {
				if (bool === true)
				{
					l.dom.checkedOptions.slideDown(100);
				}
				else
				{
					l.dom.checkedOptions.slideUp(100);
				}
			},
			updateCheckedValuesArray : function () {
				checkedValuesArray = [];

				$('input:checked')
					.map(function(){						
				        checkedValuesArray.push($(this).val());				        
				    });				

				l.dom.deleteChecked.attr('data-id',checkedValuesArray.join(','));				
			},
			updateCheckedCount : function () {
				checkedCount = l.dom.itemsList.find(':checked').size();	

				l.dom.trashChecked.attr('value','Trash '+checkedCount+' Item'+(checkedCount>1?'s':''));

				if (checkedCount > 0)
				{
					l.methods.toggleCheckedOptions(true);
					
				}
				else
				{
					l.methods.toggleCheckedOptions(false);
				}
				
				l.methods.updateCheckedValuesArray();
			}
		}

		// event listeners
		l.dom.itemsCheckboxes.change(function () {
			var checked = $(this).prop('checked');
			
			if (checked)
			{
				checkedCount++;
			}
			else
			{
				checkedCount--;
			}

			l.methods.updateCheckedCount();
			
		});

		l.dom.btnCheckAll.click(function () {			
			if (l.dom.btnCheckAll.hasClass('btn-pressed'))
			{
				l.dom.btnCheckAll.removeClass('btn-pressed')
				l.methods.checkAllItems(false);				
			}
			else
			{
				l.dom.btnCheckAll.addClass('btn-pressed')
				l.methods.checkAllItems(true);				
			}			
		});
	};

	return {
		init : function () {			
			// instantiate the Class
			var L = new _L();

			L.methods.init();
		}
	}

})();
// UploadButton Button
// Creates a nice browse button to replace the default file input element
;var UploadButton = (function () {
	
	// The Upload Button Class
	// @param e, html element (file input)
	function _U(e) {
		var u = this,
			main = e.context ? e : $(e); // make sure it is a jquery object

		// props


		// dom
		u.dom = {
			input : main
					.css({
						'display': 'block',	
						'height': '100%',
						'position': 'absolute',
						'top': 0,
						'left': 0,
						'font-size': '50px',
						'opacity': 0,
						'cursor' : 'pointer'
					}),
			btn : $('<div>',{class:'btn btn-light'})
					.text('Browse Files')					
					.css({
						'position' : 'relative',
						'height' : '30px',
						'width' : '150px',
						'line-height' : '30px',
						'display' : 'block',
						'margin' : 'auto',
						'padding' : 0
					})
		}

		// methods
		$.extend(u,{
			init : function () {				
				u.dom.btn
					.insertAfter(u.dom.input)
					.append(u.dom.input)
			}
		});

		// IIFE


	}

	// Return Public Object
	return {
		// method init()
		// @param elems, html elements selector (e.g., ".class #elemId")
		init : function (selector) {
			var e = $(selector);
			
			for (var i = 0; i < e.length; i++) {
				var uu = new _U(e[i]);				
				uu.init();
			};
		}
	}

})();
// Image Select Module
// Controls the modal where user can choose an image to insert
;var ImageSelect = (function () {
	// private vars
	var uploading = false;

	//imageSelect plugin
	function imageSelectObj(elem) {
		var self = this, $elem = elem,
			errorField = $('#selectError'),
			input = $elem.find('input[type="text"]'),
			img = $elem.find('.image-block').find('img'),
			imgBtnBlock = $elem.find('.image-block').find('.image-block-buttons'),
			modalSrc = $(elem.attr('data-source')),
				radio = modalSrc.find('input[type="radio"]'),
				// buttons
				selBtn = modalSrc.find('#btn-image-select'),
				urlBtn = modalSrc.find('#btn-image-url'),
				upBtn = modalSrc.find('#btn-image-upload'),
				cancelBtn = modalSrc.find('.btn-close'),
				// 
				select = modalSrc.find('select'),				
				uploadForm = modalSrc.find('form#uploadForm'),
				uploadInput = modalSrc.find('input[type="file"]'),
				thumbContainer = modalSrc.find('.thumbnails ul'),
				urlInput = modalSrc.find('input#url'),
				urlInfo = modalSrc.find('#urlInfo'),
				filePreview = modalSrc.find('#filePreview')
			addEditBtn = $elem.find('#add_edit_img');

		// props
		self.src = '';

		// methods
		self.thumbnailsLoading = function () {
			thumbContainer.addClass('loading');
		};
		self.thumbnailsLoaded = function () {
			thumbContainer.removeClass('loading');
		};

		//init processes
		self.init = function () {

			//ajax album list
			$.ajax({
				url : URL+'admin/get_album_list',
				type : 'post',
				data : {},
				dataType : 'json',
				async : false,	
				beforeSend : function () {
					self.thumbnailsLoading();
				},	
				success : function (res) {		
					self.thumbnailsLoaded();							
					for (var i = 0; i < res.albums.length; i++) {
						album = res.albums[i];

						if (album.title=='Default Album')
						{
							select
								.prepend(
									$('<option>',{value:album.id,disabled:true}).text('-----------------------')
								)
								.prepend(
									$('<option>',{value:album.id}).text(album.title)
								);
						}
						else
						{
							select
								.append(
									$('<option>',{value:album.id}).text(album.title)
								);
						}										
					};
				}
			});

			//trigger select change event to load photos of default album			
			self.listPhotos(select.val());

			//set the current src
			self.src = input.val();

		};


		// event handlers
		input.change(function () {
			var val = $(this).val();			

			if (val)
			{
				addEditBtn.text('Change Image');
			}
			else
			{
				addEditBtn.text('Add Image');
			}
		})
		cancelBtn.click(function() {
			radio.prop('checked',false);			
		});		
		select.change(function() {
			var album_id = $(this).val();
			self.listPhotos(album_id);			
		});
		addEditBtn.click(function() {
			if (input.val() != '')
			{			
				select.trigger('change');
				radio.each(function() {					
					if ($(this).find('img').attr('src') == img.attr('src'))
					{						
						$(this).prop('checked',true);						
					}			
				});
			}			
		});		
		selBtn.click(function() {
			src = modalSrc.find('input:checked').siblings('label').children('img').attr('src');
			input.val(src);
			img.attr('src',src);
			addEditBtn.text('Change Image');
		});
		uploadInput.change(function() {
			if ($(this).val() != '')
			{				
				filePreview.text($(this).val()).slideDown(100);
			}
			else
			{
				filePreview.slideUp(100);
			}
		});
		urlBtn.click(function() {
			if ( urlInput.val() != '' )
			{
				errorField.toggle(false);
				if (urlInput.val().match(/^http.+/ig))
				{
					input
						.val(urlInput.val())
						.trigger('change');
					img.attr('src',urlInput.val());
				}
				else{
					errorField.text('Please provide a valid image URL.').slideDown(100);					
				}
			}
		});
		upBtn.click(function() {
			errorField.slideUp(100);
			if (uploadInput.val())
			{
				if (uploadInput.val().match(/.(jpeg|jpg|png)$/gi))
				{
					// imgBtnBlock.slideUp(100);
					// src = img.attr('src');
					// img.attr('src',URL+'img/assets/icons/loader02.gif');
					// uploading=true;					
					// uploadForm.submit();
					// iframe.on('load',function() {
					// 	var r = $(this.contentDocument.body).html();						

					// 		data = JSON.parse(r);						
						

					// 	uploadInput.val('');

					// 	if (data.error)
					// 	{
					// 		img.attr('src',src);
					// 		errorField.text(data.error).slideDown(100);							
					// 		imgBtnBlock.slideDown(100);
					// 	}
					// 	else
					// 	{		
					// 		var x = setTimeout(function() {
					// 			input.val(data.uploaded.url);
					// 			img.attr('src',data.uploaded.thumbnail);
					// 			addEditBtn.text('Change Image');
					// 			imgBtnBlock.toggle(true);								
					// 		},1000);
					// 	}

					// 	uploading=false;	
					// });

					// AJAX upload if FormData is supported
					if ( FormData ) {
						var file = uploadInput[0].files[0],
							formData = new FormData();								
							formData.append('file',file);

							console.log(uploadInput);

						// ajax upload the image file
						$.ajax({
							url : URL+'admin/upload_single/1',
							data : formData,
							type : 'post',
							dataType : 'json',
							contentType : false,
							processData : false,	
							failure : function (res) {
								errorField.text('The file cannot be uploaded due to an unknown error. Please send an error report to the Web Developer regarding this issue. Thank you.').slideDown(100);
							},
							success : function (res) {
								// if success uploading,
								if (!res.error )
								{
									var x = setTimeout(function() {
												input.val(res.uploaded.url);
												img.attr('src',res.uploaded.thumbnail);
												addEditBtn.text('Change Image');
												imgBtnBlock.toggle(true);								
											},1000);
								}
								// else, error uploading
								else
								{
									errorField.text(res.error).slideDown(100);						
									
								}
							}
						});		
					}
					else
					{
						alert('Sorry, our browser does not support this feature. Please update your browser to the latest version.')
					}
					
				}			
				else
				{					
					errorField.text('Invalid file format. Must be an image file (jpg,gif,png,bmp).').slideDown(100);
				}				
			}			
		});

		// another methods
		self.listPhotos = function (album_id) {
			$.ajax({
				url : URL+'admin/get_album_photos',
				type : 'post',
				data : {
					id : album_id
				},
				dataType : 'json',	
				async : false,		
				success : function (res) {
					thumbContainer.empty();

					for (var i = 0; i < res.photos.length; i++) {
						var photo = res.photos[i],
							thumbnail  = $('\
											<li data-thumbnail="'+photo.img_thumbnail+'" data-url="'+photo.img_url+'">\
												<input type="radio" id="'+photo.id+'" class="img-select-radio" name="img_select">\
												<label for="img_'+photo.id+'">\
													<img alt="" src="'+photo.img_thumbnail+'">\
													<span class="checkmark"></span>\
												</label>\
											</li>\
										');						
						thumbContainer.append(thumbnail);

						thumbnail.click(function () {
							var url = $(this).attr('data-url'),
								thumbnail = $(this).attr('data-thumbnail');
							input.val(url).trigger('change');
							img.attr('src',thumbnail);
							modalSrc.fadeOut(100);
						});
					};					
				}
			});
		}

	}

	return {
		// image select plugin initialization
		// @param selector = string, css selector
		init : function (selector) {
			var $elem = $(selector),
				obj = new imageSelectObj($elem);
			obj.init();
		},
		isUploading : function () {			
			return uploading;
		}
	}
})();
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
// AjaxPublish Module
// This Module Controls the publish modal which sends a hidden submit request
// The modal body is constructed in HTML.
// 
// DEPENDENCY:
// - This module requires the default modal plugin/module,
//   which handles the default modal behaviors.
// REQUIRED ELEMENT:
// 	- A trigger element, which is usually the publish button.
//  - must have the 'data-publish' attribute, with the ENTRY ID as value
//  - must have the 'data-page' attribute, with the table name ( usually referred as page in this app ) as value
//	- must have the 'data-modal' attribute, with the modal element id as value
;var AjaxPublish = (function () {
	// private vars

	// The modal
	var Modal = {

		init : function () {
			
			// get the main modal dom
			this.main = $('#modal-publish');

			// extend modal properties and methods
			$.extend(this,{
				content : {
					parent : this.main.find('.modal-content'),
					sending : this.main.find('.request-sending'),
					error : this.main.find('.request-error')
				},
				buttons : {
					ok : this.main.find('.modal-btn-ok'),
					cancel : this.main.find('.modal-btn-cancel'),
					close : this.main.find('.modal-btn-close'),
					toggle : function (arr) {
						for ( btn in this ) {
							if (this[btn].toggle)
							{
								this[btn].toggle(!!~arr.indexOf(btn));
							}
						}
					}
				},
				form : {
					main : this.main.find('#modal-form-info')
				},
				fields : {
					infoParameters : this.main.find('input[name="info_parameters"]'),
					infoSubmit : this.main.find('input[name="modal_info_submit"]')
				},
				show : function () {					
					this.main.fadeIn(100);
				},
				hide : function () {
					this.main.fadeOut(100);
				},
				sending : function () {
					this.content.sending.toggle(true);
					this.content.error.toggle(false);
				},	
				error : function (msg) {					
					this.content.sending.toggle(false);
					this.content.error
						.empty()
						.prepend(
							$('<div>').html(msg)
						)						
						.toggle(true);
					this.buttons.toggle(['ok']);
				}
			});

		}
				
	};
	

	// the Entry Edit Class	
	function _P() {
		var e = this,
			trigger = $('[data-publish]'); // the trigger element
	
		// props
		$.extend(e,{
			entryId 	: trigger.attr('data-publish'),
			entryPage 	: trigger.attr('data-page'),
			method 		: trigger.attr('data-method')
		});


		if ( e.method == 'new' )
		{

		};

		// DOM structure		
		e.dom = {
			trigger : trigger,
			tableFields : $('.table-fields')
		};


		// methods
		$.extend(e,{
			init : function () {
				// some methods here
			},
			// process the fb post data from the item's data
			// @param page = string, the db table
			// @param itemData =  obj, the data of the item (e.g., id, title, description, etc.)
			processPostData : function (page,itemData) {			

				var postObj = null,
					fields = e.dom.tableFields.find('[name]') // get all fields with name attribute
					;	

				// remove error classes
				fields.removeClass('error');				

				switch (page)
				{
					case 'news' :

						postObj = {
							story : 'Web posted an update.',
							message : 'Latest Update, '+itemData.date_modified+':\r\n\r\n'+itemData.title+'\r\n\r\n',
						}						

						break;

					default:

						postObj = {							
							message : itemData.title+'\r\n\r\nRead More : '+URL+'admin/edit/'+page+'/'+itemData.id
						}						

						break;
				}

				if (itemData.id)
				{
					postObj.link = URL+'admin/'+page+'/'+itemData.id,
					postObj.name = itemData.title,
					postObj.description = itemData.summary,
					postObj.caption = 'christianchallengechurch.org',
					postObj.picture = itemData.img_url
				}

				return postObj;				

			},
			// @param arr = array, array of error field names from ajax result
			addErrorClass : function (arr) {

				// remove all error classes first
				e.dom.tableFields.find('.error').removeClass('error');

				// add error class to the error fields
				for (var i = 0; i < arr.length; i++) {
					$('#'+arr[i]).addClass('error');					
				};

			},
			updateProps : function () {

				e.entryId = trigger.attr('data-publish');
				e.entryPage = trigger.attr('data-page');
				e.method = trigger.attr('data-method');

			},			
			ajaxRequest : {
				prepareData : function () {
					var obj = {};

					if (   e.method && e.method.match(/^(new|edit)$/gi) )
					{
						// get all fields with name attribute
						var inputfields = e.dom.tableFields.find('[name]');
						// append the input values to the obj
						for (var i = 0; i < inputfields.length ; i++) {
							
							var f = $(inputfields[i]);

							// check if tinymce is used for content
							if (f.attr('name')=='content')
							{
								if (window.tinymce)
								{
									// get data from iframe
									var txt = $(document.getElementById('content_ifr').contentDocument.body).html();									
									f.val(txt);
								}							
							}
							
							obj[f.attr('name')] = f.val() ;							

						};

						// add submit button name
						obj.publish = true;
						// add method name to inform the server script that this is an AJAX post request						
						obj.method = e.method == 'new' ? 'ajax_new' : 'ajax_edit';
						// add page name
						obj.page = e.entryPage;
						// add id if method id edit
						obj.modal_field_id = e.entryId;
					}
					else
					{
						obj = {
							modal_field_id : e.entryId,
							modal_field_page : e.entryPage,
							modal_publish : true
						};
					}

					return obj;
				},				
				send : function () {

					var obj = this.prepareData();

					// check if Facebook.send is present
					if (Facebook.sendPost)
					{
						$.ajax({

							url : URL+'admin/publish_entry',
							type : 'post',
							data : obj,
							dataType : 'json',
							async : false,
							failure : function (res) {
								console.log(res);
							},
							beforeSend : function () {
									
							},
							success : function (res) {

								var dataObj = {}

								// get id and page data according to method
								switch (e.method)
								{
									case 'new':
										dataObj = {
											id : res.info.id,
											page : res.info.page
										};
										break;
									case 'edit':
										dataObj = {
											id : e.entryId,
											page : e.entryPage
										};
										break;
								}
								
								// if publish request is succesful
								if (res.info.type == 'success')
								{									
									/*
										social post methods here
										use ajax to fetch post information from db
										returning data should be an object with LINK and MESSAGE properties								
									*/
									$.ajax({
										url : URL+'admin/get_item_data',
										dataType : 'json',
										type : 'post',
										async : false,
										data : dataObj,
										failure : function (re) {
											console.warn(re);
										},
										beforeSend : function (s) {
																					
										},
										success : function (r) {

											// send post to fb
											Facebook.sendPost(
												e.processPostData(res.info.page,r),
												function (response) {

													var r = response,														
														info;																																		

													// handle error in sending post
													if (r.error)
													{											
														res.info.type = 'warning';
														res.info.content += '<p>'+r.error.customMessage+'</p>';
														res.info.content += '<div class="info-fb-error"><p>FB error : '+r.error.message+'</p></div>';														
													}

													// prepare json string
													info = JSON.stringify(res.info);
													
													// perform redirects upon succesfull publish										
													if (e.method == 'new')
													{
														// if this is a new entry, change form action to add_success page											
														Modal.form.main.attr('action',URL+'admin/add_success/'+e.entryPage);
													}													
														
													Modal.fields.infoParameters.val(info);	
													// Modal.fields.infoSubmit.trigger('click');							
											});										
											
										}
									});								
								}
								else
								{
									// Show error message
									var msg = $('<p>').html(res.info.content);

									// show modal
									Modal.error(msg);									
									Modal.content.error										
										.append(
											$('<span>',{class:'btn btn-center btn-small'})
												.text('Close')
												.click(function () {
													Modal.hide();
												})
										);

									// add error class for the error fields
									e.addErrorClass(res.errors.fields);

									console.log(res);

									console.log($('#'+res.errors.fields[0]).offsetTop + 10);

									// scroll up to the first field with error
									$('html, body').animate({
										scrollTop : $('#'+res.errors.fields[0]).offset().top - 20
									});
									
								}

							}

						});
					}
					else
					{
						var msg = '<p>The entry cannot be published because the facebook app is not connected.</p>\
									<p>You can try saving as draft and publish it later.</p>'
						Modal.error(msg);
					
					}
				}
			}
		});


		// event handlers		
		App.eventHandlers([
			[
				e.dom.trigger, 'click' ,
				function (evt) {

					e.updateProps();								

					// perform ajax request
					// if there is already an id
					if (e.entryId)
					{
						evt.preventDefault();
						Modal.show();	
						Modal.sending();
						e.ajaxRequest.send();
					}
					// if there is no id, then it is a new entry
					else
					{
						return true;
					}

				}
			]
		]);

	}

	// public vars and methods
	return {
		// initializes the module
		// @param selector = string, the css selector for the publish trigger element (e.g., publish button)
		init : function () {
			Modal.init();
			var pub = new _P();
			
		}
	}
})();
// The Gallery Module
// This controls the gallery page
;var Gallery = (function () {

	// The Gallery object constructor
	function Gallery(elem) {
		var g = this,
			e = $(elem);

		// DOM 	structure
		g.main = e;
		g.domTitle = e.find('.g_title');
		g.domCount = e.find('.g_info');			
		g.domOptions = e.find('.g_options').sticky();
			g.domCheckedCount = e.find('.g_checked_count');
			g.domCheckboxes = e.find('.g_options_checkbox');
			g.domBtnCheckAll = e.find('.g_check_all');
			g.domCheckAllCheckbox = e.find('#check_all');
			g.domCheckedOptions = e.find('.checked_options');
			g.domBtnMove = e.find('.g_move');
			g.domBtnDelete = e.find('.g_delete');
			g.domBtnThumbL = e.find('.btn-thumb-large');	
			g.domBtnThumbS = e.find('.btn-thumb-small');		

		// props
		g.title = g.domTitle.text();
		g.count = 0;
		g.items = [];
		g.checkedCount = 0;
		g.domOptionsTop = 0;
		g.task = 'delete';

		// the thumbnail class
		var Thumbnail = function (elem) {
			var o = this;
				// dom
				o.main = $(elem);
				o.opts = o.main.find('.g_thumbnail_opts');
				o.domCaption = o.main.find('textarea');
				o.domLink = o.main.find('a');
				// props
				o.id = o.main.attr('id');
				o.caption = o.domCaption.val();
				// methods
				o.updateCaption = function () {								
					// ajax handler here
					$.ajax({
						url : URL+'admin/image_update_info/'+o.id,
						dataType : 'json',
						type : 'post',
						data : {
							id : o.id,
							img_caption : o.domCaption.val()
						},
						success : function (res) {
							o.caption = o.domCaption.val();
							o.domLink.attr('data-title',o.caption);
						},
						failure : function () {
							o.domCaption.val(o.caption);
						}
					});
				};
				// event handlers
				o.domCaption.focus(function () {
					o.domCaption.change(function () {
						o.updateCaption();
					}).blur(function () {
						o.domCaption.unbind('change');
					});					
				});				
				// initializations
				o.caption = o.domCaption.val();				
				g.items.push(o);				
		}

		// the modal object instance
		g.modal = new function () {
			var m = this;
			// modal dom structure
			m.main = $('<div class="modal" id="gallery_modal">')
						.append($('<div class="modal-overlay">')
							.append($('<div class="modal-container">')
									.append($('<div class="modal-body">')
										.append($('<div>',{class:"modal-content"}))
										.append($('<div>',{class:"modal-buttons"}))
									)
								)
							);
			m.mBody = m.main.find('.modal-body');
			m.mContent = m.main.find('.modal-content');
			m.mBtnOk = $('<span>',{class:"btn btn-default btn-center"})
				.text('OK')
				.appendTo(m.main.find('.modal-buttons'));
			m.mBtnCancel = $('<span>',{class:"btn btn-cancel btn-center"})
				.text('Cancel')
				.appendTo(m.main.find('.modal-buttons'));
			m.mBtnClose = $('<span>',{class:"btn btn-round btn-top-right"})
							.html('&times;')
							.appendTo(m.mBody);			

			// methods
			m.init = function (obj) {
				m.appendTo(obj.parent);
			};
			m.appendTo = function (parent) {
				var p = parent.append ? parent : $(parent);
				p.append(m.main);
			};
			m.showModal = function () {				
				var msg = m.task == 'delete' ?
							'Are you sure to delete the selected item(s)?' :
							'Are you sure to move the selected item(s)?' ;
				m.mContent.text(msg);
				m.main
					.css({
						'opacity':0,
						'display':'table'
					})
					.animate({
						'opacity':1
					},100);				
			}
			m.hideModal = function () {
				m.main
					.animate({
						'opacity':0
					},100,function () {
						$(this).css({							
							'display':'none'
						})
					});		
					
			}
			m.confirmModal = function () {
				m.showModal();
			}

			//event handlers
			m.mBtnCancel.click(function () {
				m.hideModal();
			});
			m.mBtnClose.click(function () {
				m.hideModal();
			});
			m.mBtnOk.click(function () {
				if (m.task == 'delete')
				{
					g.domBtnDelete.trigger('click',true);	
				}
				else
				{
					g.domBtnMove.trigger('click',true);	
				}							
			});
		};

		// methods
		g.init = function() {
			g.modal.init({parent:document.querySelector('body')});
			g.updateItems();
			g.domBtnThumbL.add(g.domBtnThumbS)
				.css({
					'width': '15px',
					'height': '15px',
					'padding': '2px', 
					'margin-left': '5px',
					'background-size' : '80% auto'
				})
				.text('');
			g.domOptions.css('z-index',997);
			g.domOptionsTop = g.domOptions.offset().top;			

			// event handlers			
			g.domBtnThumbL.click(function () {				
				if (!g.main.hasClass('thumbnail_large'))
				{
					g.domBtnThumbL.addClass('btn-pressed');
					g.domBtnThumbS.removeClass('btn-pressed');
					g.main.removeClass('thumbnail_small');
					g.main.addClass('thumbnail_large');
				}
			});
			g.domBtnThumbS.click(function () {
				if (!g.main.hasClass('thumbnail_small'))
				{
					g.domBtnThumbS.addClass('btn-pressed');
					g.domBtnThumbL.removeClass('btn-pressed');
					g.main.removeClass('thumbnail_large');
					g.main.addClass('thumbnail_small');
				}
			});
			g.domCheckAllCheckbox.change(function () {				
				if (g.domCheckAllCheckbox.prop('checked'))
				{
					g.domCheckboxes.prop('checked',true);					
				}
				else
				{
					g.domCheckboxes.prop('checked',false);					
				}
				g.updateChecked();								
			});	
			g.domCheckboxes.change(function () {				
				g.updateChecked();
			});		
			// handles click event for move selected and delete selected
			g.domBtnDelete.add(g.domBtnMove).click(function (e,x) {
				g.modal.task = this.dataset.task;
				if (g.checkedCount > 0)			
				{
					if (!x)
					{
						e.preventDefault();	
						g.modal.confirmModal();	
					};
				}
				else
				{
					e.preventDefault();
				}
			});			

			

			g.domBtnThumbS.trigger('click');			
		};		
		g.updateItems = function () {
			$.each(g.main.find('.g_thumbnail'),function () {				
				g.createItemObj(this);
			});			
		}
		g.updateCount = function () {
			var c = g.items.length;
			g.domCount.text(c+' Photos');
		}
		g.getChecked = function () {
			return g.main.find('.g_thumbnail input[type="checkbox"]:checked');
		}
		g.updateChecked = function () {
			var oldCount = g.checkedCount,
				newCount = g.getChecked().size(),
				affix = newCount > 1 ? ' items selected' : ' item selected';
			// update count and text
			g.checkedCount = newCount;
			g.domCheckedCount.text(newCount+affix);

			// show or hide text count
			if (oldCount==0 && newCount > 0) {	

				g.domCheckedCount.slideDown(100);
				g.domCheckedOptions.slideDown(100);

			}
			else
			{
				if (newCount==0)
				{
					g.domCheckedCount.slideUp(100);
					g.domCheckedOptions.slideUp(100);
					g.domCheckAllCheckbox.prop('checked',false);

				}				
			}			

			// if all items are checked, trigger check all
			if (g.checkedCount == g.items.length)
			{				
				g.domCheckAllCheckbox
					.prop('checked',true);					
			}
			else
			{
				g.domCheckAllCheckbox
					.prop('checked',false);
			}
		}
		// create an instance of thumbnail object
		g.createItemObj = function (elem) {
			return new Thumbnail(elem);
		}
		
	}

	return {
		// the init method
		init : function (elemsSelector) {

			var elems = $(elemsSelector);

			elems.each(function () {
				var o = new Gallery($(this));
				o.init();
			});
		}
	}

})();
/*
	Contains the functions and plugins from the early stage of the development, which are mainly dirty coded.
*/

//preload items here
var uploading=false,sModal;

function log(exp) {
	console.log(exp);
}

// service modal Class
// This modal is dependent on the Collapse Module.
sModal = new function() {
	var m = this,
		defaults = {
			header_title : 'Add New Service',		
		},
		modal = $('<div>',{class:'modal',id:'service-modal'})
					.append(
						$('<div>',{class:'modal-overlay'})
							.append(
								$('<div>',{class:'modal-container'})
									.append(
										$('<div>',{class:'modal-body'})
											.append(
												$('<span>',{class:'btn btn-round btn-top-right btn-close'}).html('&times;')
											)
											.append(
												$('<div>',{class:'modal-header'})
													.append(
														$('<h3>').text('Add Service')
													)
											)
											.append(
												$('<div>',{class:'modal-content'})
													.append(
														$('<div>',{class:'data-preview service-data'})
															.append(
																$('<div>',{class:'row'})
																	.append(
																		$('<div>',{class:'row-cell'})
																			.append(
																				$('<span>',{class:'required'}).html('*')
																			)
																			.append(
																				$('<label>').html('Service Title :')
																			)
																	)
																	.append(
																		$('<div>',{class:'row-cell'})
																			.append(
																				$('<input>',{type:'text',id:'service_title',class:'service_title'}).html('*')
																			)
																	)
															)
															.append(
																$('<div>',{class:'row'})
																	.append(
																		$('<div>',{class:'row-cell'})																			
																			.append(
																				$('<label>').html('Day(s) :')
																			)
																	)
																	.append(
																		$('<div>',{class:'row-cell'})
																			.append(
																				$('<div>',{class:'days_options'})
																			)
																			.append(
																				$('<span>',{class:'btn btn-small btn-borderonly add_day'}).text('Add Day')
																			)
																	)
															)
															.append(
																$('<div>',{class:'row'})
																	.append(
																		$('<div>',{class:'row-cell'})																			
																			.append(
																				$('<label>').html('Time :')
																			)
																	)
																	.append(
																		$('<div>',{class:'row-cell'})
																			.append(
																				$('<select>',{class:'service_time'})
																			)																			
																	)
															)
													)													
											)
											.append(
												$('<div>',{class:'modal-buttons'})
													.append(
														$('<span>',{class:'btn btn-default modal-btn modal-btn-ok btn-add'}).text('ADD')
													)
													.append(
														$('<span>',{class:'btn btn-default modal-btn modal-btn-ok btn-update'}).text('UPDATE')
													)
													.append(
														$('<span>',{class:'btn modal-btn modal-btn-cancel btn-cancel'}).text('Cancel')
													)
											)											
									)
							)
					);
	
	m.data = {};
	m.dataSrcDiv = {};
	m.modal = {
		body : modal,
		header : modal.find('.modal-header h3'),
		buttons : {
			addDay : modal.find('.add_day'),
			addService : modal.find('.btn-add'),
			update : modal.find('.btn-update'),
			close : modal.find('.btn-close'),
			cancel : modal.find('.btn-cancel')
		},
		inputs : {
			title : modal.find('.service_title'),			
			time : modal.find('.service_time'),
			days : modal.find('.days_options'),
		},
	};	

	m.init = function () {
		var mButtons = m.modal.buttons,
			mBody = m.modal.body;

		// dom initialisations
		mBody.appendTo($('body'));	
		m.listTime();

		//event handlers
		m.modal.buttons.addDay.click(function() {				
			m.addDay(this.dataset.day);
			this.dataset.day = '';
		});		
		m.modal.buttons.close.click(function() {
			m.hideModal();
		});				
		m.modal.buttons.addService.click(function() {
			m.data = m.getModalData();			
			if (m.data.title)
			{
				var div = m.createSrcDiv(m.data);
				div.appendTo($('.service-item-list')).serviceItem();
				Collapse.init('[data-collapse]');
			}
			m.hideModal();			
		});
		m.modal.buttons.update.click(function() {			
			m.updateSrcDiv();
			m.hideModal();
		});	
		m.modal.buttons.cancel.click(function() {			
			m.hideModal();
		});	
	}

	//shows the modal
	//param method : 'new' | 'edit'
	//param data : the data object that will populate the modal inputs
	//param dataSrcDiv : the service_item instance in DOM
	m.showModal = function(method,dataSrcDiv) {
		m.data = method=='new' ? {title:'',days:[''],time:''} : JSON.parse(dataSrcDiv.find('input').val());		

		m.dataSrcDiv = dataSrcDiv;		

		if (method=='new')
		{
			m.modal.buttons.addService.toggle(true);
			m.modal.buttons.update.toggle(false);
			m.modal.header.text('Add Service');
		}
		else if (method=='edit')
		{
			m.modal.buttons.addService.toggle(false);
			m.modal.buttons.update.toggle(true);
			m.modal.header.text('Edit Service');			
		}
		m.modal.inputs.days.empty();
		m.loadModalData(m.data);
		m.modal.body.fadeIn(100);
	}

	m.hideModal = function() {		
		m.modal.body.fadeOut(100);
	}

	m.listTime = function () {
		//add time list
		m.modal.inputs.time.append(
				$('<option>')
				.attr('value','')				
			);
		for (var i = 0; i < 86400000; i+=1800000) {
			var date_format = new Date(i),
				UTC = date_format.toUTCString().match(/\s\d{2}:\d{2}/),
				hour_24 = UTC[0].trim().substring(0,2),
				hour = hour_24.match(/(24|00)/) ? 12 :(hour_24 > 12 ? hour_24 - 12 : Number(hour_24)),
				minute = UTC[0].trim().substring(3,5),
				meridian = i<43200000?' am':' pm',
				time_text = hour+':'+minute+meridian;			
			m.modal.inputs.time.append(
				$('<option>')
				.attr('value',time_text)
				.text(time_text)
			);			
		};
	}

	m.loadModalData = function (data) {
		var mInputs = m.modal.inputs;

		mInputs.title.val(data.title);
		mInputs.time.find('[value="'+data.time+'"]').prop('selected',true);
		if (data.days)
		{
			for (var i = 0; i < data.days.length ; i++) {
				m.modal.buttons.addDay.attr('data-day',data.days[i]);
				m.modal.buttons.addDay.trigger('click');
			};
		}
		else
		{
			m.addDay();
		}
	}

	//gathers the data from modal,
	//to be used for update of the dataSrcDiv
	//returns the data object
	m.getModalData = function () {
		var mInputs = m.modal.inputs,
			daysSel = mInputs.days.find('select'),
			data;

		data = {
			title : mInputs.title.val(),
			time : mInputs.time.val(),
			days : []
		};
		for (var i = 0; i < daysSel.length; i++) {
			if ($(daysSel[i]).val())
			{
				data.days.push($(daysSel[i]).val());
			}			
		};		
		return data;
	}

	m.updateSrcDiv = function () {
		var data = m.getModalData(),
			d = $(m.dataSrcDiv);

		d.find('.service_item_title').text(data.title);		
		d.find('.service_item_days').text(data.days.join(', '));
		d.find('.service_item_time').text(data.time);
		d.find('input').val(JSON.stringify(data));
	}

	m.createSrcDiv = function (data) {
		var rndId = Math.floor(Math.random() * 100) + 1,
			dataSrcDiv = $(
				'<div class="service_item" >\
					<input name="services[]" type="text" class="">\
					<div class="service_item_options">\
						<span class="btn btn-textonly" data-collapse="#'+rndId+'" collapse-group="service_item_buttons">▼</span>\
						<div class="service_item_buttons" id="'+rndId+'">\
							<span class="btn btn-del-input">Remove</span>\
							<span class="btn btn-edit btn-edit-service" data-method="edit">Edit</span>\
						</div>\
					</div>\
					<div class="service_item_info">\
						<h4 class="service_item_title"></h4>\
						<p class="service_item_days"></p>\
						<p class="service_item_time"></p>\
					</div>\
				</div>\
				');	
		
		dataSrcDiv.attr('id',data.title+'_'+rndId);
		dataSrcDiv.find('.service_item_title').text(data.title)
		dataSrcDiv.find('.service_item_days').text(data.days.join(', '))
		dataSrcDiv.find('.service_item_time').text(data.time);	
		dataSrcDiv.find('input').val(JSON.stringify(data));


		return dataSrcDiv;
	}

	m.addDay = function(day) {
		var ddDayBtn = m.modal.buttons.addDay,
			div = $('<div>',{class:"service_days"}),
			select = $('<select name="" id="">\
						<option value="" disabled>Select One</option>\
						<option value="Everyday">Everyday</option>\
						<option value="" disabled>-----------</option>\
						<option value="Sunday">Sunday</option>\
						<option value="Monday">Monday</option>\
						<option value="Tuesday">Tuesday</option>\
						<option value="Wednesday">Wednesday</option>\
						<option value="Thursday">Thursday</option>\
						<option value="Friday">Friday</option>\
						<option value="Saturday">Saturday</option>\
					</select>')
					.appendTo(div),
			rmv = $('<span>',{class:"btn btn-del-input"})
					.text('x')
					.appendTo(div)
					.click(function() {
						$(this).parent().remove();
					});
		
		if ( day )
		{					
			select.children('option[value='+day+']').prop('selected',true);
		}
		else
		{
			select.children('option:first-child').prop('selected',true);
		}

		div.appendTo(m.modal.inputs.days);		
	}
}

String.prototype.capitalizeFirst = function() {
	return this.replace(/^./,this[0].toUpperCase());
};
function toTitle(str) {
	switch (str) {		
		case 'name_first': return 'First Name';
		case 'name_last' : return 'Last Name';
		case 'name_middle' : return 'Middle Name';
		case 'name_ext' : return 'Name Extension';
		case 'date_created' : return 'Date Created';
		case 'date_modified' : return 'Last Modified';
		case 'img_url' : return 'Image';
		case 'img_caption' : return 'Image Caption';
		case 'date_publish' : return 'Publish Date';
		case 'user_name' : return 'User Name';
		case 'map_url' : return 'Map Link';
		case 'map_image' : return 'Map Image';
		case 'pastor_name' : return 'Pastor\'s Name';
		case 'social' : return 'Social Network Page';
		case 'title_abbr' : return 'Title Abbr.';
		case 'title_abbr' : return 'Title Abbr.';
		case 'date_established' : return 'Date Established';
		case 'asst_coordinator' : return 'Asst. Coordinator';

		default: return str.capitalizeFirst();
	}
};
function processValue(str,col) {
	switch (col) {		
		case 'a':

		default: return str;
	}
}

//info block plugin
$.fn.infoBlock = function() {
	var infoBlocks = $(this);
	return infoBlocks.each(function() {
		var self = this,
			$self = $(self),
			infoId = self.dataset.info;
		$self.click(function() {
			$(infoId).slideUp(100).queue(function() {
				$(this).remove();				
			});
		});		
	});
};
//uploader plugin
//element should be a form
//feedBackDiv (optional) : the div containing the feedback, will be created if null.
$.fn.uploader = function (feedBackDiv) {
	//the uploader class
	function Uploader(e,div) {
		var u = this,			
			elem = $(e),
			sDiv = $('<div>',{class:'feedback_single'});

		//properties
		u.items = []; 
		u.form = elem;
		u.album = e.dataset.id,
		u.action = elem.attr('action'),
		u.uploading = false;
		u.currentItemIndex = -1;
		u.lastItemIndex = -1;	
		u.uploaded = 0;	
		u.count = 0;		

		// dom structure
		u.main = elem;		
		u.photosCount = elem.find('.photos_count');
		u.form = elem.find('form');
		u.optionsBlock = elem.find('.upload_form_options').sticky();
		u.uploadStatus = elem.find('.upload_status');
		u.input = document.getElementById(elem.find('input[type="file"]').attr('id'));
		u.submit = elem.find('input[type="submit"]');
		u.browseContainer = elem.find('.upload_input_btn');
		u.browse = elem.find('.browse-btn');
		u.fDiv = div || $('<div>',{class:'feedback'}); //the feedBack div containing all the feedback elements				

		u.init = function () {			
			u.count = Number(u.main.attr('data-count').match(/^[0-9]+/)[0]);			
			u.appendFDiv();
			u.submit.toggle(false);
			u.browseBtnTarget = $(u.input).attr('id');
			$(u.input)				
				.change(function () {
					u.uploadFiles();
				});
		};
		u.updateCount = function () {			
			u.main.attr('data-count',u.count);
			u.photosCount.text('('+u.count+' Photos'+')');
		}	
		u.browseDisabled = function (b) {			
			if (b) {
				u.browse.attr('for',null);	
			}
			else
			{
				u.browse.attr('for',u.browseBtnTarget);	
			}				
		};	
		u.statusUploading = function () {
			u.optionsBlock.addClass('loading');
			u.uploaded = 0;
			u.uploading = true;
			u.uploadStatus
				.toggle(true)
				.text('Uploading...');
		}
		u.statusUploaded = function () {
			u.optionsBlock.removeClass('loading');
			u.uploading = false;
			u.updateCount();
			u.uploadStatus
				.text(u.uploaded+' item'+(u.uploaded>1?'s':'')+' uploaded');
		}
		// get the next item from u.items
		// if next item exists, upload
		// else, stop uploading
		u.uploadNext = function () {
			var currentItemIndex = u.lastItemIndex + 1;			
			if(u.items[currentItemIndex])
			{
				var obj = u.items[currentItemIndex];

				u.lastItemIndex++;

				obj.sDiv.loading();

				// ajax upload the image file
				$.ajax({
					url : URL+'admin/upload_single/'+u.album,
					data : obj.formData,
					type : 'post',
					dataType : 'json',
					contentType : false,
					processData : false,	
					failure : function (res) {
						obj.sDiv.uploadError(res);
					},
					success : function (res) {
						// if success uploading,
						if (!res.error && res.uploaded.size > 0)
						{
							obj.sDiv.uploadSuccess(res.uploaded);
							u.uploaded++;
						}
						// else, error uploading
						else
						{
							obj.sDiv.uploadError(res.error);
							console.log(res);							
							
						}
						u.count++;						
						u.uploadNext();
					}
				});	
			}
			else
			{				
				u.statusUploaded();
			}
		}
		u.uploadFiles = function () {
			
			// if input has value
			if (u.inputHasValue())
			{
				//change browse button caption
				u.browse.text('Add More Photos');

				// if input.files is supported ( IE >= 9 )
				if (u.formDataSupported())
				{
					var uploads = [],
						files = u.input.files;										

					// create an sDiv object for each file
					for (var i = 0; i < files.length; i++) {
						var file = files[i];
						// verify file extension
						// accepted ext: .JPG,.GIF,.PNG,.BMP
						if (file.type.match(/.(jpg|jpeg|png)$/gi))
						{
							//file is of accepted format
							//create an instance of File Class
							var f = new function() {
								var obj = this;

								obj.formData = new FormData();								
								obj.formData.append('file',file);								
								obj.file = file;
								obj.sDiv = u.createSDiv(file.name);
								obj.sDiv.queued();
								obj.sDiv.addTo(u.fDiv);

								// add this sDiv object to uploader items
								u.items.push(obj);	
								uploads.push(obj);
							}							
						}
						else
						{
							console.log('File with index '+i+' is not a valid image file');
						}
					};					

					// if no upload is in progress, start upload
					if (!u.uploading)
					{						
						u.statusUploading();
						u.uploadNext();
					}										
					
				}
				// else ( IE < 9 )
				else
				{	
					var iframe = $('<iframe>',{name:'upload_iframe'}).appendTo(u.main);
					
					u.statusUploading();						

					u.form.submit();
					u.browseDisabled(true);					
					iframe.on('load',function () {

						var text = $(this.contentDocument.body).text(),
							res = JSON.parse(text);
																
						$(this).remove();

						for (var i = 0; i < res.uploaded.length; i++) {
							var up = res.uploaded[i],
								obj = {};

							obj.sDiv = u.createSDiv();
							obj.sDiv.addTo(u.fDiv);
							obj.sDiv.uploadSuccess(up);
							u.items.push(obj);
							u.uploaded++;
							u.count++;
						};											

						u.statusUploaded();	
						u.browseDisabled(false);						
					})
				}				
			}
		};
		u.inputHasValue = function () {
			return $(u.input).val() ? true : false;
		};
		u.inputFilesSupported = function () {
			return u.input.files ? true : false;
		};
		u.formDataSupported = function () {
			return FormData ? true : false;
		};
		u.appendFDiv = function () {
			u.fDiv.insertAfter(u.form);
		};
		u.createSDiv = function (filename) {
			return  {					
					main : sDiv.clone().appendTo(u.fDiv),
					link : $('<a>',{class:'feedback_link',target:'_blank'}),
					img : $('<img>'),	
					titleBlock : $('<div>',{class:'title_block'}),
					captionBlock : $('<div>',{class:'caption_block hide'}),
					captionInput : $('<textarea>'),			
					addTo : function (parent) {
						this.main.appendTo(parent);
					},	
					queued : function () {
						this.main
							.append(this.titleBlock.html('\
								Queued:<br>'+
								filename
								));
					},
					loading : function () {
						this.titleBlock
							.html('\
								Uploading:<br>'+
								filename
								);
						this.main.addClass('loading');
					},
					uploadSuccess : function (file) {
						var self = this,
							cBlock = self.captionBlock,
							img_url = file.url.replace(/(\/photos\/)/,'/photos/_thumbnails/');											


						$('<p>',{class:'caption_header'})
							.text('Add Caption:')
							.prependTo(cBlock);						

						self.link
							.attr('href',file.url)
							.appendTo(self.main);

						self.img
							.css('display','none')
							.attr('src',img_url)
							.appendTo(self.link)
							.fadeIn(500);

						self.main
							.removeClass('loading');

						cBlock
							.removeClass('hide')
							.append(self.captionInput)
							.appendTo(self.main);

						self.img.on('error',function () {
							img_url = file.url;
							$(self).attr('src',img_url);
						});

						self.titleBlock
							.html(file.title);

						self.captionInput
							.change(function () {								

								var img_id = file.id,
									c = self.captionInput.val();									

								//ajax the caption;
								$.ajax({
									url: URL+'admin/image_update_info/'+img_id,
									type : 'post',
									dataType : 'json',
									data : {
										id : img_id,
										img_caption : c
									}									
								});
							})
						
					},
					uploadError : function (error) {
						this.main
							.removeClass('loading')
							.html(error);
						this.titleBlock.toggle(false);							
					}
				};
		};
	}

	return this.each(function () {
		var uploader = new Uploader(this,feedBackDiv);
		uploader.init();
	})
};

//input remove plugin
$.fn.inputRemove = function(target) {
	return this.each(function () {
		var e = target ? target : $(this).parent();	
		$(this).click(function () {				
			e.remove();
		})		
	});
};
//input social plugin
$.fn.inputSocial = function() {	
	return $(this).each(function() {
		var href = '';
		$(this).keyup(function(e) {
			var href = $(this).val();		
			$(this).next('a').attr('href',href);	
		});
		
		$(this).next('a')
			.attr('href',$(this).val())
			.click(function(e) {			
				if ( $(this).attr('href').match(/^http[s]?:\/\//) )
				{
					return true;
				}
				else
				{
					console.log('Provided link is not a valid url.');
					return false;
				}
			});	
	});
};

//tab plugin
$.fn.tabs = function() {
	var tabs = $(this);
	return	tabs.each(function() {
		var self = this, $self = $(this),
			tH = $self.find('.tab-header'),
			tHBtn = tH.find('.btn-tab'),
			tP = $self.find('.tab-panels'),
			tPPanel = tP.find('.tab');		
		tHBtn.each(function(i) {	
			var btn = this;					
			$(btn).click(function() {				
				tHBtn.not(this).removeClass('btn-tab-selected');
				if (!$(btn).hasClass('btn-tab-selected'))
				{
					$(btn).addClass('btn-tab-selected');
				}
				tPPanel.css('display','none');
				tPPanel.eq(i).css('display','block');
			});
		});
	});
};
//datePopup plugin
$.fn.datePicker = function() {	
	//date picker object constructor
	function datePicker(elem) {
		var self = this, $elem = $(elem),
			popup = $('<div>',{class:'date-popup'}),
			popupTable = $('<table>').appendTo(popup),
			tdY = $('<td>\
					<select class="date-y" width="12">\
						<option value="" disabled selected>--Year--</option>\
					</select>\
				</td>').appendTo(popupTable),
			tdM = $('<td>\
					<select class="date-m" >\
						<option value="" width="12" disabled selected>--Month--</option>\
					</select>\
				</td>').appendTo(popupTable),
			tdD = $('<td>\
					<select class="date-d" >\
						<option value="" width="4" disabled selected>--Day--</option>\
					</select>\
				</td>>').appendTo(popupTable),
			popupBtn = $('\
					<span class="btn btn-right btn-default btn-small btn-textonly btnCancel">Cancel</span>\
					<span class="btn btn-small btn-right btnOk">INSERT</span>').appendTo(popup),			
			year = popup.find('.date-y'),
			month = popup.find('.date-m'),
			day = popup.find('.date-d'),
			btnOk = popup.find('.btnOk'),
			btnCancel = popup.find('.btnCancel'),
			yr = elem.dataset.year,
			months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		
		self.init = function() {
			popup.insertAfter($elem);			
		}

		self.updateDays = function() {
			var m31 = ['January','March','May','June','August','October','December'],
				m30 = ["April","July","September","November"],
				m = month.val(),
				start, output;
			if ( m31.indexOf(m) != -1 ) {
				max = 31;
			} else if ( m30.indexOf(m) != -1 ) {
				max = 30;
			} else if ( year.val()%12 > 0 ) {				
				max = 28;
			} else {
				max = 29;
			}
			day.children('.days').remove();
			for ( var i = 1; i <= max; i++ ) {
				var d = i < 10 ? '0'+i : i ;
				day.append($('<option>',{class:'days',value:d}).text(i));
			}			
		};

		self.getDate = function() {
			if ( year.val() != null && month.val() != null && day.val() != null ) {
				return year.val()+'-'+month.val()+'-'+day.val();
			}	else {
				return null;
			}		
		};		

		$elem.click(function(e) {			
			popup.fadeToggle(100);
		});		

		btnCancel.click(function() {
			popup.fadeOut(100);
		});

		btnOk.click(function() {
			$elem.val(self.getDate());
			popup.fadeOut(100);
		});
			
		year.change(function() {
			month.css('visibility','visible');
		});
		month.change(function() {		
			self.updateDays();
			day.css('visibility','visible');
		});
		year.change(function() {
			self.updateDays();
		});	

		// append years options
		for ( var i=yr; i >= 1970; i-- ) {		
			year.append($('<option>',{value:i}).text(i));
		}

		// append months options
		for ( var i=0; i < 12; i++ ) {	
			var m = i < 9 ? '0'+(i+1): i+1;
			month.append($('<option>',{value:m,class:'months'}).text(months[i]));
		}	

		month.add(day).css('visibility','hidden');
	}

	return this.each(function() {
		var dp = new datePicker(this);	
		dp.init();
	});
};
//itme-picker plugin
$.fn.timePicker = function() {
	return	$(this).each(function() {
		var self = this, $self = $(this),
			tPDiv = $('<div>').css({
				'overflow-y':'scroll',
				'height':'5em',
				'position':'absolute',
				'top':'80%',
				'z-index':99999,
				'background':'#fff',
				'min-width':'5em',
				'box-shadow':'1px 5px 10px rgba(0,0,0,0.5)',
				'padding':'5px',
				'border-radius':'5px',
				'display':'none'
			}).insertAfter($self),
			tpUl = $('<ul>').appendTo(tPDiv);

		$self
			.attr('placeholder','e.g., 8:00 am, 3:30 pm')
			.click(function() {
				tPDiv.fadeToggle(100);
			})
			.parent().css({
				'position':'relative'
			});

		//add time list			
		for (var i = 0; i < 86400000; i+=1800000) {
			var date_format = new Date(i),
				UTC = date_format.toUTCString().match(/\s\d{2}:\d{2}/),
				hour_24 = UTC[0].trim().substring(0,2),
				hour = hour_24.match(/(24|00)/) ? 12 :(hour_24 > 12 ? hour_24 - 12 : Number(hour_24)),
				minute = UTC[0].trim().substring(3,5),
				meridian = i<43200000?' am':' pm',
				time_text = hour+':'+minute+meridian;			
			tpUl.append(
				$('<li>')
				.text(time_text)
				.css({
					'text-align':'right',
					'cursor':'pointer'
				})
				.hover(
					function() {
						$(this).css('background','#CAFA8A');
					},
					function() {
						$(this).css('background','#FFF');
					})
				.click(function() {
					$self.val($(this).text());
					tPDiv.fadeOut(100);
				})
			);			
		};
	});
};
//service Item plugin
$.fn.serviceItem = function () {
	// serviceItem object constructor
	function ServiceItem(elem) {
		var o = this,
			e = $(elem);

		//additional properties for this object
		$.extend(o,{
			data : {},
			DOM : {
				main : e,
				title : e.find('.service_item_title'),
				days : e.find('.service_item_days'),
				time : e.find('.service_item_time')
			},
			buttons : {
				edit : e.find('.btn-edit'),
				remove : e.find('.btn-del-input'),
			}
		});

		o.modal = sModal;

		//initialisation method
		o.init = function () {
			o.updateData();
			o.buttons.remove.inputRemove(o.DOM.main);		
			o.buttons.edit.click(function () {
				o.updateData();				
				o.modal.showModal('edit',e);				
			});	
		}

		o.updateData = function() {
			o.data = {
				title : o.DOM.title.text(),
				days : o.DOM.days.text().split(', '),
				time : o.DOM.time.text()
			}
		};

		
	};
	return this.each(function() {		
		var sItem = new ServiceItem(this);
		sItem.init();		
	});	
};

//add service modal plugin
//default modal plugin
$.fn.modal = function() {
	var pModals = $(this);
	return pModals.each(function() {
		var self = this,
			m = $(self),
			mtype = m.attr('modal-type'), //preview | info | warning | confirm | trash
			modalId = self.dataset.modal,
			p = $(modalId),
			modalBody = p.find('.modal-body'),
			modalHeader = p.find('.modal-header .modal-title'),
			modalContent = p.find('.modal-content'),			
			mPane = self.dataset.pane,
			mStatus = self.dataset.status,			
			mTask = self.dataset.task,
			mDataId= m.attr('data-id') || null,
			modalButtons = p.find('.modal-buttons'),
				mBtnPublish = modalButtons.find('.modal-btn-publish'),
				mBtnActivate = modalButtons.find('.modal-btn-activate'),
				mBtnEdit = modalButtons.find('.modal-btn-edit'),
				mBtnTrash = modalButtons.find('.modal-btn-trash'),
				mBtnRestore = modalButtons.find('.modal-btn-restore'),
				mBtnDeactivate = modalButtons.find('.modal-btn-deactivate'),
				mBtnDelete = modalButtons.find('.modal-btn-delete'),
					mConfirmDelete = modalButtons.find('#confirm-delete').toggle(false),
				mBtnYes = modalButtons.find('.modal-btn-yes'),
				mBtnNo = modalButtons.find('.modal-btn-no'),
				mBtnClose = modalButtons.find('.btn-close'),
				mBtnCancel = modalButtons.find('.btn-cancel'),	
			mPage = self.dataset.source,
			mForm = p.find('#modal-default-form'),
				mFieldId = mForm.find('#modal-field-id'),
				mFieldPage = mForm.find('#modal-field-page'),
			mUrl = self.href,			
			fetchUrl = URL+'admin/ajaxFetch/';

		App.eventHandlers([			
			[
				m, 'click',
				function(e) {	

					p.addClass('load');
					modalBody.css('opacity',0);

					e.preventDefault();
					modalHeader.empty();

					// reset modal attributes
					mBtnPublish.attr({
						'data-publish': '',
						'data-page' : ''
					});	

					// updates modal form fields
					mFieldId.val(m.attr('data-id'));
					mFieldPage.val(mPage);

					switch (mtype)	{

						case 'preview' :
							var pubTxt,mStatus2;					

							modalButtons.children('.btn').toggle(false);			
							modalContent.empty();
							mBtnCancel.toggle(true);												

							//ajax this id from this src(table name in database)
							$.ajax({
								type: 'POST',
								dataType: 'json',
								data : {
									id : mDataId,
									method : 'view',
									src: mPage
								},
								url: fetchUrl,
								beforeSend: function() {	
									var loading = $('<div>',{class:'modal-loading'})
													.append(
														$('<img>',{src:URL+'public/img/assets/icons/loader01.gif'}).css({'display':'block','margin':'20px auto'})
													);
									modalContent.append(loading);
									modalHeader.text('Loading Data...');													
								},
								success: function(result) {
									var tbl = $('<div>',{class:'data-preview',cellspacing:0}),
										trMeta = $('<div>',{class:'meta data-preview-row'}).appendTo(tbl),
										meta = ['date_created','date_modified','user_name','status','tags'];

									// update modal attributes
									mBtnEdit.attr('href',URL+'admin/edit/'+mPage+'/'+mDataId);
									// update modal publish if valid page
									if (mPage.match(/(news|articles|stories|events)/gi))
									{
										mBtnPublish.attr({
											'data-publish': mDataId,
											'data-page' : mPage											
										});	
									}
									else
									{
										mBtnPublish.removeAttr('data-publish');
									}
									// show modal buttons is user edittable
									if ( result.user_edittable )
									{
										// set modal buttons to display based on mStatus/mPage
										switch (mStatus)
										{
											case 'active':
												mBtnDelete
													.add(mBtnDeactivate)
													.add(mBtnEdit)
													.toggle(true);							
											break;
											case 'waiting':
												mBtnDelete
													.add(mBtnActivate)
													.add(mBtnEdit)
													.toggle(true);							
											break;
											case 'published':
												mBtnEdit
													.add(mBtnTrash)								
													.toggle(true);							
											break;
											case 'draft':
												mBtnEdit
													.add(mBtnTrash)		
													.add(mBtnPublish)
													.toggle(true);									
											break;
											case 'trash':
												mBtnRestore							
													.add(mBtnDelete)							
													.toggle(true);												
											break;
										}	
									}
																

									if (!result.error)
									{	
										var tdMetaTitle = $('<div>',{class:'data-title data-preview-col meta'}).text('Meta').appendTo(trMeta),
											tdMetaContent = $('<div>',{class:'data-content data-preview-col meta'}).appendTo(trMeta),
											modalHeaderTitle = '';
										

										// set the modal header title
										if (result.data.title)
										{								
											modalHeaderTitle = result.data.title;									
										}
										else if (result.data.username)
										{								
											modalHeaderTitle = result.data.username;									
										}
										else if (result.data.name_first)
										{								
											modalHeaderTitle = result.data.name_first+' '+result.data.name_last;									
										}
										// update modal header title
										modalHeader.text(modalHeaderTitle);


										for (var title in result.data)
										{		
											var text = '', tdClass='';
											if (title.match(/(contact|social)/))	
											{
												text = result.data[title].join('<br>');
											}									
											else if (title.match(/^(services)$/))
											{
												if (result.data[title])
												{
													var arr = result.data[title];

													text = $('<div>',{class:'data-preview-service'});										

													for (var i = 0; i < arr.length; i++) {
														var obj = arr[i],
														srvc = $('<div>',{class:'service-preview-item'})
																.append($('<h4>').text(obj.title))
																.append($('<p>').text(obj.days.join(', ')))
																.append($('<p>').text(obj.time))
																.appendTo(text);
													};
												}
											}
											else if ( meta.indexOf(title) > -1 )
											{
												text = '<p>';
												text += toTitle(title)+' : ';
												text += result.data[title];
												text += '<p>';									
												tdClass = 'meta';
												tdMetaContent.append(text);

												continue;
											}
											else
											{
												text = (result.data[title] == '')? '' : (title == 'img_url') ? '<div><img src='+result.data['img_url']+'></div>' : result.data[title];
											}
											
											tbl.append($('<div>',{class:'data-preview-row'})
												.append($('<div>',{class:'data-title data-preview-col'+tdClass}).text(toTitle(title)))
												.append($('<div>',{class:'data-content data-preview-col'+tdClass}).html(text))
											);							
										}

										// ensure that the meta row is in the bottom
										trMeta.appendTo(tbl);
									}	
									else
									{
										tbl.append($('<h3>').text(result.error));
									}

									modalContent.empty();				
									modalContent.append(tbl);										
								}
							});
							break;

						case 'trash':
							modalButtons.children('.btn').toggle(false);			
							modalContent.empty();

							modalHeader.text('Confirm Trash');															

							mBtnYes.attr('name','modal_trash');
							mBtnYes.add(mBtnCancel).toggle(true);				
							modalContent.append($('<p>').text('Are you sure you want to trash this entry?'));					
							break;

						case 'delete':
							var confirmText = '';

							// set modal text according to page
							switch (mPage)
							{
								case 'albums':
									confirmText = 'Are you sure you want to permanently delete this entry and its photos?';
									break;
								default :
									confirmText = 'Are you sure you want to permanently delete this entry?';
									break;
							}

							modalHeader.text('Confirm Delete');	

							modalButtons.children('.btn').toggle(false);			
							modalContent.empty();															

							mBtnYes.attr('name','multiple_delete');
							mBtnYes.add(mBtnCancel).toggle(true);				
							modalContent.append($('<p>').text(confirmText));					
							break;

					} // end switch

					p.fadeToggle(100).delay(500).queue(function(){
						modalBody.animate({'opacity':1},250,function(){
							p.removeClass('load');
						});
						$(this).dequeue();
					});

					
				}
			]

		]);

					
	});
};

// 






// DOM post load scripts
;(function ($,window,document,undefined) {

	// private vars
	var $window = $(window);

	// event handlers
	App.eventHandlers([		
		[
			document,'ready',
			function () {

				// check modules
					App.checkModules();

				// plugins initialization
					$('*[data-modal]').modal();
					sModal.init();
					$('.date-picker').datePicker();	
					$('*[data-info]').infoBlock();	
					$('.modal-tabs').tabs();		
					$('.time-picker').timePicker();	
					$('#service_modal').click(function() {
						sModal.showModal('new');
					});
					$('.service_item').serviceItem();					
				
				// Modules Initializations go here
					App.modulesInit([
						['Collapse',['*[data-collapse]']],
						['Buttons',['.btn, .sidebar-toggle-xi, .item-option-btn, .sidebar-menu li']],
						['UploadButton',['input[type="file"]']],
						['ItemsList'],
						['ImageSelect',['*[data-source]']],
						['EntryEdit',['.panel']],
						['AjaxPublish'],
						['Gallery',['.gallery']]
					]);					

				// some independent methods
				$('.item-option-btn').text('');

				// event handlers
				App.eventHandlers([
					[
						'*[data-popup]','click',
						function() {
							var popupId = this.dataset.popup,
								p = $(popupId);
							p.fadeToggle(100);
						}
					],
					
				]);		
					
					
				

				$('#add_contact').click(function() {
					var rndId = (Math.floor(Math.random() * 999999) + 111111)+'_'+Date.now();
						inputDiv = $('<div id="contact_'+rndId+'" class="contact_field input_group"><input name="contact[]" type="text"></div>').insertBefore($(this));
					$('<span data-remove="#contact_'+rndId+'" class="btn btn-del-input">Remove</span>').appendTo(inputDiv).inputRemove();
				});
				$('#add_social').click(function() {
					var inputDiv = $('<div class="input_group"><a class="btn btn-textonly test-link" target="_blank">Test Link</a></div>').insertBefore($(this)),
						input = $('<input name="social[]" type="text" placeholder="e.g.: www.facebook.com/user/me">').inputSocial().prependTo(inputDiv);
					$('<span class="btn btn-del-input">x</span>').appendTo(inputDiv).inputRemove();
				});
				$('input[name^="social"]').inputSocial();	
				$('.btn-del-input').inputRemove();
				$('.edit-btn-cancel').attr('href','javascript:history.back()');		

				//$('#feedback')
				$('#upload-main').uploader();		

				// show the document
				$('body').css('overflow','auto');
				$('.preloader').fadeOut();
				$('.service-container').removeClass('service-hide-options');
			}
		],
		[
			window,
			[				
				[
					'resize load',
					function (e) {
					$windowWidth = $window.width();	

					// set events for each resize breakpoint
					if ( $windowWidth > 1024)
					{
						$(".modal-container").mCustomScrollbar({
							axis: "y",		
							theme : "light-thin",	
							scrollInertia : 350,
							autoHideScrollbar : false,			
							contentTouchScroll: 25,
							setWidth : '85%',
							updateOnImageLoad: true
						});
						$(".tab-row.modal-thumbnails").mCustomScrollbar({
							axis: "y",
							theme : "dark-thin",
							scrollInertia : 350,
							autoHideScrollbar : true,			
							contentTouchScroll: 25
						});
					}
					else
					{
						$(".modal-container").mCustomScrollbar("disable",true);
						$(".tab-row.modal-thumbnails").mCustomScrollbar("disable",true);
					}
				}
				]
							
			]
		]		

	]);
	// close App.eventHandlers





})(jQuery,window,document);