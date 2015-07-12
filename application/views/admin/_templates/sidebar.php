<div class="sidebar hover-dropdown">
	<div class="sidebar-options">
		<span class="sidebar-menu-toggle" id="menu-toggle-close"  data-collapse=".sidebar">
			<small>CLOSE MENU &nbsp;&nbsp;&nbsp; X</small> 
		</span>
	</div>	
	<div class="sidebar-header">
		<div class="user-welcome">			
			<div>						
				<a href="<?php echo URL.'admin/profile/' ?>">
					<h3 style="background:url('<?php echo URL.'public/img/assets/icons/user-m.png' ?>') no-repeat center left;background-size: 16px auto;">
						<?php echo $data->user->username; ?>
					</h3>
				</a>
			</div>
		</div>		
		<!-- sidebar-header-options -->
		<div class="sidebar-header-options">
			<!-- notification group for collapsing menu -->
			<div class="notification-toggle notification-toggle-collapse" id="notification-toggle-collapse">
				<?php if (count($data->sidebar->notification) > 0): ?>
					<div class="notification-count" data-collapse=".notification-menu" collapse-group="sidebar-header-collapse">
						<?php echo count($data->sidebar->notification) ?>
					</div>
					<?php if (count($data->sidebar->notification) > 0): ?>
						<div class="notification-menu" id="notification-menu" data-collapse=".notification-menu" collapse-group="sidebar-header-collapse" collapse-preventDefault="false">
							<ul>					
								<?php foreach ($data->sidebar->notification as $key => $value) :?>
									<li><a href="<?php echo $value->link ?>"><?php echo $value->message ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div> <!-- notification-menu -->
					<?php endif ?>					
				<?php endif ?>	
			</div>
			<!-- notification group for hover-toggle menu -->
			<div class="notification-toggle notification-toggle-hover" id="notification-toggle-hover">
				<?php if (count($data->sidebar->notification) > 0): ?>
					<div class="notification-count" >
						<?php echo count($data->sidebar->notification) ?>
					</div>
					<?php if (count($data->sidebar->notification) > 0): ?>
						<div class="notification-menu" >
							<ul>					
								<?php foreach ($data->sidebar->notification as $key => $value) :?>
									<li><a href="<?php echo $value->link ?>"><?php echo $value->message ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div> <!-- notification-menu -->
					<?php endif ?>					
				<?php endif ?>	
			</div>
			<!-- settings group for collapsing menu -->
			<div class="user-settings settings-toggle-collapse" id="settings-toggle" >
				<div class="settings-toggle" data-collapse=".settings-menu" collapse-group="sidebar-header-collapse">
					<div class="settings-logo"></div>
				</div>
				<div class="settings-menu" id="settings-menu" data-collapse=".settings-menu" collapse-group="sidebar-header-collapse" collapse-preventDefault="false">
					<ul>
						<li><a href="<?php echo URL.'admin/profile/edit_profile' ?>" >Edit Profile</a></li>
						<li><a href="<?php echo URL.'admin/profile/change_password' ?>" >Change Password</a></li>
						<li><a href="<?php echo URL.'admin/logout' ?>" >Log Out</a></li>
					</ul>
				</div>
			</div>	
			<!-- settings group for hover-toggle menu -->
			<div class="user-settings settings-toggle-hover" >
				<div class="settings-toggle" >
					<div class="settings-logo"></div>
				</div>
				<div class="settings-menu" id="settings-menu" >
					<ul>
						<li><a href="<?php echo URL.'admin/profile/edit_profile' ?>" >Edit Profile</a></li>
						<li><a href="<?php echo URL.'admin/profile/change_password' ?>" >Change Password</a></li>
						<li><a href="<?php echo URL.'admin/logout' ?>" >Log Out</a></li>
					</ul>
				</div>
			</div>		
		</div> 	
		<!-- user-options -->
		<div class="user-options">
			<a href="<?php echo URL.'admin/profile/edit_profile' ?>" class="user-buttons">Edit Profile</a>
			<a href="<?php echo URL.'admin/profile/change_password' ?>" class="user-buttons">Change Password</a>
			<a href="<?php echo URL.'admin/logout' ?>" class="user-buttons">Logout</a>			
		</div>
		<div class="cf"></div>
	</div> <!-- sidebar-header -->
	<?php if ( $data->user->permission <= 3 ) : ?>				
	<div class="sidebar-menu">
		<div class="sidebar-menu-header">Posts and Photos</div>
		<ul>
			<?php foreach ($data->sidebar->sidebar_menu_3 as $key => $p) :?>			
				<?php if ($p->name!='albums'): ?>
					<li>
						<a href="<?php echo $p->link ?>"?><?php echo $p->title ?></a>
						<ul>
							<li><a href="<?php echo $p->published->link ?>">View Published (<?php echo $p->published->count ?>)</a></li>
							<li><a href="<?php echo URL.'admin/add_new/'.$p->name ?>">Add New</a></li>
							<li><a href="<?php echo $p->draft->link ?>">Drafts (<?php echo $p->draft->count ?>)</a></li>
							<li><a href="<?php echo $p->trash->link ?>">Trash (<?php echo $p->trash->count ?>)</a></li>								
						</ul>
					</li>
				<?php else: ?>
					<li>				
						<a href="<?php echo URL.'admin/view/albums/published' ?>"?>Albums</a>
						<ul>
							<li><a href="<?php echo $p->published->link ?>">Show Albums (<?php echo $p->published->count ?>)</a></li>
							<li><a href="<?php echo URL.'admin/add_new/'.$p->name ?>">Add New Album</a></li>							
						</ul>
					</li>
				<?php endif ?>
			<?php endforeach; ?>			
		</ul>
	</div>
	<?php endif; ?>
	<?php if ( $data->user->permission <= 2 ) : ?>
	<div class="sidebar-menu">
		<div class="sidebar-menu-header">Church and Ministries</div>
		<ul>						
			<?php foreach ($data->sidebar->sidebar_menu_2 as $key => $p) :?>			
				<li>
					<a href="<?php echo $p->link ?>"?><?php echo $p->title ?></a>
					<ul>
						<li><a href="<?php echo $p->published->link ?>">View Published (<?php echo $p->published->count ?>)</a></li>
						<li><a href="<?php echo URL.'admin/add_new/'.$p->name ?>">Add New</a></li>
						<li><a href="<?php echo $p->draft->link ?>">Drafts (<?php echo $p->draft->count ?>)</a></li>
						<li><a href="<?php echo $p->trash->link ?>">Trash (<?php echo $p->trash->count ?>)</a></li>								
					</ul>
				</li>
			<?php endforeach; ?>						
		</ul>
	</div>
<?php endif; ?>
<?php if ( $data->user->permission == 1 ) : ?>
	<div class="sidebar-menu">
		<div class="sidebar-menu-header">Site Admin</div>
		<ul>
			<?php foreach ($data->sidebar->sidebar_menu_1 as $key => $p) :?>			
				<?php if ($p->name=='users'): ?>
					<li>
						<a href="<?php echo $p->link ?>"?><?php echo $p->title ?></a>
						<ul>
							<li><a href="<?php echo $p->published->link ?>">Active Users (<?php echo $p->published->count ?>)</a></li>							
							<li><a href="<?php echo $p->draft->link ?>">Awaiting Requests (<?php echo $p->draft->count ?>)</a></li>
						</ul>
					</li>	
				<?php elseif ($p->name=='site_settings'):?>			
					<li>
						<a href="<?php echo $p->link ?>"?><?php echo $p->title ?></a>						
					</li>
				<?php endif ?>
			<?php endforeach; ?>			
			<li>
				<a href="#">Documentation</a>							
			</li>					
		</ul>
	</div> <!-- sidebar-menu -->				
	<?php endif; ?>
</div> <!-- sidebar -->
<div class="content">