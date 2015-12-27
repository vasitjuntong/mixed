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
			<img src="/img/user.jpg" alt="User Avatar">
			<div class="detail">
				@if(Auth::check())
					<strong>{{ Auth::user()->name }}</strong>
				@endif
				<span class="badge badge-danger m-left-xs bounceIn animation-delay4">7</span>
				<ul class="list-inline">
					<li><a href="/profile">Profile</a></li>
				</ul>
			</div>
		</div>
		<div class="main-menu">
		  <ul>
			<li class="{{ activeMenu(['/', '/home', '/dashboard']) ? 'active openable':'' }}">
				<a href="/">
					<span class="menu-icon">
						<i class="fa fa-desktop fa-lg"></i> 
					</span>
					<span class="text">
						{{ trans('main.side_menu.dashboard') }}
					</span>
					<span class="menu-hover"></span>
				</a>
			</li>
			@if(hasRole('component'))
				<li class="openable {{ urlActive('component')? 'active openable':'' }}">
					<a href="#">
						<span class="menu-icon">
							<i class="fa fa-tag fa-lg"></i> 
						</span>
						<span class="text">
							{{ trans('main.side_menu.component') }}
						</span>
			
						<span class="menu-hover"></span>
					</a>
					<ul class="submenu">
						@if(Auth::user()->hasRole('manager_receive'))
							<li class="{{ activeMenu(['receives', 'receives/*']) ? 'active':'' }}">
								<a href="/receives">
									<span class="submenu-label">
										{{ trans('main.side_menu.receive') }}
									</span>
								</a>
							</li>
						@endif
						@if(Auth::user()->hasRole('manager_requesition'))
							<li class="{{ activeMenu(['requesitions', 'requesitions/*']) ? 'active':'' }}">
								<a href="/requesitions">
									<span class="submenu-label">
										{{ trans('main.side_menu.requesition') }}
									</span>
								</a>
							</li>
						@endif

						@if(Auth::user()->hasRole('manager_product_list'))
							<li class="{{ activeMenu(['product-lists', 'product-lists/*']) ? 'active':'' }}">
								<a href="/product-lists">
									<span class="submenu-label">
										{{ trans('main.side_menu.product_list') }}
									</span>
								</a>
							</li>
						@endif
	                </ul>
				</li>
			@endif

			@if(hasRole('setting'))
				<li class="openable {{ urlActive('setting')? 'active openable':'' }}">
					<a href="#">
						<span class="menu-icon">
							<i class="fa fa-cog fa-lg"></i> 
						</span>
						<span class="text">
							{{ trans('main.side_menu.setting') }}
						</span>
						<span class="menu-hover"></span>
					</a>
					<ul class="submenu">
						@if(Auth::user()->hasRole('manager_product'))
							<li
								class="{{ activeMenu(['products', 'products/*']) ? 'active':'' }}"
							>
								<a href="/products">
									<span class="submenu-label">{{ trans('main.side_menu.product') }}</span>
								</a>
							</li>
						@endif

						@if(Auth::user()->hasRole('manager_product_type'))
							<li
								class="{{ activeMenu(['product-types', 'product-types/*']) ? 'active':'' }}"
							>
								<a href="/product-types">
									<span class="submenu-label">{{ trans('main.side_menu.product_type') }}</span>
								</a>
							</li>
						@endif

						@if(Auth::user()->hasRole('manager_unit'))
							<li class="{{ activeMenu(['units', 'units/*']) ? 'active':'' }}">
								<a href="/units">
									<span class="submenu-label">
										{{ trans('main.side_menu.unit') }}
									</span>
								</a>
							</li>
						@endif

						@if(Auth::user()->hasRole('manager_location'))
							<li class="{{ activeMenu(['locations', 'locations/*']) ? 'active':'' }}">
								<a href="/locations">
									<span class="submenu-label">{{ trans('main.side_menu.location') }}</span>
								</a>
							</li>
						@endif

						@if(Auth::user()->hasRole('manager_project'))
							<li class="{{ activeMenu(['projects', 'projects/*']) ? 'active':'' }}">
								<a href="/projects">
									<span class="submenu-label">{{ trans('main.side_menu.project') }}</span>
								</a>
							</li>
						@endif

						@if(Auth::user()->hasRole('manager_user'))
							<li class="{{ activeMenu(['users', 'users/*']) ? 'active':'' }}">
								<a href="/users">
									<span class="submenu-label">{{ trans('main.side_menu.user') }}</span>
								</a>
							</li>
						@endif
					</ul>
				</li>
			@endif
	  	</ul>
			
			<div class="alert alert-info">
				Welcome to Mixed System. Do not forget to check all my pages. 
			</div>
	  </div><!-- /main-menu -->
	</div><!-- /sidebar-inner -->
</aside>