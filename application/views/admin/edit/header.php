<form action="" method="post">
	<h3 class="panel-title">
		<a href="<?php URL.'admin/view/'.$data->page ?>">
			<?php echo ($data->title) ?>			
		</a>
	</h3>
	<?php if ($data->info): ?>		
		<span class="info info-<?php echo $data->info->type ?>" id="info2">
			<span class="info-text">
				<?php echo $data->info->content ?>
			</span>
			<?php if ($data->info->button->title): ?>
				<a href="<?php echo $data->info->button->link ?>" class="btn btn-small"><?php echo $data->info->button->title ?></a>
			<?php endif ?>			
			<span class="info-close" data-info="#info2">&times;</span>			
		</span>
	<?php endif ?>	
	<div class="panel">
	
