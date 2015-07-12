<?php if (isset($data->values->$field_name) && count($data->values->$field_name)> 0) : ?>		
	<?php foreach ($data->values->$field_name as $key => $contact): ?>
		<div id="<?php echo 'contact_'.$key ?>" class="contact_field input_group <?php echo in_array($field_name.'['.$key.']',$data->errors->fields) ?  'error' : '' ?>" >
			<input value="<?php echo $contact ?>" name="<?php echo $field_name ?>[]" id="<?php echo $field_name.'['.$key.']' ?>" type="text" placeholder=""><span class="btn btn-del-input" data-remove="#<?php echo 'contact_'.$key ?>">Remove</span>
		</div>
	<?php endforeach ?>	
<?php else: ?>
	<div class="input_group <?php echo in_array($field_name,$data->errors->fields) ?  'error' : '' ?>">
		<input name="<?php echo $field_name ?>[]" type="text" ><span class="btn btn-del-input">Remove</span>		
	</div>	
<?php endif ?>
<span class="btn btn-small" id="add_contact">Add Contact No.</span>