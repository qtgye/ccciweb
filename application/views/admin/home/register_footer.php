						<div class="row">
							<!-- added just for additional space -->
						</div>
						<div class="row">
							<div class="row-cell">
								<input class="btn btn-default" type="submit" name="register" value="Register">
							</div>
						</div>
					</div> <!-- table-fields -->				
			</div> <!-- inputs -->
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