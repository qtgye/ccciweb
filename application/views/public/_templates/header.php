<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data['head_title'] ?></title>
	<meta name="viewport" content="width=device-width, initial-scale= 1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/css/public/style.css">
	<link rel="stylesheet" type="text/css" href="/libs/font-awesome-4.3.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="/css/public/layout_global.css">
	<link rel="stylesheet" type="text/css" href="/css/public/layout_xs.css" media="(min-width:50px)">
	<link rel="stylesheet" type="text/css" href="/css/public/layout_sm.css" media="(min-width:600px)">
	<link rel="stylesheet" type="text/css" href="/css/public/layout_med.css" media="(min-width:800px)">
	<link rel="stylesheet" type="text/css" href="/css/public/layout_lg.css" media="(min-width:1024px)">	
	<link rel="stylesheet" type="text/css" href="/css/public/layout_xl.css" media="(min-width:1025px)">	
	<script src="/js/public/jquery.js"></script>

	<!-- conditional libraries -->
	<?php if (isset($data['album_id'])): ?>
		<link rel="stylesheet" href="/libs/lightbox/css/lightbox.css">
		<script src="/libs/lightbox/js/lightbox.min.js"></script>
	<?php endif ?>

	<script src="/js/public/preload.js"></script>
	<script src="/js/public/domready.js"></script>
</head>
<body>

	<div class="wrapper">
		
		<header class="">
			<div class="header-content">
				<div class="brand">
					<a href="/" class="header-logo">						
					</a>
				</div>
				<!-- end brand here -->
				<div class="nav-group">
					<span class="nav-toggle nav-toggle-open">
						<img src="/img/assets/icon/xi.png" alt="menu">
					</span>
					<div class="nav-overlay"></div>
					<div class="nav-main">
						<div class="nav-toggle nav-toggle-close">							
							&times;
						</div>
						<ul class="nav-main-menu">
							<!-- <li><a href="/" class="<?php echo preg_match('/(home)/', $data['page']) ? 'navlink-active' : '' ?>" ><i class="fa fa-sm-only fa-home"></i>Home</a></li> -->
							<li>
								<span class="nav-dropdown-toggle" data-dropdown="li2"></span>
								<a href="#" class="<?php echo $data['page'] == 'about' ? 'navlink-active' : '' ?>" ><i class="fa fa-sm-only fa-info-circle"></i>About Us<i class="fa fa-caret-down"></i></a>
								<ul id="li2">
									<li><a href="/about" class="<?php echo $data['subpage'] == 'mission_vision_purpose' ? 'navlink-active' : '' ?>">Mission, Vision, Purpose</a></li>
									<li><a href="/about/pastors" class="<?php echo $data['subpage'] == 'pastors' ? 'navlink-active' : '' ?>">Our Pastors</a></li>									
									<li><a href="/about/gallery" class="<?php echo $data['subpage'] == 'gallery' ? 'navlink-active' : '' ?>">Gallery</a></li>									
								</ul>
							</li>
							<!-- if there are ministries, show submenu -->
							<?php if ( count($data['ministries']) > 0 ): ?>
								<li>
									<span class="nav-dropdown-toggle" data-dropdown="li3"></span>
									<a href="#" class="<?php echo $data['page'] == 'ministry' ? 'navlink-active' : '' ?>" ><i class="fa fa-sm-only fa-info-circle"></i>Ministry<i class="fa fa-caret-down"></i></a>								
									<ul id="li3">	
										<?php foreach ($data['ministries'] as $key => $ministry): ?>
											<li><a href="/about/ministry/<?php echo strtolower($ministry->title_abbr) ?>" class="<?php echo $data['subpage'] == $ministry->title_abbr ? 'navlink-active' : '' ?>"><?php echo strtoupper($ministry->title_abbr) ?></a></li>									
										<?php endforeach ?>	
									</ul>
								</li>	
															
							<?php endif ?>							
							<li>
								<span class="nav-dropdown-toggle" data-dropdown="li4"></span>
								<a href="#" class="<?php echo $data['page'] == 'updates' ? 'navlink-active' : '' ?>" ><i class="fa fa-sm-only fa-info-circle"></i>What's Up<i class="fa fa-caret-down"></i></a>
								<ul id="li4">
									<li><a href="/updates/events" class="<?php echo $data['subpage'] == 'events' ? 'navlink-active' : '' ?>">Events</a></li>
									<li><a href="/updates/news" class="<?php echo $data['subpage'] == 'news' ? 'navlink-active' : '' ?>">News</a></li>
									<li><a href="/updates/stories" class="<?php echo $data['subpage'] == 'stories' ? 'navlink-active' : '' ?>">Stories</a></li>
									<li><a href="/updates/articles" class="<?php echo $data['subpage'] == 'articles' ? 'navlink-active' : '' ?>">Articles</a></li>
								</ul>
							</li>	
							<!-- <li>
								<span class="nav-dropdown-toggle" data-dropdown="li5"></span>
								<a href="#" class="<?php echo $data['page'] == 'updates' ? 'navlink-active' : '' ?>" ><i class="fa fa-sm-only fa-info-circle"></i>Locations<i class="fa fa-caret-down"></i></a>
								<ul id="li5">
									<li><a href="/about/local_churches/7" class="<?php echo $data['subpage'] == '7' ? 'navlink-active' : '' ?>">Church 1</a></li>
									<li><a href="/about/local_churches/8" class="<?php echo $data['subpage'] == '8' ? 'navlink-active' : '' ?>">Church 2</a></li>
									<li><a href="/about/local_churches/9" class="<?php echo $data['subpage'] == '9' ? 'navlink-active' : '' ?>">Church 3</a></li>									
									<li><a href="/about/outreaches/3" class="<?php echo $data['subpage'] == '3' ? 'navlink-active' : '' ?>">Outreach 1</a></li>									
								</ul>
							</li>	 -->	
							<li>
								<span class="nav-dropdown-toggle" data-dropdown="li5"></span>
								<a href="#" class="<?php echo $data['page'] == 'reach_us' ? 'navlink-active' : '' ?>" ><i class="fa fa-sm-only fa-info-circle"></i>Reach Us<i class="fa fa-caret-down"></i></a>
								<ul id="li5">
									<li><a href="/about/locations" class="<?php echo $data['subpage'] == 'times_and_locations' ? 'navlink-active' : '' ?>">Times and Locations</a></li>
									<li><a href="/about/contact" class="<?php echo $data['subpage'] == 'contact' ? 'navlink-active' : '' ?>">Contact Us</a></li>
									<li><a href="/about/give" class="<?php echo $data['subpage'] == 'give' ? 'navlink-active' : '' ?>">Giving</a></li>
								</ul>
							</li>	
						</ul>
						<!-- <ul class="nav-main-social">
							<li><a href="#" class="social-logo social-logo-header social-logo-fb"></a></li>
							<li><a href="#" class="social-logo social-logo-header social-logo-yt"></a></li>
						</ul> -->
					</div>	
					<!-- end nav-main -->
				</div>
				<!-- end nav-group here -->
			</div>
			<!-- end header-content -->
			<div class="cf"></div>
		</header>
		<!-- end header -->