			<input type="text" name="status" value="<?php echo !empty($data->values->status)?$data->values->status:'' ?>" class="hide">
		</div>
		<div class="edit-options">			
			<?php if ($data->method=='new'): ?>				
				<?php if (preg_match('/(albums|users)/', $data->page)): ?>					
					<input type="submit" name="<?php echo $data->page=='albums'?'publish':'activate' ?>" class="btn btn-default edit-btn-publish" value="<?php echo $data->page=='albums'?'CREATE ALBUM':'ACTIVATE' ?>">									
				<?php else: ?>					
					<?php if (preg_match('/(news|articles|stories)/', $data->page)): ?>
						<input type="submit" name="publish" data-publish="" data-page="<?php echo $data->page ?>" data-method="new" class="btn btn-default edit-btn-publish" value="SAVE AND PUBLISH">
					<?php else: ?>
						<input type="submit" name="publish" class="btn btn-default edit-btn-publish" value="SAVE AND PUBLISH">
					<?php endif ?>					
					<input type="submit" name="save_draft" class="btn btn-borderonly edit-btn-draft" value="Save As Draft">					
				<?php endif ?>				
			<?php elseif ($data->method=='edit'): ?>				
				<?php if (preg_match('/(albums|users)/', $data->page)): ?>	
					<input type="submit" name="save" class="btn btn-borderonly edit-btn-draft" value="Save Changes">								
					<?php if ($data->status=='waiting'): ?>
						<input type="submit" name="activate" class="btn btn-default edit-btn-publish" value="ACTIVATE">						
					<?php elseif ($data->status=='active'): ?>
						<input type="submit" name="deactivate" class="btn btn-borderonly edit-btn-publish" value="Deactivate">						
					<?php endif ?>										
				<?php else: ?>
					<?php if ($data->status == 'draft'): ?>				
						<input type="submit" name="publish" class="btn btn-default edit-btn-publish" data-publish="<?php echo $data->id ?>" data-page="<?php echo $data->page ?>" data-method="edit" value="SAVE AND PUBLISH">
						<input type="submit" name="save" class="btn btn-borderonly edit-btn-draft" value="Save Changes">
					<?php elseif ($data->status == 'published') :?>
						<input type="submit" name="save" class="btn btn-borderonly edit-btn-draft" value="Save Changes">
					<?php else: ?>
						<input type="submit" name="save_draft" class="btn btn-borderonly edit-btn-draft" value="Restore to Draft">
					<?php endif ?>					
				<?php endif ?>				
			<?php elseif ($data->method=='profile'): ?>
					<input type="submit" name="save" class="btn btn-borderonly edit-btn-draft" value="Save Changes">
			<?php endif ?>

			<!-- back buttons -->
			<?php if ($data->page=='profile'): ?>
				<a href="<?php echo URL.'admin/profile' ?>" class="btn btn-borderonly edit-btn-cancel">Back to Profile</a>
			<?php endif ?>


			<div class="cf"></div>
		</div>
	</div>
</form>
