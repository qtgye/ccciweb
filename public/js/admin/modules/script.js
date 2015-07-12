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





