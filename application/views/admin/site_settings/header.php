<div class="panel-header">
	<h3>Site Settings</h3>
</div>

<div class="panel">

	<div class="main-actions">
		
	</div>

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
