<div class="modal" id="modal-publish">
	<div class="modal-overlay">
		<div class="modal-container">
			
			<div class="modal-body">


				<span class="btn btn-round btn-top-right" data-modal="#default-modal">&times;</span>				
				

				<div class="modal-content ">		

					<!-- loader content while processing the request -->
					<div class="request-sending">
						<div class="loading"></div>
						<p>Publishing your entry...</p>
					</div>	
					<!-- error message if request is not successful -->
					<div class="request-error info-content info-error hide">												
					</div>

					<!-- <div class="modal-buttons">
						<div class="btn modal-btn-ok" data-modal="#modal-publish">OK</div>
						<div class="btn modal-btn-cancel" data-modal="#modal-publish">sfsdfsd</div>
						<div class="btn modal-btn-close" data-modal="#modal-publish">dfssdfsdfOK</div>
					</div> -->

				</div>		


				<!--
					this form is for sending info contents to the page after handling the result of hidden submit
				-->
				<form id="modal-form-info" class="modal-buttons hide" action="" method="post">
					<div class="modal-form-fields">
						<!-- 
							This is input will hold the json value for the info parameters.
							Json value should be the result of the publish ajax request.
							json format:
							{
								type : 'success|error|warning',
								content : 'any string',
								button : {
									title : 'Go to some Page',
									link  : 'http://somelink'
								}
							}
						-->
						<input type="text" id="info-parameters" name="info_parameters">																	
					</div>
					<input type="submit" id="modal-publish-submit" name="modal_info_submit" value="i">
				</form>

			</div>
		</div>
	</div>
</div>