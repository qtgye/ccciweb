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