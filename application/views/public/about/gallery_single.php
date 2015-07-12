<div class="main-content gallery gallery-albums">			

	<section class="section-wrapper">
		<div class="section-body">		
			<div class="section-content-header">
				<h1> <?php echo $data['album']->title ?>
				</h1>
			</div>
			<div class="section-content">
				<div class="album-description">
					<p> <?php echo $data['album']->description ?>
					</p>
				</div>
				<div class="photos-list">
					
					<?php foreach ($data['photos'] as $key => $photo): ?>
						<div class="photo-item">
							<a href="<?php echo $photo->img_url ?>" data-lightbox="gallery" class="thumbnail-container">									
								<div class="thumbnail-overlay thumbnail-overlay-lightbox"></div>
								<div class="thumbnail-image" data-thumbnail="<?php echo $photo->img_thumbnail ?>" style="background-image:url('<?php echo $photo->img_thumbnail ?>')"></div>
							</a>
						</div>
						<!-- end photo-item -->
					<?php endforeach ?>					

				</div>
			</div>							
		</div>				
	</section>
	<!-- end section -->
	
	
</div>
<!-- end main-content -->
