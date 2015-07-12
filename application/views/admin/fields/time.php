<select name="<?php echo $field_name ?>" id="<?php echo $field_name ?>" class="<?php echo in_array($field_name, $data->error->fields)?'error':'' ?>">	
	<option value="" <?php echo empty($data->values->$field_name)?'selected':'' ?> ></option>
	<?php date_default_timezone_set("UTC"); ?>
	<?php for ( $i = 0 ; $i < 86400;  $i+=1800) :?>
		<?php $time = date('g:i a',$i) ?>	
		<option value="<?php echo date('g:i a',$i) ?>" <?php echo !empty($data->values->$field_name)&&$data->values->$field_name==$time?'selected':'' ?> >
			<?php echo $time ?>
		</option>		
	<?php endfor; ?>
</select>
<?php date_default_timezone_set("Asia/Manila"); ?>