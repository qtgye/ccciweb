<div class="service-container service-hide-options">	
	<div class="service-item-list">
		<?php if (!empty($data->values->$field_name) && count($data->values->$field_name)>0) : ?>
			<?php foreach ($data->values->$field_name as $key => $service): ?>			
				<?php
					$item = json_decode($service);
					$randId = 'service_item_'.rand(1111,9999).'_'.time();
					$optsId =	'service_item_opt_'.rand(1111,9999).'_'.time() ;
				?>					
				<?php if (isset($item->title)): ?>
					<div id="<?php echo $randId ?>" class="service_item <?php echo in_array($field_name.'['.$key.']',$data->error->fields) ?  'error' : '' ?>" >				
						<input value="<?php echo htmlentities($service) ?>" name="<?php echo $field_name ?>[]" id="<?php echo $field_name.'['.$key.']' ?>" type="text">
						<div class="service_item_options">
							<span class="btn btn-textonly" data-collapse="#<?php echo $optsId ?>" collapse-group="service_item_buttons">▼</span>
							<div class="service_item_buttons" id="<?php echo $optsId ?>">
								<span class="btn btn-edit btn-edit-service" data-method="edit" data-collapse="#<?php echo $optsId ?>" collapse-group="service_item_buttons">Edit</span>
								<span class="btn btn-del-input" data-remove="#<?php echo $randId ?>">Remove</span>									
							</div>
						</div>
						<div class="service_item_info">
							<h4 class="service_item_title"><?php echo $item->title ? $item->title : '' ?></h4>
							<p class="service_item_days"><?php echo  $item->days ? implode(', ', $item->days) : '' ?></p>
							<p class="service_item_time"><?php echo  $item->time ? $item->time : '' ?></p>
						</div>					
					</div>		
				<?php endif ?>	
			<?php endforeach ?>		
		<?php endif ?>
	</div>
	<span class="btn btn-small" id="service_modal">Add Service</span>
</div>
