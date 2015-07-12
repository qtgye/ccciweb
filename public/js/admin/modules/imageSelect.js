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