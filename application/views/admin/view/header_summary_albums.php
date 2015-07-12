<h3 class="panel-title"><?php echo $data->title ?></h3>
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
<?php if (count($data->list) == 0): ?>
	<span class="info info-warning" id="info2">
		<span class="info-text">
			You currently have no entry here.
		</span>
		<a href="<?php echo URL.'admin/new/'.$data->page ?>" class="btn btn-small">Add New Item</a>			
	</span>
<?php endif ?>