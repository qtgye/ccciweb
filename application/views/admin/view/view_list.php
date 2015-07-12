<?php foreach ($data->list->data as $key => $item): ?>	
	<div class="query-item">
		<div class="item-summary">

			<!-- show check box if not user album -->
			<!-- user album is not allowed to be deleted or edited -->
			<?php if ( @$item->data->title != 'User Album' ): ?>
				<span class="item-checkbox">
					<input type="checkbox" name="items_checked[]" value="<?php echo $item->data->id ?>">
				</span>
			<?php endif ?>

			<span class="item-title">
				<?php if ($data->page!='albums'): ?>
					<a href="#" data-modal="#default-modal" modal-type="preview" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>" data-task="view" data-status="<?php echo $data->status ?>" data-pane="<?php echo $data->status ?>">														
						<?php echo $item->title ?>
					</a>
				<?php else: ?>				
					<a href="<?php echo URL.'admin/gallery/'.$item->data->id ?>">														
						<?php echo $item->title ?>
					</a>
					<span class="item_count"> (<?php echo $item->data->photos_count ?> Photo<?php echo $item->data->photos_count>1?'s':'' ?>) </span>
				<?php endif ?>
			</span>

			<!-- show check box if not user album -->
			<!-- user album is not allowed to be deleted or edited -->
			<?php if ( @$item->data->title != 'User Album' ): ?>
				<!-- hide options if item is not the current user -->
				<?php if ( $this->session->user->id == $item->data->id ): ?>
					<span class="item-options-toggle btn btn-small btn-right btn-textonly" data-collapse="<?php echo '#item-options-'.$key ?>" collapse-group="item-options">
						▼
					</span>
				<?php endif ?>				
			<?php endif ?>


			<div class="cf"></div>
		</div>

		<!-- show item options if user_id is the current user -->
		<!-- show check box if not user album -->
		<!-- user album is not allowed to be deleted or edited -->		
		<?php if ( @$item->data->title != 'User Album' ): ?>
			<div class="item-options" id="<?php echo 'item-options-'.$key ?>">
				<?php if ($data->page=='albums'): ?>
					<a href="<?php echo URL.'admin/upload/'.$item->data->id ?>" title="Add Photos" class="item-option-btn item-add">Add Photos</a>					
				<?php endif ?>							
				<a href="<?php echo URL.'admin/edit/'.$data->page.'/'.$item->data->id ?>" title="edit" class="item-option-btn item-edit">Edit</a>				
				<?php if ( $data->status == 'trash' ): ?>					
					<span class="item-option-btn item-delete"  data-modal="#default-modal" modal-type="delete" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>">Delete</span>
				<?php elseif( $data->status != 'trash' ): ?>
					<?php if (preg_match('/(albums|users)/', $data->page)): ?>
						<span class="item-option-btn item-delete"  data-modal="#default-modal" modal-type="delete" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>">Delete</span>
					<?php else: ?>
						<a href="<?php echo URL.'admin/view/'.$data->page.'/'.$item->data->status.'/'.$item->data->id.'/trash' ?>" title="trash" class="item-option-btn item-trash"  data-modal="#default-modal" modal-type="trash" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>">Trash</a>
					<?php endif ?>					
				<?php endif; ?>
			</div>
		<?php endif ?>	

		<div class="cf"></div>
	</div>

<?php endforeach ?>			
			<?php if ( $data->list->pager->total_pages > 1) :?>
				<div class="pagination">
					<div class="pagination-block">
						<?php for ($i=0; $i < ceil($data->list->total/10); $i++): ?>
							<a class="btn btn-small <?php echo $data->list->pager->current_page == $i+1 ? 'btn-default' : '' ?>" href="<?php echo URL.'admin/view/'.$data->page.'/'.$item->data->status.'/'.($i+1) ?>"><?php echo $i+1 ?></a>
						<?php endfor ?>
					</div>
				</div> <!-- end pagination -->
			<?php endif; ?>
		</div> <!-- end query-list -->
	</div> <!-- end panel -->
</form> <!-- end form -->