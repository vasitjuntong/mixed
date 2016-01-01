
<div class="grey-container shortcut-wrapper">
	<a href="index.html" class="shortcut-link {{ activeMenu(['reports', 'reports/*']) }}">
		<span class="shortcut-icon">
			<i class="fa fa-bar-chart-o"></i>
		</span>
		<span class="text">{{ trans('main.side_menu.report') }}</span>
	</a>
	<a href="/receives" class="shortcut-link {{ activeMenu(['receives', 'receives/*'])?'shortcut-link-active':''  }}">
		<span class="shortcut-icon">
			<i class="fa fa-download"></i>
			
		</span>
		<span class="text">{{ trans('main.side_menu.receive') }}</span>
	</a>
	<a href="/requesitions" class="shortcut-link {{ activeMenu([
		'requesitions', 
		'requesitions/*',
		'requesition-movement',
		'requesition-movement/*',
	])?'shortcut-link-active':''   }}">
		<span class="shortcut-icon">
			<i class="fa fa-upload"></i>
            {{-- <span class="shortcut-alert">
				4
			</span>	 --}}
		</span>
		<span class="text">{{ trans('main.side_menu.requesition') }}</span>
	</a>
	<a href="/product-lists" class="shortcut-link {{ activeMenu(['product-lists', 'product-lists/*'])?'shortcut-link-active':'' }}">
		<span class="shortcut-icon">
			<i class="fa fa-list"></i>
		</span>
		<span class="text">{{ trans('main.side_menu.product_list') }}</span>
	</a>
	{{-- <a 	href="setting.html" 
		class="shortcut-link hidden-xs {{ urlActive('setting')?'shortcut-link-active':'' }}"
		>
		<span class="shortcut-icon">
			<i class="fa fa-cog"></i></span>
		<span class="text">{{ trans('main.side_menu.setting') }}</span>
	</a> --}}
</div><!-- /grey-container -->