<form action="" method="post">
	<input type="text" class="hide" name="source_page" value="<?php echo $data->page ?>">
	
	<div class="panel-header">
		<h3 class="panel-title">
			<?php echo ucwords($data->status)?> Items For 
			<a href="<?php echo URL.'admin/view/'.$data->page?>">
				<?php echo ucwords(str_replace('_', ' ', $data->page))?>
			</a>
		</h3>
	</div>

	<div class="panel">
		<div class="main-actions">
			<a class="btn btn-invert" href="<?php echo URL.'admin/add_new/'.$data->page?>"><span>Add New</span></a>
			<?php if (isset($data->list) && count($data->list) > 0): ?>
				<?php if ( $data->status != 'trash'): ?>
					<?php if ($data->page!='users'): ?>
						<input type="submit" name="multiple_trash" value="Trash Selected" class="btn btn-textonly btn-small btn-right">
					<?php else: ?>	
						<input type="submit" name="multiple_delete" data-modal="#default-modal" modal-type="delete" data-source="<?php echo $data->page ?>" value="Delete Selected" class="btn btn-textonly btn-small btn-right">
					<?php endif ?>
				<?php else: ?>
					<input type="submit" name="multiple_delete" data-modal="#default-modal" modal-type="delete" data-source="<?php echo $data->page ?>" value="Delete Selected" class="btn btn-textonly btn-small btn-right">
				<?php endif ?>
				<span id="check_uncheck" class="btn btn-right">Check/Uncheck All</span>
			<?php endif ?>			
			<div class="cf"></div>
		</div>	

		<div class="main-actions-collapse">

			<?php if ($data->page!='users'): ?>
				<a class="btn btn-default btn-small" href="<?php echo URL.'admin/add_new/'.$data->page?>"><span>Add New</span></a>
			<?php endif ?>
			
			<?php if (isset($data->list) && count($data->list) > 0): ?>
				<span id="check_uncheck_2" class="btn btn-small btn-borderonly" >Check/Uncheck All</span>
				<div class="multiple-actions-dropdown hide">				
					<?php if ( $data->status != 'trash'): ?>
						<?php if (!preg_match('/(users|albums)/i', $data->page)): ?>
							<?php if ($data->page!='albums'&&$data->status!='published'): ?>
								<input type="submit" name="multiple_publish" value="Publish Selected" class="btn btn-invert btn-small">
							<?php endif ?>
							<input type="submit" name="multiple_trash" value="Trash Selected" class="btn btn-invert btn-small">
						<?php else: ?>	
							<input type="submit" name="multiple_delete" data-modal="#default-modal" modal-type="delete" data-source="<?php echo $data->page ?>" value="Delete Selected" class="btn btn-invert btn-small">
						<?php endif ?>
					<?php else: ?>
						<input type="submit" name="multiple_delete" data-modal="#default-modal" modal-type="delete" data-source="<?php echo $data->page ?>" value="Delete Selected" class="btn btn-invert btn-small">
					<?php endif ?>						
				</div>
			<?php endif ?>
		</div>			
		<div class="query-list">
			<?php if (!empty($data->info->content)): ?>		
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
			<p class="query-total">				
				<?php if ($data->list->total > 0) :?>	
					Showing <?php echo count($data->list->data) ?> of <?php echo  $data->list->total ?> item<?php echo ( $data->list->total > 1 ? 's' : '' ) ?>:
				<?php else : ?>
					<?php echo  'No items found.'; ?>
				<?php endif ?>
			</p>
