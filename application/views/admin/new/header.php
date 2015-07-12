<!-- load tinymce plugin -->
<script src="<?php echo URL . 'libs/tinymce/tinymce.min.js' ?>"></script>

<script>
	tinymce.init({
			selector:'.tinymce',
			 plugins: [
		        "advlist autolink lists link image charmap print preview anchor",
		        "searchreplace visualblocks code fullscreen",
		        "insertdatetime media table contextmenu paste"
		    ],
		    height : 250,	  
		    resize : false,
		    menubar : false,
		    toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
		});
</script>

<form action="" method="post">	
	<div class="panel-header">
		<?php if (isset($data->title)): ?>
			<h3 class="panel-title">			
				<?php echo $data->method == 'new' ? 'New Entry for ' : 'Edit Entry for' ?>
				<a href="<?php echo URL.'admin/view/'.$data->page ?>">
					<?php echo ucwords(str_replace('_', ' ', $data->page)) ?>			
				</a>
			</h3>
		<?php endif ?>
		
		<?php if (!empty($data->info->content)): ?>		
			<span class="info info-<?php echo $data->info->type ?>" id="info2">
				<span class="info-text">
					<?php echo $data->info->content ?>
				</span>
				<?php if ($data->info->button->title): ?>
					<a href="<?php echo $data->info->button->link ?>" class="btn btn-small btn-center"><?php echo $data->info->button->title ?></a>
				<?php endif ?>			
				<span class="info-close" data-info="#info2">&times;</span>			
			</span>
		<?php endif ?>	
	</div>
	<div class="panel">
		<div class="table-fields">	
