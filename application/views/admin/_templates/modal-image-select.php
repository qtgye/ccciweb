<div class="modal" id="image_modal">
		<div class="modal-overlay">
			<div class="modal-container">
				<div class="modal-body">				
					<div class="modal-header">					
					</div>
					<div class="modal-content">
						<form enctype="multipart/form-data" action="<?php echo URL.'admin/upload_single' ?>" id="uploadForm" method="post" target="iframe">
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
													<select name="" id="select-album-list">
														<option value="">Album 1</option>
														<option value="">Album 2</option>
														<option value="">Album 3</option>
														<option value="">Album 4</option>
														<option value="">Album 5</option>
													</select>													
												</div>
												<div class="tab-row modal-thumbnails">
													<div class="thumbnails">
														<ul>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r1" value="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg">
																<label for="r1">
																	<img src="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r2" value="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg">
																<label for="r2">
																	<img src="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r3" value="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg">
																<label for="r3">
																	<img src="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r4" value="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg">
																<label for="r4">
																	<img src="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r5" value="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg">
																<label for="r5">
																	<img src="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r6" value="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg">
																<label for="r6">
																	<img src="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r7" value="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg">
																<label for="r7">
																	<img src="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r8" value="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg">
																<label for="r8">
																	<img src="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
															<li>
																<input type="radio" name="img_select" class="img-select-radio" id="r9" value="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg">
																<label for="r9">
																	<img src="http://cdn.cutestpaw.com/wp-content/uploads/2011/11/cute-cat-l.jpg" alt="">
																	<span class="checkmark"></span>
																</label>
															</li>
														</ul>
													</div>
												</div>
											</div>											
										</div>
										<div class="modal-buttons">					
											<span class="btn btn-default modal-btn modal-btn-ok" data-modal="#image_modal" id="btn-image-select">SELECT</span>
											<span class="btn btn-close modal-btn" data-modal="#image_modal">Cancel</span>											
										</div>
									</div>
									<div class="tab " id="tab-url">
										<div class="tab-content">
											<div class="file-upload-panel">
												<label for="url">Image URL:</label>
												<input class="input-long" type="text" id="url" placeholder="Paste url here....">
											</div>	
											<p class="bg-error" id="urlInfo" style="display:none"></p>																																
										</div>
										<div class="modal-buttons">					
											<span class="btn btn-default modal-btn modal-btn-ok" data-modal="#image_modal" id="btn-image-url">SELECT</span>
											<span class="btn btn-close modal-btn" data-modal="#image_modal">Cancel</span>
										</div>
									</div>
									<div class="tab " id="tab-upload">
										<div class="tab-content">
											<div class="file-upload-panel">
												<p id="filePreview" class="bg-info" display="none"></p>
												<input type="file" name="file" id="file">
												<label class="btn btn-borderonly" for="file">Browse File</label>
											</div>																																	
										</div>
										<div class="modal-buttons">					
											<span class="btn btn-default modal-btn modal-btn-ok" data-modal="#image_modal" id="btn-image-upload">UPLOAD</span>
											<span class="btn btn-close modal-btn" data-modal="#image_modal">Cancel</span>
										</div>
									</div>
								</div>
							</div> <!-- close modal-tabs -->							
						</form>
						<iframe name="iframe" id="iframe" style="display:none" frameborder="0"></iframe>
					</div>					
				</div>
			</div>			
		</div>
	</div> <!-- end image_modal -->