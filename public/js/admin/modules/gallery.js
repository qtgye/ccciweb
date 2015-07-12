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