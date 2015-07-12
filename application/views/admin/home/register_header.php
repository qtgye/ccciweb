<div class="register-section">	

	<div class="register-section-header">
		<h2>Register</h2>
		<a class="btn btn-borderonly btn-right" href="<?php echo URL . 'admin' ?>">Back to Login</a>			
	</div>

	<?php if (!empty($data->errors->message)): ?>
		<div class="info info-error">	
			<div class="info-content">
				<p><?php echo $data->errors->message ?></p>
			</div>							
		</div>
	<?php endif ?>
	
	<form action="" method="post">
		<div class="inputs ">			
			<div class="table-fields">