<div data-source="#image_modal">	
	<input type="text" class="hide" name="<?php echo $field_name ?>" value="<?php echo isset($data->values->$field_name)?$data->values->$field_name:'' ?>">
	<p class="bg-error" id="selectError" style="display:none"></p>
	<br>
	<div id="<?php echo $field_name ?>" class="image-block <?php echo in_array($field_name, $data->errors->fields) ? 'error' : '' ?>">
		<img src="<?php echo !empty($data->values->$field_name)?$data->values->$field_name:URL.'public/img/assets/bg/no_image.jpg' ?>" alt="">
		<div class="image-block-buttons">
			<span data-modal="#image_modal" modal-type="image-select" class="btn btn-default btn-long add_edit_btn" id="add_edit_img">
				<?php echo !empty($data->values->$field_name)?'Change Image':'Add Image' ?>					
			</span>
		</div>			
	</div>
</div>