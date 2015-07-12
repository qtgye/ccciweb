// DOM Ready scripts
$(document).ready(function () {
	
	app.init({
		slideBar :  $('.nav-group'),
		header : $('header'),
		dropdown : $('[data-dropdown]'),
		thumbnail : $('.thumbnail-image')
	});

	if ( $.fn.lightbox )
	{
		lightbox.init();
	}

});
