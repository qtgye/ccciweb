<!DOCTYPE html>
<html lang="en" data-app='' class="<?php echo preg_match('/(Admin Login|Registration)/', $data) ? 'login_window' : '' ?>">
<head>	
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="modules" content="Facebook,AjaxPublish,Collapse,Buttons,UploadButton,ItemsList,ImageSelect,EntryEdit,Modal_Default">	
	<title><?php echo !empty($data)?$data:'No Page Present' ?></title>
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_global.css">	
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_xs.css">
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_sm.css">
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_md.css">
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_large.css">	
	<link rel="stylesheet" href="<?php echo URL ?>css/admin/style_xlarge.css">
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
	<script src="<?php echo URL . 'js/Facebook.js' ?>"></script>
	<script src="<?php echo URL . 'libs/scrollbar/jquery.mCustomScrollbar.concat.min.js' ?>"></script>	
	<script src="<?php echo URL . 'js/App.js' ?>"></script>
	<script src="<?php echo URL . 'js/Collapse.js' ?>"></script>
	<script src="<?php echo URL . 'js/Helpers.js' ?>"></script>	
	<script src="<?php echo URL . 'js/script.js' ?>"></script>
	<script src="<?php echo URL . 'js/DOMready.js' ?>"></script>
</head>
<body>
	<script>

		// load the FB JS SDK
		Facebook.appConnect();

		$(document).ready(function () {
			
		});

	</script>
</body>
</html>