<input type="text" name="<?php echo $field_name ?>" data-year="<?php echo ((integer)date('Y',time())+1) ?>" class="date-picker <?php echo in_array($field_name, $data->errors->fields)?'error':'' ?>" value="<?php echo !empty($data->values->$field_name)?$data->values->$field_name:'' ?>">