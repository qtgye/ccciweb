<select name="<?php echo $field_name ?>" id="">
	<option value="" disabled <?php echo !isset($data->values->pastor_id)?'selected':'' ?>>Select One</option>	
	<?php foreach ($pastors as $key => $p): ?>
		<option value="<?php echo $p->id ?>" <?php echo isset($data->values->pastor_id) && $p->id==$data->values->pastor_id?'selected':'' ?>><?php echo $p->name_first.' '.$p->name_last ?></option>
	<?php endforeach ?>
	<!-- ADD THESE LINES IF ADD NEW PASTOR MODAL IS AVAILABLE -->
	<!-- <option value="">
		<span class="btn ">Add New</span>
	</option> -->
</select>