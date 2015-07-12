<div class="main-content people-single">	

	<section class="section-wrapper">
		<div class="section-body">									
			<div class="section-content">
				<div class="page-title-block">
					<h1 class="page-title">
						<?php echo $data['ministry']->title ?>
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
						<?php if ( !empty($data['ministry']->img_url) ): ?>
							<img src="<?php echo $data['ministry']->img_url ?>" alt="">
						<?php endif ?>						
					</div>
				</div>
				<div class="section-column section-column-7 people-single-info">
					
					<article>
						<div class="article-body">
							<?php echo $data['ministry']->content ?>
						</div>
					</article>

					<?php if ( $data['ministry']->mission ): ?>
						<article>
						<h4 class="article-header">
							Our Mission
						</h4>
						<div class="article-body">
							<?php echo $data['ministry']->mission ?>
						</div>
					</article>
						<!-- end article -->
					<?php endif ?>

					<?php if ( $data['ministry']->vision ): ?>
						<article>
						<h4 class="article-header">
							Our Vision
						</h4>
						<div class="article-body">
							<?php echo $data['ministry']->vision ?>
						</div>
					</article>
						<!-- end article -->
					<?php endif ?>
					
				</div>	

				<div class="cf"></div>				
			</div>							
		</div>				
	</section>
	<!-- end section -->
	
	
</div>
<!-- end main-content -->