<div class="main-content people">	

			<section class="section-wrapper">
				<div class="section-body">									
					<div class="section-content">
						<div class="page-title-block">
							<h1 class="page-title">
								<?php echo 	strtoupper($data['subpage']) ?>
							</h1>
						</div>
					</div>					
				</div>				
			</section>			

			<section class="section-wrapper">
				<div class="section-body">										
					<div class="section-content">
						<div class="posts-list">

							<?php foreach ($data['posts'] as $key => $post): ?>
								<div class="post-item cf">
									<a href="/updates/<?php echo $data['subpage'] .'/'. $post->id?>" class="post-image">
										<img src="<?php echo $post->img_url ?>" alt="">
									</a>									
									<div class="post-header">
										<h2 class="post-title">
											<?php echo $post->title ?>
										</h2>
										<div class="post-meta">
											
											<!-- filter meta according to subpage -->
											<?php if ($data['subpage']=='events'): ?>
												<p> <?php echo $post->event_date ?> </p>
												<p> <?php echo date('M d, Y',$post->event_date); ?> </p>
											<?php else: ?>
												<p> <?php echo date('M d, Y',$post->date_publish); ?> </p>
											<?php endif ?>

										</div>
									</div>															
									<div class="post-content">									
										<p>
											<?php echo $post->summary ?>
										</p>	
										<a href="/updates/<?php echo $data['subpage'] .'/'. $post->id?>" class="btn post-link-btn">
											READ MORE
										</a>
										<div class="cf"></div>
									</div>								
								</div>
								<!-- end post item -->	
							<?php endforeach ?>

													

						</div>
					</div>							
				</div>				
			</section>
			<!-- end section -->
			
			
		</div>
		<!-- end main-content -->