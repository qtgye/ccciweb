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