<!DOCTYPE html>
<html lang="en" data-app='' class="<?php echo preg_match('/(Admin Login|Registration)/', $data->header_title) ? 'login_window' : '' ?>">
<head>	
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="modules" content="Facebook,AjaxPublish,Collapse,Buttons,UploadButton,ItemsList,ImageSelect,EntryEdit">	
	<title><?php echo !empty($data->header_title)?$data->header_title:'404 Not Found' ?></title>
	<link rel="icon" type="image/png" href="<?php echo URL ?>img/assets/logo/ccci_logo_64.png">
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_global.css">
	<!-- gsgsggasasg -->
	<link rel="stylesheet" media="screen and (min-width:400px)" href="<?php echo URL ?>css/admin/style_xs.css">
	<link rel="stylesheet" media="screen and (min-width:600px)" href="<?php echo URL ?>css/admin/style_sm.css">
	<link rel="stylesheet" media="screen and (min-width:800px)" href="<?php echo URL ?>css/admin/style_md.css">
	<link rel="stylesheet" media="screen and (min-width:1000px)" href="<?php echo URL ?>css/admin/style_large.css">	
	<link rel="stylesheet" media="screen and (min-width:1025px)" href="<?php echo URL ?>css/admin/style_xlarge.css">
	<link rel="stylesheet" href="<?php echo URL ?>libs/scrollbar/jquery.mCustomScrollbar.css">	
	<script>
		//sets the defined constants
		URL = '<?php echo URL ?>';
		APP = '<?php echo addslashes(APP) ?>';
		ROOT = '<?php echo addslashes(ROOT) ?>';
		//define yr to be used for date-picker popup
		yr = <?php echo date('Y',time()) ?>;
	</script>
	<script src="<?php echo URL . 'libs/jquery.js' ?>"></script>
	<script src="<?php echo URL . 'libs/scrollbar/jquery.mCustomScrollbar.concat.min.js' ?>"></script>	
	<script src="<?php echo URL . 'js/admin/App.js' ?>"></script>
</head>
<body>
	<script>

		// load the FB JS SDK
		Facebook.appConnect();

		// append preloader
		$('body')
			.css({
				'overflow':'hidden'
			})
			.append(
				$('<div>',{class:'preloader'})
					.append(
						$('<div>',{class:'loader'})
					)
			);		
	</script>



	<div class="wrapper">
