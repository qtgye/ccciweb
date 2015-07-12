<div class="panel">
	<div class="profile-container">
		<div class="profile-header">			
			<div class="profile-title">
				<h2>
					Your Profile
				</h2>
			</div>	
			<div class="profile-options">
				<a href="<?php echo URL.'admin/profile/edit_profile' ?>" class="btn btn-default">
					Edit
				</a>
			</div>		
			<div class="cf"></div>
		</div> <!-- profile-header -->
		<div class="profile-info">
			<div class="profile-col profile-col-left">
				<div class="profile-image-block">
					<div class="profile-image">
						<img src="<?php echo $data->user->raw->img_url?$data->user->raw->img_url:IMAGES_URL.'assets/bg/no_image.jpg' ?>" alt="">
					</div>
					<div class="profile-image-caption">
						<p>
							<?php echo $data->user->raw->img_caption ?>
						</p>
					</div>
				</div>
			</div>
			<div class="profile-col profile-col-right">
				<div class="profile-info-list">
					<?php foreach ($data->user->processed as $key => $value): ?>						
						<?php if (!preg_match('/(img|id|perm)/i', $key)): ?>
							<div class="profile-info-row row">
								<div class="profile-info-title row-cell">
									<?php echo $key ?> :
								</div>
								<div class="profile-info-content row-cell">
									<?php if (!empty($value)): ?>
										<?php if ($key=='username'): ?>
											<h3><?php echo $value ?></h3>
										<?php elseif (preg_match('/contact/i', $key)): ?>
											<?php echo str_replace(',', '<br>', $value) ?>
										<?php else: ?>
											<?php echo $value ?>
										<?php endif ?>		
									<?php else: ?>
										<em class="no_data">No Data.</em>
									<?php endif ?>									
								</div>	
							</div>
						<?php endif ?>						
					<?php endforeach ?>					
				</div>
			</div>
			<div class="cf"></div>
		</div>
	</div>
</div>
