<div class="login-section">			
	<h2>Login</h2>	
	<form action="" method="post" name="form">		
		<?php if (!empty($data->info->content)): ?>
			<div class="info info-<?php echo $data->info->type ?>">	
				<div class="info-content">					
					<p><?php echo $data->info->content ?></p>			
				</div>							
			</div>
		<?php endif ?>
		<div class="inputs">
			<div class="table-fields">
				<div class="row">
					<div class="row-cell">
						<label for="#username">Username/Email</label>
					</div>
					<div class="row-cell">
						<input name="username" id="username" type="text" placeholder="" class="input-long" value="<?php echo isset($data->values->username) ? $data->values->username : '' ?>" >
					</div>
				</div>
				<div class="row">
					<div class="row-cell">
						<label for="#password">Password</label>
					</div>
					<div class="row-cell">
						<input name="password" id="password" type="password" placeholder="" class="input-long" >
						<div class="forgot_password_btn" style="text-align:right; margin-right: 5px;">
							<a href="javascript:void(null)" data-modal="#modal-forgot-password" style="color:#66ff00 !important"><em><small>Forgot Password</small></em></a>							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="row-cell"></div>
					<div class="row-cell">
						<input name="login" class="btn btn-default" type="submit" value="LOGIN">
						<a class="btn btn-default" href="<?php echo URL . 'admin/register'?>">REGISTER</a>	
					</div>
				</div>			
			</div>
		</div>
		<!-- $data->social is just for test -->
		<?php if (isset($data->social)): ?>
			<div class="social">
				<p>OR</p>
				<div class="btn btn-social fb">Login using Facebook</div>
				<div class="btn btn-social g">Login using Google</div>
			</div>
		<?php endif ?>		
		<div class="cf"></div>		
	</form>
</div>
