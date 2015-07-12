<div class="modal" id="modal-service">
	<div class="modal-overlay">
		<div class="modal-container">
			<div class="modal-background-toggle" data-modal="#modal-service"></div>
			
			<div class="modal-close-bg" data-modal="#modal-service"></div>
			<div class="modal-body">	
				<span class="btn btn-round btn-top-right" data-modal="#modal-service">&times;</span>							
				<div class="modal-header">
					<h3>Add Service</h3>					
				</div>
				<div class="modal-content">
					<table class="data-preview">
						<tr>
							<td>
								<span class="required">*</span>
								<label for="#service_title"></label>Service Title :</td>
							<td>
								<input id="service_title" class="service_title" type="text">
							</td>
						</tr>
						<tr>
							<td><label >Day(s) :</label></td>
							<td>
								<div class="service_days">
									<select name="" class="service_days">
										<option value="" disabled selected>Select One</option>
										<option value="Everyday">Everyday</option>
										<option value="" disabled>-----------</option>
										<option value="Sunday">Sunday</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
										<option value="Saturday">Saturday</option>
									</select>
									<div class="btn btn-del-input">x</div>
								</div>								
								<span class="btn btn-small" id="add_day">Add Day</span>
							</td>
						</tr>
						<tr>
							<td><label for="#service_time">Time :</label></td>
							<td>
								<input id="service_time" class="service_time time-picker" type="text">								
							</td>
						</tr>
					</table>
				</div>				
				<div class="modal-buttons">					
					<span class="btn btn-default modal-btn modal-btn-ok btn-add" data-modal="#modal-service">ADD</span>
					<span class="btn btn-default modal-btn modal-btn-ok btn-update" data-modal="#modal-service">UPDATE</span>
					<span class="btn btn-close modal-btn-close" data-modal="#modal-service">Close</span>
				</div>
			</div>
		</div>			
	</div>
</div> <!-- end modal -->