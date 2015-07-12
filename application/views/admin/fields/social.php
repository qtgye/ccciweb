<?php if (isset($data->values->$field_name) && count($data->values->$field_name)> 0) : ?>
	<?php foreach ($data->values->$field_name as $key => $social): ?>
		<div class="input_group">
			<input value="<?php echo $social ?>" name="<?php echo $field_name ?>[]" id="<?php echo $field_name.'['.$key.']' ?>" type="text" placeholder="e.g.: www.facebook.com/user/me" class="<?php echo in_array($field_name.'['.$key.']',$data->error->fields) ?  'error' : '' ?>"><a class="btn btn-textonly test-link" target="_blank" href="">Test Link</a><span class="btn btn-del-input">x</span>
		</div>
	<?php endforeach ?>	
<?php else: ?>
	<div class="input_group">
		<input name="<?php echo $field_name ?>[]" type="text" placeholder="e.g.: www.facebook.com/user/me"><a class="test-link btn btn-textonly" target="_blank" href="">Test Link</a><span class="btn btn-del-input">x</span>		
	</div>	
<?php endif ?>
<span class="btn btn-small" id="add_social">Add Link</span>