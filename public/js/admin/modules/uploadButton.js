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