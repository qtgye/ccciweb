	<div class="panel">
		<h1 class="panel-title">Welcome to the Admin Panel.</h1>
		<div class="mid-notification">	
			<div class="mid-notification-count">
				<p>You have <?php echo count($data->notification) ?> notification<?php echo count($data->notification)>1?'s':'' ?>:</p>
			</div>			
			<?php if (count($data->notification) > 0): ?>				
				<div class="mid-notification-list">
					<ul>
						<?php foreach ($data->notification as $key => $value) :?>
							<li><a href="<?php echo $value->link ?>"><?php echo $value->message ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>				
			<?php endif ?>	
		</div> <!-- mid-notification -->
	</div>