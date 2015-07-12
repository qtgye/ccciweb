<select name="<?php echo $field_name ?>" id="<?php echo $field_name ?>" class="<?php echo in_array($field_name, $data->errors->fields)?'error':'' ?>">
	<option value="" <?php echo !isset($data->values->$field_name)?'selected':''?> disabled>Select One</option>
	<option value="m" <?php echo isset($data->values->$field_name) && $data->values->$field_name == 'm'?'selected':'' ?>>Male</option>
	<option value="f" <?php echo isset($data->values->$field_name) && $data->values->$field_name == 'f'?'selected':'' ?>>Female</option>
</select>