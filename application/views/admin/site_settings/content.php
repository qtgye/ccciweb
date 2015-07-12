<form action="" method="post">
	<div class="table-fields site-settings">		
		<?php foreach ($data->settings_list as $key => $item): ?>
			<div class="row">
				<div class="row-cell settings-title">
					<label for="#<?php echo $item->title ?>">
						<?php echo $item->title ?>
					</label>
				</div>			
				<div class="row-cell settings-content">
					
					<!-- conditional input fields according to settings item name -->
					<?php switch ($item->name) :
						case 'site_status' : ?>
							<div class="site-status-radio">
								<label for="<?php echo $item->name ?>_0">
									<input class="site-settings-radio" type="radio" id="<?php echo $item->name ?>_0" name="<?php echo $item->name ?>" value="1" <?php echo $item->content == 1 ? 'checked' : '' ?>>
									<span class="btn">Active</span>								
								</label>
								<label for="<?php echo $item->name ?>_1">
									<input class="site-settings-radio" type="radio" id="<?php echo $item->name ?>_1" name="<?php echo $item->name ?>" value="0" <?php echo $item->content == 0 ? 'checked' : '' ?>>
									<span class="btn">Inactive/Maintenance</span>								
								</label>
							</div>
						<?php break; ?>
						<?php default: ?>
							<input type="text" id="<?php echo $item->name ?>" name="<?php echo $item->name ?>" value="<?php echo $item->content ?>">
						<?php break; ?>
					<?php endswitch ?>
				
				</div>
				<div class="row-cell settings-description">
					<div class="settings-description-container">
						- <?php echo !empty($item->description)?$item->description:'No description available.' ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
