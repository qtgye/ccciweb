	<div class="panel">		
		<?php if ($data->page!='users'): ?>
			<a href="<?php echo URL.'admin/add_new/'.$data->page ?>" class="btn btn-small btn-center btn-default summary-btn-add">Add New Item</a>
		<?php endif ?>
		<div class="latest-items-list">			
			<?php foreach ($data->list->data as $key => $d): ?>					
				<?php if (preg_match('/(trash)/i', $d->title) && $data->page=='users'): ?>
					<!-- users page don't have trash items -->
					<?php continue; ?>								
				<?php endif ?>							
				<div class="latest-items-item">
					<div class="latest-item-header">									
						<h3><?php echo ucfirst($d->title)?></h3>						
					</div>
					<div class="latest-item-menu">						
						<ul>											
							<?php foreach ($d->data as $k => $item): ?>																				
								<?php if ( $k < 5 ): ?>
									<li>										
										<a href="#" data-modal="#default-modal" modal-type="preview" data-id="<?php echo $item->data->id ?>" data-source="<?php echo $data->page ?>" data-task="view" data-pane="summary" data-status="<?php echo $d->status ?>">
											<?php echo $item->title ?>											
										</a>
									</li>
								<?php endif ?>									
							<?php endforeach ?>
							<?php if (count($d->data) > 0): ?>
								<li class="view-button">						
									<a href="<?php echo URL.'admin/view/'.$data->page.'/'.$d->status ?>" class="latest-items-btn">View All <?php echo count($d->data) ?></a>								
								</li>								
							<?php else: ?>
								<li>
									No data available.
								</li>
							<?php endif ?>																				
						</ul>
					</div>
				</div>
			<?php endforeach ?>			
		</div> <!-- latest-items-list -->
	</div> <!-- panel -->
