<div class="main-content people">		

			<section class="section-wrapper">
				<div class="section-body">										
					<div class="section-content">						
						<div class="post-single-group section-column-group">

							<div class="post-single-wrapper section-column section-column-9">
								<div class="post-single-title">
									<h1>
										<?php echo $data['post']->title ?>
									</h1>
								</div>
								<div class="post-single-meta">
									
									<!-- events have event_date, others have publish_date -->
									<p>
										<?php 
											switch ($data['subpage']) {
												case 'events':
													echo date('M d, Y',$data['post']->event_date);
													break;

												default:
													echo date('M d, Y',$data['post']->date_publish);
													break;
											}
										?>
									</p>

									<!-- optional author name -->
									<!-- <p>Some Author Here</p> -->

								</div>
								<div class="post-single-image">
									<img src="<?php echo $data['post']->img_url ?>" title="<?php echo $data['post']->img_caption ?>">
								</div>							
								<div class="post-single-content">
									<?php echo $data['post']->content ?>									
								</div>

								<!-- optional : next post -->
								<!-- <a href="#" class="post-single-next">
									Next: Some Nice Title Here, Which is Very Long Indeed
								</a> -->

								<div class="post-single-social">
									<div class="post-social-info">
										<p>Share this post:</p>
										<div class="social-numbers">
											<a href="#" class="social-number-item">
												<div class="social-logo social-logo-people social-logo-fb"></div>
												300
											</a>
											<a href="#" class="social-number-item social-number-yt">
												<div class="social-logo social-logo-people social-logo-yt"></div>
												1,650
											</a>										
										</div>
									</div>
									<div class="comments">
										<!-- <small><em>Comments API here</em></small> -->
									</div>
								</div>
							</div>
							<!-- post-single-wrapper -->

							<aside class="post-single-sidebar section-column section-column-3">
								<div class="post-single-sidebar-header">
									<h4>
										OTHER <?php echo strtoupper($data['subpage']) ?>
									</h4>
								</div>
								<div class="post-single-sidebar-list">

									<?php foreach ($data['other_posts'] as $post): ?>
										<div class="post-single-sidebar-item">
											<a href="/updates/<?php echo $data['subpage'] .'/'. $post->id ?>" class="post-sidebar-item-header post-title">
												<h2> <?php echo $post->title ?>
												</h2>
											</a>
											<div class="post-sidebar-item-content">
												<?php echo $post->summary ?>
											</div>
										</div>
										<!-- post-single-sidebar-item -->
									<?php endforeach ?>
									

								</div>
								<!-- post-single-sidebar-list -->
							</aside>
							<!-- post-single-sidebar -->

						</div>
						<!-- post-single-group -->
					</div>		
					<!-- section-content -->					
				</div>				
			</section>
			<!-- end section -->
			
			
		</div>
		<!-- end main-content -->