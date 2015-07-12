<select name="<?php echo $field_name ?>" id="" class="<?php echo in_array($field_name, $data->errors->fields)?'error':'' ?>">
	<option value="" disabled <?php echo empty($data->values->$field_name)?'selected':'' ?>>Select One</option>	
	<option value="3" <?php echo isset($data->values->permission) && $data->values->permission==3?'selected':''?>>3</option>
	<option value="2" <?php echo isset($data->values->permission) && $data->values->permission==2?'selected':''?>>2</option>
	<option value="1" <?php echo isset($data->values->permission) && $data->values->permission==1?'selected':''?>>1</option>	
</select>