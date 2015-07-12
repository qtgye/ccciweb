<div class="modal" id="modal-forgot-password">
	<div class="modal-overlay">
		<div class="modal-container">
			<div class="modal-background-toggle" data-modal="#modal-forgot-password"></div>

			<div class="modal-close-bg" data-modal="#modal-forgot-password"></div>
			<div class="modal-body">


				<span class="btn btn-round btn-top-right" data-modal="#modal-forgot-passwordl">&times;</span>				
				

				<form action="" method="post">

					<div class="modal-content ">
						<div class="forgot-password-notice">
							<small>
								<p>Due to security reasons, forgotten passwords cannot be retreived because of encryption.</p>
								<p>However, we can give you a temporary password to retrieve your account.</p>
								<p>You will have to change it immediately once you logged in.</p>
							</small>														
						</div>
						<div class="table-fields">
							<div class="row">
								<label for="email_address">
									Temporary password will be sent to your e-mail:
								</label>
							</div>
							<div class="row">
								<input type="text" id="email_address" name="email_address" placeholder="Your email here">
							</div>
						</div>
					</div>		


					<div class="modal-buttons">
						<input type="submit" name="reset_password" class="btn btn-default" value="SUBMIT">
						<span class="btn btn-borderonly" data-modal="#modal-forgot-password">Cancel</span>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>