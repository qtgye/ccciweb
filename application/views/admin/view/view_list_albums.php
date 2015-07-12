<?php foreach ($data->list as $key => $item): ?>
	<pre>
		<?php //print_r($item) ?>
	</pre>
	<div class="query-item">
		<span class="item-checkbox">
			<input type="checkbox" name="items_checked[]" value="<?php echo $item->data->id ?>">
		</span>
		<span class="item-title">
			<?php if ($data->page!='albums'): ?>
				<a href="#" data-modal="#default-modal" modal-type="preview" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>" data-task="view" data-status="<?php echo $data->status ?>" data-pane="<?php echo $data->status ?>">														
					<?php echo $item->title ?>
				</a>
			<?php else: ?>
				<a href="<?php echo URL.'admin/gallery/'.$item->data->id ?>">														
					<?php echo $item->title ?>
				</a>
			<?php endif ?>
				
		</span>


		<span class="item-options">
			<?php if ($data->page=='albums'): ?>
				<a href="<?php echo URL.'admin/upload/'.$item->data->id ?>" title="Add Photos" class="item-option-btn item-add">Add Photos</a>					
			<?php endif ?>

			<a href="<?php echo URL.'admin/edit/'.$data->page.'/'.$item->data->id ?>" title="edit" class="item-option-btn item-edit">Edit</a>
			<?php if ( preg_match('/(albums|users)/', $data->page) ) :?>				
				<a href="<?php echo URL.'admin/view/'.$data->page.'/'.$item->data->status.'/'.$item->data->id.'/delete' ?>" title="delete" class="item-option-btn item-delete"  data-modal="#default-modal" modal-type="delete" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>">Delete</a>
			<?php elseif( $data->status != 'trash' ): ?>
				<a href="<?php echo URL.'admin/view/'.$data->page.'/'.$item->data->status.'/'.$item->data->id.'/trash' ?>" title="trash" class="item-option-btn item-trash"  data-modal="#default-modal" modal-type="trash" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>">Trash</a>
			<?php endif; ?>
		</span>
		<div class="cf"></div>
	</div>
	
<?php endforeach ?>			
			<?php if ( count($data->list) > 1) :?>
				<div class="pagination">
					<div class="pagination-block">
						<span class="pager pager-first"><a href="">First</a></span>
						<span class="pager pager-prev"><a href="">Previous</a></span>
						<span class="pager pager-pages">
							<span class="pager pages-single"><a href="">1</a></span>
							<span class="pager pages-single"><a href="">2</a></span>
							<span class="pager pages-single"><a href="">3</a></span>
							<span class="pager pages-single"><a href="">4</a></span>
							...
							<span class="pager pages-single"><a href="">10</a></span>
						</span>
						<span class="pager pager-next"><a href="">Next</a></span>
						<span class="pager pager-last"><a href="">Last</a></span>
					</div>
				</div> <!-- end pagination -->
			<?php endif; ?>
		</div> <!-- end query-list -->
	</div> <!-- end panel -->
</form> <!-- end form -->