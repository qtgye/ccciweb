<div class="<?php echo in_array($field_name, $data->error->fields)?'error':'' ?>">
	<textarea class="" name="<?php echo $field_name ?>" id="<?php echo $field_name ?>"><?php echo isset($data->values->$field_name)?$data->values->$field_name:'' ?></textarea>
</div>