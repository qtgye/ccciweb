<div class="main-content people-single">	

	<section class="section-wrapper">
		<div class="section-body">									
			<div class="section-content">
				<div class="page-title-block">				
					<h1 class="page-title">
						<?php echo $data['local_church']->title; ?>
					</h1>
				</div>
			</div>					
		</div>				
	</section>			

	<section class="section-wrapper">
		<div class="section-body">						
			<div class="section-content section-column-group">

				<div class="section-column section-column-5">
					<div class="people-image">
						<img src="/img/assets/pic/sample_pic.jpg" alt="">
					</div>
				</div>
				<div class="section-column section-column-7 people-single-info">										
					<div class="people-single-bio">

						<!-- show address -->
						<?php if ( $data['local_church']->address ): ?>
							<section class="location-info-item">
								<h3 class="location-info-header">Address</h3>
								<p> <?php echo $data['local_church']->address ?> </p>
							</section>
						<?php endif ?>

						<!-- show services -->
						<?php if ( $data['local_church']->services && count($data['local_church']->services) > 0 ): ?>
							<section class="location-info-item">
								<h3 class="location-info-header">Services</h3>
								<div class="services-list">									
									<?php foreach ($data['local_church']->services as $key => $service): ?>
										<?php if ( $service ): ?>
											<div class="service-item">
												<p class="service-schedule">
													<h4><em> <?php echo $service->title  ?> </em></h4>
													<p> <?php echo $service->time ?> </p>
													<p> <?php echo implode(',', $service->days) ?> </p>
												</p>
											</div>
										<?php endif ?>										
										<!-- end service-item -->
									<?php endforeach ?>									
								</div>
							</section>							
						<?php endif ?>
						
						
						<!-- end location-info-item -->
					</div>
					<!-- end people-single-bio -->
					<aside class="people-single-social-list">
						<div class="people-single-social-header">
							Connect:
						</div>
						<div class="people-single-social-item">
							<a href="#"><span href="#" class="social-logo social-logo-people social-logo-fb"></span>Some Link Here</a>
						</div>
						<div class="people-single-social-item">
							<a href="#"><span href="#" class="social-logo social-logo-people social-logo-yt"></span>Some Link Here</a>
						</div>
					</aside>
				</div>	

				<div class="cf"></div>				
			</div>							
		</div>				
	</section>
	<!-- end section -->
	
	
</div>
<!-- end main-content -->