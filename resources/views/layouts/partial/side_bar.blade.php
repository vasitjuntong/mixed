<aside class="fixed skin-6">
	<div class="sidebar-inner scrollable-sidebar">
		<div class="size-toggle">
			<a class="btn btn-sm" id="sizeToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
				<i class="fa fa-power-off"></i>
			</a>
		</div><!-- /size-toggle -->	
		<div class="user-block clearfix">
			<img src="img/user.jpg" alt="User Avatar">
			<div class="detail">
				<strong>Akarin </strong><span class="badge badge-danger m-left-xs bounceIn animation-delay4">7</span>
				<ul class="list-inline">
					<li><a href="profile.html">Profile</a></li>
					<li><a href="inbox.html" class="no-margin">Inbox</a></li>
				</ul>
			</div>
		</div><!-- /user-block -->
		<div class="search-block">
			<div class="input-group">
				<input type="text" class="form-control input-sm" placeholder="search here...">
				<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
				</span>
			</div><!-- /input-group -->
		</div><!-- /search-block -->
		<div class="main-menu">
		  <ul>
			<li class="">
				<a href="/">
					<span class="menu-icon">
						<i class="fa fa-desktop fa-lg"></i> 
					</span>
					<span class="text">
						Dashboard
					</span>
					<span class="menu-hover"></span>
				</a>
			</li>
			<li class="openable {{ urlActive('component')? 'active':'' }}">
				<a href="#">
					<span class="menu-icon">
						<i class="fa fa-tag fa-lg"></i> 
					</span>
					<span class="text">
						Component
					</span>
		
					<span class="menu-hover"></span>
				</a>
				<ul class="submenu">
					<li><a href="receive.html"><span class="submenu-label">Receive</span></a></li>
					<li><a href="requisition.html"><span class="submenu-label">Requisition</span></a></li>
					<li><a href="notification.html"><span class="submenu-label">Notification</span></a></li>
					<li><a href="/product-lists"><span class="submenu-label">{{ trans('main.side_menu.product_lists') }}</span></a></li>
					<li><a href="setting.html"><span class="submenu-label">Setting</span></a></li>
                    </ul>
			</li>
			<li class="openable {{ urlActive('setting')? 'active openable':'' }}">
				<a href="#">
					<span class="menu-icon">
						<i class="fa fa-file-text fa-lg"></i> 
					</span>
					<span class="text">
						Setting
					</span>
					<span class="menu-hover"></span>
				</a>
				<ul class="submenu">
					<li
						class="{{ activeMenu(['products', 'products/*']) ? 'active':'' }}"
					>
						<a href="/products">
							<span class="submenu-label">{{ trans('main.side_menu.product') }}</span>
						</a>
					</li>
					<li
						class="{{ activeMenu(['product-types', 'product-types/*']) ? 'active':'' }}"
					>
						<a href="/product-types">
							<span class="submenu-label">{{ trans('main.side_menu.product_type') }}</span>
						</a>
					</li>
					<li class="{{ activeMenu(['units', 'units/*']) ? 'active':'' }}">
						<a href="/units">
							<span class="submenu-label">
								{{ trans('main.side_menu.unit') }}
							</span>
						</a>
					</li>
					<li class="{{ activeMenu(['locations', 'locations/*']) ? 'active':'' }}">
						<a href="/locations">
							<span class="submenu-label">{{ trans('main.side_menu.location') }}</span>
						</a>
					</li>
					<li class="{{ activeMenu(['projects', 'projects/*']) ? 'active':'' }}">
						<a href="/projects">
							<span class="submenu-label">{{ trans('main.side_menu.project') }}</span>
						</a>
					</li>
				</ul>
			</li>
	  	</ul>
			
			<div class="alert alert-info">
				Welcome to Mixed System. Do not forget to check all my pages. 
			</div>
	  </div><!-- /main-menu -->
	</div><!-- /sidebar-inner -->
</aside>