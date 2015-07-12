<div class="<?php echo in_array($field_name, $data->errors->fields)?'error':'' ?>" id="<?php echo $field_name ?>">
	<textarea class="tinymce" name="<?php echo $field_name ?>" id="<?php echo $field_name ?>"><?php echo isset($data->values->$field_name)?$data->values->$field_name:'' ?></textarea>
</div>