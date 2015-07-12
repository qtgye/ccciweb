var gulp = require('gulp'),
	sass = require('gulp-sass'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename');


gulp.task('concat',function () {
	var jsDir = './public/js/admin'
	return gulp.src([
			jsDir+'/main.js',
			jsDir+'/modules/Facebook.js',
			jsDir+'/modules/Collapse.js',
			jsDir+'/modules/buttons.js',
			jsDir+'/modules/sticky.js',
			jsDir+'/modules/itemsList.js',
			jsDir+'/modules/uploadButton.js',
			jsDir+'/modules/imageSelect.js',
			jsDir+'/modules/entryEdit.js',
			jsDir+'/modules/ajaxPublish.js',
			jsDir+'/modules/gallery.js',
			jsDir+'/modules/script.js',
			jsDir+'/modules/DOMready.js'
		])
		.pipe(concat('App.js'))
		.pipe(gulp.dest(jsDir+'/'));
});

// - Button Module
// - Sticky Plugin
// - Items List Module
// - Upload Button Module
// - Image Select Module
// - EntryEdit Module (requires the Image Select Module)
// - AjaxPublish Module
// - The Gallery Module