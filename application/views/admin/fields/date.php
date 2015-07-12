<tr>
	<td>
		<label for="#date">Event Date:</label>
	</td>
	<td>
		<input type="text" name="date" id="date" data-year="<?php echo ((integer)date('Y',time())+1) ?>" class="date-picker <?php echo in_array('date', $data->error->fields)?'error':'' ?>" value="<?php echo isset($data->values->date)?date('d F Y',$data->values->date):'' ?>">
	</td>
</tr>