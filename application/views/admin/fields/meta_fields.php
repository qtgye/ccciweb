<div class="row fields-meta">
	<div class="row-cell">		
	</div>	
	<div class="row-cell">		
		<?php foreach ($data->meta as $key => $value): ?>
			<p>
				<?php echo $key ?> : <?php echo $value ?>
			</p>
		<?php endforeach ?>
	</div> <!-- closes the cell -->
</div> <!-- closes the row -->