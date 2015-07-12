<div class="main-content people-single">	

	<section class="section-wrapper">
		<div class="section-body">									
			<div class="section-content">
				<!-- <div class="page-title-block">
					<h1 class="page-title">
						OUR PEOPLE
					</h1>
				</div> -->
			</div>					
		</div>				
	</section>			

	<section class="section-wrapper">
		<div class="section-body">						
			<div class="section-content section-column-group">

				<div class="section-column section-column-5">
					<div class="people-image">
						<img src="<?php echo $data['pastor']->img_url ?>" alt="">
					</div>
				</div>
				<div class="section-column section-column-7 people-single-info">
					<h3 class="section-content-header">
						<?php echo $data['pastor']->name_first ?>
						<?php echo substr($data['pastor']->name_middle, 0,1) ?>
						<?php echo $data['pastor']->name_last ?>
					</h3>
					<div class="people-single-meta">
						<!-- <p>Birthday : 25</p>
						<p>Address : Anywhere</p>
						<p>Profession : Professional Sleeper</p> -->
					</div>
					<div class="people-single-bio">
						<?php echo $data['pastor']->biography ?>						
					</div>
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