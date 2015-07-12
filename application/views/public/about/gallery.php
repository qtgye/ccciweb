<div class="main-content gallery gallery-albums">	

			<section class="section-wrapper">
				<div class="section-body">									
					<div class="section-content">
						<div class="page-title-block">
							<h1 class="page-title">
								ALBUMS
							</h1>
						</div>
					</div>					
				</div>				
			</section>			

			<section class="section-wrapper">
				<div class="section-body">										
					<div class="section-content">
						<div class="albums-list">

							<?php foreach ($data['albums'] as $album): ?>
								<div class="album-item">							
									<a href="/about/gallery/<?php echo $album->id ?>" class="thumbnail-container">
										<div class="thumbnail-title">
											<h4> <?php echo $album->title ?>
											</h4>
										</div>
										<div href="#" class="thumbnail-overlay thumbnail-overlay-link"></div>
										
										<?php if (isset($album->cover_img_thumbnail)): ?>
											<div class="thumbnail-image" style="background-image:url('<?php echo $album->cover_img_thumbnail ?>')"></div>
										<?php endif ?>
										
									</a>
								</div>
								<!-- end album item -->
							<?php endforeach ?>																	

						</div>
					</div>							
				</div>				
			</section>
			<!-- end section -->
			
			
		</div>
		<!-- end main-content -->