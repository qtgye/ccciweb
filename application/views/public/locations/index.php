<div class="main-content people">	

	<section class="section-wrapper">
		<div class="section-body">									
			<div class="section-content">
				<div class="page-title-block">
					<h1 class="page-title">
						TIMES AND LOCATIONS
					</h1>
				</div>
			</div>					
		</div>				
	</section>			

	<section class="section-wrapper">
		<div class="section-body">										
			<div class="section-content section-column-group">
				<div class="section-column section-column-12">
					<h3 class="section-content-header center">
						Local Churches
					</h3>
					<br>
					<ul class="list-row">	

						<?php foreach ($data['local_churches'] as $key => $local_church): ?>
							
							<div class="people-item">
								<a href="/about/local_churches/<?php echo $local_church->id ?>" class="thumbnail-container peop">									
									<div href="#" class="thumbnail-overlay thumbnail-overlay-link"></div>
									<div class="thumbnail-image" style="background-image:url('<?php echo $local_church->img_url ?>')"></div>
								</a>
								
								<div class="people-info">
									<h3 class="people-name">
										<?php echo $local_church->title ?>
									</h3>
									<p class="people-description">
										<?php echo $local_church->address ?>
									</p>									
								</div>										
							</div>
							<!-- end people item -->

						<?php endforeach ?>

					</ul>
					<!-- end list-row -->
				</div>
				<!-- end section-column -->
			</div>							
		</div>				
	</section>
	<!-- end section -->

	<section class="section-wrapper">
		<div class="section-body">										
			<div class="section-content section-column-group">
				<div class="section-column section-column-12">
					<h3 class="section-content-header center">
						OutReaches
					</h3>
					<br>
					<ul class="list-row">	

						<?php foreach ($data['outreaches'] as $key => $outreach): ?>
							
							<div class="people-item">
								<a href="/about/outreach/<?php echo $local_church->id ?>" class="thumbnail-container peop">									
									<div href="#" class="thumbnail-overlay thumbnail-overlay-link"></div>
									<div class="thumbnail-image" style="background-image:url('<?php echo $outreach->img_url ?>')"></div>
								</a>
								
								<div class="people-info">
									<h3 class="people-name">
										<?php echo $outreach->title ?>
									</h3>
									<p class="people-description">
										<?php echo $outreach->address ?>
									</p>									
								</div>										
							</div>
							<!-- end people item -->

						<?php endforeach ?>

					</ul>
					<!-- end list-row -->
				</div>
				<!-- end section-column -->
			</div>							
		</div>				
	</section>
	<!-- end section -->
	
	
</div>
<!-- end main-content -->