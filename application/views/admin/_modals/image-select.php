<div class="modal" id="image_modal">
		<div class="modal-overlay">
			<div class="modal-container">
				<div class="modal-background-toggle" data-modal="#image_modal"></div>
				
				<div class="modal-close-bg" data-modal="#image_modal"></div>
				<div class="modal-body">
					<span class="btn btn-round btn-top-right" data-modal="#image_modal">&times;</span>				
					<div class="modal-header">	
						<h3>
							Select Image
						</h3>				
					</div>
					<div class="modal-content">
						<form enctype="multipart/form-data" action="<?php echo URL.'admin/upload_single/1' ?>" id="uploadForm" method="post" >
							<div class="modal-tabs">
								<div class="tab-header">
									<span class="btn btn-tab btn-tab-selected" id="label-select" for="img-select">Select from Photos</span>
									<span class="btn btn-tab" id="label-url" for="img-url">From Web</span>
									<span class="btn btn-tab" id="label-upload" for="img-upload">Upload New Image</span>									
								</div>
								<div class="tab-panels">
									<div class="tab  tab-panel-selected" id="tab-select">
										<div class="tab-content">											
											<div class="tab-cols">
												<div class="tab-row modal-albums-list">
													Select Album : 
													<select name="" id="select-album-list"></select>													
												</div>
												<div class="tab-row modal-thumbnails">
													<div class="thumbnails">
														<ul></ul>
													</div>
												</div>
											</div>											
										</div>										
									</div>
									<div class="tab " id="tab-url">
										<div class="tab-content">
											<div class="file-upload-panel">
												<label for="url">Image URL:</label>
												<input class="input-long center" type="text" id="url" placeholder="Paste url here....">
											</div>	
											<p class="bg-error" id="urlInfo" style="display:none"></p>																																
										</div>
										<div class="modal-buttons">					
											<span class="btn btn-default modal-btn modal-btn-ok" data-modal="#image_modal" id="btn-image-url">SELECT</span>											
										</div>
									</div>
									<div class="tab " id="tab-upload">
										<div class="tab-content">
											<div class="file-upload-panel">
												<p id="filePreview" class="bg-info" display="none"></p>												
												<label for="file" onclick="">													
													<input type="file" name="file" id="file">													
												</label>
											</div>																																	
										</div>
										<div class="modal-buttons">					
											<span class="btn btn-default modal-btn modal-btn-ok" data-modal="#image_modal" id="btn-image-upload">UPLOAD</span>											
										</div>
									</div>
								</div>
							</div> <!-- close modal-tabs -->
							<span class="btn btn-borderonly modal-btn modal-btn-close" data-modal="#image_modal">Cancel</span>							
						</form>
						<!-- <iframe name="iframe" id="iframe" style="display:none" frameborder="0"></iframe> -->
					</div>					
				</div>
			</div>			
		</div>
	</div> <!-- end image_modal -->