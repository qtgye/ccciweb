<input type="text" name="<?php echo $field_name ?>" id="<?php echo $field_name ?>" class="input-long <?php echo in_array($field_name, $data->error->fields)?'error':'' ?>" value="<?php echo isset($data->values->$field_name)?$data->values->$field_name:'' ?>" placeholder="example: http://maps.google.com/12345">