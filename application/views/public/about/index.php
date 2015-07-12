<div class="main-content about">		

			<section class="section-wrapper">
				<div class="section-body">									
					<div class="section-content">
						<div class="page-title-block">
							<h1 class="page-title">
								ABOUT US
							</h1>
						</div>
					</div>					
				</div>				
			</section>
	
			<?php foreach ($data['statements'] as $statement): ?>
				<?php if ($statement): ?>
					
					<section class="section-wrapper">					
						<div class="section-body">
							<div class="section-content-header">
								<h1> <?php echo $statement->title ?>
								</h1>
							</div>					
							<div class="section-content">
								<?php echo $statement->content ?>
							</div>					
						</div>				
					</section>
					<!-- close about, mission -->

				<?php endif ?>
			<?php endforeach ?>
			
			
			
		</div>
		<!-- end main-content -->