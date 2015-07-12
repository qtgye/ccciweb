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