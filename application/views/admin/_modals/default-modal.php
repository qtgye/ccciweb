<div class="modal" id="default-modal">	
	<div class="modal-overlay">
		<div class="modal-container">
			<div class="modal-background-toggle" data-modal="#default-modal"></div>
			<div class="modal-close-bg" data-modal="#default-modal"></div>
			<div class="modal-body">
				<span class="btn btn-round btn-top-right" data-modal="#default-modal">&times;</span>				
				<div class="modal-header">
					<h3 class="modal-title"></h3>					
				</div>
				<div class="modal-content ">						
				</div>				
				<form id="modal-default-form" class="modal-buttons" action="" method="post">
					<div class="modal-form-fields hide">
						<input type="text" id="modal-field-id" name="modal_field_id">
						<input type="text" id="modal-field-page" name="modal_field_page">						
					</div>
					<span class="btn btn-default modal-btn modal-btn-ok" data-modal="#default-modal">OK</span>
					<input type="submit" class="btn btn-light modal-btn modal-btn-yes" value="YES">
					<a href="" class="btn btn-default modal-btn modal-btn-no" data-modal="#default-modal">NO</a>
					<input type="submit" name="modal_publish" data-publish="" data-page="" class="btn btn-default modal-btn-publish" value="PUBLISH">						
					<input type="submit" name="modal_activate" class="btn btn-default modal-btn modal-btn-activate" value="ACTIVATE">
					<input type="submit" name="modal_restore" class="btn btn-borderonly modal-btn modal-btn-restore" value="RESTORE TO DRAFT">						
					<a href="" class="btn btn-borderonly modal-btn modal-btn-edit">EDIT</a>					
					<input type="submit" name="modal_deactivate"class="btn btn-borderonly modal-btn modal-btn-deactivate" value="Deactivate" >
					<span class="btn btn-borderonly modal-btn-delete" data-modal="#confirm-delete">DELETE</span>				
						<div id="confirm-delete" class="hide modal-confirm-delete">
							Are you sure you want to delete this item?							
							<input type="submit" name="modal_delete" class="btn btn-small inline-block" value="Yes">
							<span class="btn btn-small inline-block" data-modal="#confirm-delete">No</span>
						</div>
					<input type="submit" name="modal_trash"class="btn btn-textonly modal-btn modal-btn-trash" value="Trash" >
					<div class="btn btn-borderonly btn-cancel modal-btn" data-modal="#default-modal">Cancel</div>
				</form>
			</div>
		</div>			
	</div>
</div> <!-- end modal -->