<div class="main-content home">			
			<section class="banner-wrapper">
				<div class="banner">
					
				</div>
			</section>
			<section class="about-intro section-wrapper">
				<div class="section-body">
					<div class="section-content-header">
						<h1>ABOUT US</h1>
					</div>
					<div class="section-content">
						<?php if ( isset($data['mission']) ): ?>
							<div class="mission-intro">
								<h3>OUR MISSION</h3>
								<div class="mission-intro-content">
									<?php echo $data['mission']->content ?>
								</div>
								<a href="/about" class="btn mission-intro-btn">LEARN MORE</a>
							</div>	
						<?php endif ?>

						<?php if ( isset($data['ministry']) && count($data['ministry']) > 0 ): ?>
							<div class="branches-intro">
								<h3>MINISTRIES</h3>
								<div class="branches-intro-content">
									<?php foreach ($data['ministry'] as $key => $ministry): ?>
										<div class="branch-item">
											<div class="branch-logo-container">
												<a href="/about/ministry/<?php echo strtolower($ministry->title_abbr) ?>" class="branch-logo-link">
													<img src="<?php echo $ministry->img_url ?>" alt="" class="branch-logo-img">			
												</a>
											</div>
											<h3 class="branch-title">
												<?php echo $ministry->title ?>
											</h3>
										</div>			
									<?php endforeach ?>														
								</div>							
							</div>
						<?php endif ?>						
						
					</div>					
				</div>				
			</section>
			<!-- close about-intro -->
		
			<section class="locations-intro section-wrapper">
				<div class="section-body">
					<div class="section-content-header">
						<h1>FIND A LOCATION NEAR YOU</h1>
					</div>
					<div class="section-content">
						<?php if ( isset($data['local_churches']) && count($data['local_churches']) > 0 ): ?>
							<ul class="location-list">
								<?php foreach ($data['local_churches'] as $key => $local_church): ?>
									<li class="location-item">
										<a href="/about/locations/<?php echo $local_church->id ?>" class="location-item-link">
											<?php echo $local_church->title ?>
										</a>
									</li>
								<?php endforeach ?>								
							</ul>
						<?php endif ?>						
					</div>
				</div>
			</section>
			<!-- close locations-intro -->

			<section class="section-wrapper updates-intro">
				<div class="section-body">
					<div class="section-content-header">
						<h1>UPDATES</h1>
					</div>
					<div class="section-content">
						<div class="updates-body">
							<div class="latest-event">
								<div class="latest-post-item-header">
									Coming up
								</div>
								<div class="event-content">
									<div class="event-photo">
										<img src="img/assets/bg/sample_event_thumb.jpg" alt="">
									</div>
									<div class="latest-post-content">
										<h2 class="latest-post-title">
											Some Nice Title Here
										</h2>
										<div class="latest-post-meta">
											<p>Some Date Here</p>										
										</div>
										<a class="btn latest-post-link-btn">
											► VIEW MORE EVENTS
										</a>
									</div>
								</div>
							</div>
							<!-- close latest events -->
							<div class="latest-posts">
								<ul class="latest-post-list">
									<li class="latest-post-item">
										<div class="latest-post-item-header">
											News
										</div>
										<div class="latest-post-content">
											<h2 class="latest-post-title">
												Some Nice Title Here
											</h2>
											<div class="latest-post-meta">
												
											</div>
											<div class="latest-post-text">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, magni distinctio id officiis. Maiores, cupiditate distinctio dolorem omnis atque. Nisi facere, molestiae, veniam eligendi in nemo consequatur culpa optio fugiat.</p>
												<p>Qui quidem, vitae autem, officiis impedit molestias. Quam excepturi dolorem saepe obcaecati ducimus tenetur cum asperiores aliquid quod velit, consectetur error, cupiditate sit non similique quaerat distinctio illo incidunt, reiciendis.</p>
												<p>Quisquam dicta aut nisi rem deserunt, vel tempore vero sit, accusamus ex adipisci blanditiis consectetur id qui deleniti expedita. Rerum molestias alias error et non odio quae porro aspernatur! Facere.</p>
											</div>
											<div class="btn latest-post-link-btn">
												► READ MORE
											</div>
										</div>
									</li>
									<!-- close latest-post-item -->
									<li class="latest-post-item">
										<div class="latest-post-item-header">
											News
										</div>
										<div class="latest-post-content">
											<h2 class="latest-post-title">
												Some Nice Title Here
											</h2>
											<div class="latest-post-meta">
												
											</div>
											<div class="latest-post-text">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, magni distinctio id officiis. Maiores, cupiditate distinctio dolorem omnis atque. Nisi facere, molestiae, veniam eligendi in nemo consequatur culpa optio fugiat.</p>
												<p>Qui quidem, vitae autem, officiis impedit molestias. Quam excepturi dolorem saepe obcaecati ducimus tenetur cum asperiores aliquid quod velit, consectetur error, cupiditate sit non similique quaerat distinctio illo incidunt, reiciendis.</p>
												<p>Quisquam dicta aut nisi rem deserunt, vel tempore vero sit, accusamus ex adipisci blanditiis consectetur id qui deleniti expedita. Rerum molestias alias error et non odio quae porro aspernatur! Facere.</p>
											</div>
											<div class="btn latest-post-link-btn">
												► READ MORE
											</div>
										</div>
									</li>
									<!-- close latest-post-item -->
									<li class="latest-post-item">
										<div class="latest-post-item-header">
											News
										</div>
										<div class="latest-post-content">
											<h2 class="latest-post-title">
												Some Nice Title Here
											</h2>
											<div class="latest-post-meta">
												
											</div>
											<div class="latest-post-text">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, magni distinctio id officiis. Maiores, cupiditate distinctio dolorem omnis atque. Nisi facere, molestiae, veniam eligendi in nemo consequatur culpa optio fugiat.</p>
												<p>Qui quidem, vitae autem, officiis impedit molestias. Quam excepturi dolorem saepe obcaecati ducimus tenetur cum asperiores aliquid quod velit, consectetur error, cupiditate sit non similique quaerat distinctio illo incidunt, reiciendis.</p>
												<p>Quisquam dicta aut nisi rem deserunt, vel tempore vero sit, accusamus ex adipisci blanditiis consectetur id qui deleniti expedita. Rerum molestias alias error et non odio quae porro aspernatur! Facere.</p>
											</div>
											<div class="btn latest-post-link-btn">
												► READ MORE
											</div>
										</div>
									</li>
									<!-- close post-item -->
								</ul>
								<!-- close posts-list -->
							</div>
							<!-- close latest posts -->
						</div>						
						<!-- close updates-body -->
					</div>
				</div>
			</section>
			<!-- close updates intro -->

		</div>
		<!-- end main-content -->