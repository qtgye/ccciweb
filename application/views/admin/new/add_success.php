<div class="panel">	
	<div class="success-message">
		<h3>Success!</h3>
		<p>You have succesfully added new item.</p>
		<?php if (!empty($data->info->content)): ?>
			<div class="info info-<?php echo $data->info->type ?>" >
				<?php echo $data->info->content ?>
			</div>
		<?php endif ?>
		<br>
		<div class="success-actions">			
			<a class="btn btn-small btn-borderonly" href="<?php echo URL.'admin/view/'.$data->page.'/'.$data->status ?>">Go To <?php echo ucwords($data->status).' List of '.ucwords(str_replace('_', ' ', $data->page)) ?> </a>
			<a href="<?php echo URL.'admin/add_new/'.$data->page ?>" class="btn btn-small btn-borderonly">Add Another</a>
		</div>
	</div>
</div>