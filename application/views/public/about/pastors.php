<div class="main-content people">	

			<section class="section-wrapper">
				<div class="section-body">									
					<div class="section-content">
						<div class="page-title-block">
							<h1 class="page-title">
								OUR PASTORS
							</h1>
						</div>
					</div>					
				</div>				
			</section>
			

			<section class="section-wrapper">
				<div class="section-body">										
					<div class="section-content">
						<div class="people-list">

							<?php foreach ($data['pastors'] as $pastor): ?>
								<div class="people-item">

									<a href="/about/pastors/<?php echo $pastor->id ?>" class="thumbnail-container">									
										<div class="thumbnail-overlay thumbnail-overlay-link"></div>
										<div class="thumbnail-image" style="background-image:url('<?php echo $pastor->img_url ?>')"></div>
									</a>
									
									<div class="people-info">
										<h3 class="people-name">
											<?php echo $pastor->name_first ?>
											<?php echo substr($pastor->name_middle, 0,1) ?>
											<?php echo $pastor->name_last ?>
										</h3>																	
									</div>
									<div class="people-social-list">
										<a href="#" class="social-logo social-logo-people social-logo-fb"></a>
										<a href="#" class="social-logo social-logo-people social-logo-yt"></a>
									</div>

								</div>
								<!-- end people item -->

							<?php endforeach ?>							
							
						</div>
					</div>							
				</div>				
			</section>
			<!-- end section -->
			
			
		</div>
		<!-- end main-content -->