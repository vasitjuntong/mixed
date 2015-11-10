@extends('layouts.app')

@section('content')
	
<div class="row">
	<div class="col-sm-4 col-md-4">
		<div class="panel-stat3 bg-danger">
			<h2 class="m-top-none" >58</h2>
			<h5>RECEIVE</h5>
			<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">5% Higher than last week</span>
			<div class="stat-icon">
				<i class="fa fa-list fa-3x"></i>
			</div>
			<div class="refresh-button">
				<i class="fa fa-refresh"></i>
			</div>
			<div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
			</div>
		</div>
	</div><!-- /.col --><!-- /.col -->
	<div class="col-sm-4 col-md-4">
		<div class="panel-stat3 bg-warning">
			<h2 class="m-top-none" >30</h2>
			<h5>REQUISITION PENDING</h5>
			<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">3% Higher than last week</span>
			<div class="stat-icon">
				<i class="fa  fa-magic fa-3x"></i>
			</div>
			<div class="refresh-button">
				<i class="fa fa-refresh"></i>
			</div>
			<div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
			</div>
		</div>
	</div><!-- /.col -->
	<div class="col-sm-4 col-md-4">
		<div class="panel-stat3 bg-success">
			<h2 class="m-top-none" >11</h2>
			<h5>REQUISITION SUCCEED</h5>
			<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">15% Higher than last week</span>
			<div class="stat-icon">
				<i class="fa fa-check fa-3x"></i>
			</div>
			<div class="refresh-button">
				<i class="fa fa-refresh"></i>
			</div>
			<div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		  <div class="panel-heading clearfix">
				<span class="pull-left"><i class="fa fa-bar-chart-o fa-lg"></i> REQUISITION Traffic</span>
				<ul class="tool-bar">
					<li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a></li>
				</ul>
			</div>
			<div class="panel-body" id="trafficWidget">
				<div id="placeholder" class="graph" style="height:250px"></div>
			</div>
			
			<div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
			</div>
		</div><!-- /panel -->
				
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<div  class="panel panel-default panel-stat1 bg-success">
					<div class="panel-body">
						<div class="value">189</div>
						<div class="title">
							<i class="fa fa-folder"></i>
							<span class="m-left-xs">PRODUCT</span>
						</div>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
			<div class="col-md-4 col-sm-4">
				<div class="panel panel-default panel-stat2 bg-warning">
					<div class="panel-body">
						<span class="stat-icon">
							<i class="fa fa-bar-chart-o"></i>
						</span>
						<div class="pull-right text-right">
							<div class="value">58</div>
							<div class="title">RECEIVE</div>
						</div>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
			<div class="col-md-4 col-sm-4">
				<div class="panel panel-default panel-stat2 bg-info">
					<div class="panel-body">
						<span class="stat-icon">
							<i class="fa fa-bar-chart-o"></i>
						</span>
						<div class="pull-right text-right">
							<div class="value">41</div>
							<div class="title">REQUISITION</div>
						</div>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div>
	  <p><!-- /.row --></p>
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<span class="pull-left">
							To Do List <span class="text-success m-left-xs"><i class="fa fa-check"></i></span>
						</span>
						<ul class="tool-bar">
							<li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a></li>
							<li><a href="#toDoListWidget" data-toggle="collapse"><i class="fa fa-arrows-v"></i></a></li>
						</ul>
					</div>
					<div class="panel-body no-padding collapse in" id="toDoListWidget">
						<ul class="list-group task-list no-margin collapse in">
							<li class="list-group-item selected">
								<label class="label-checkbox inline">
									 <input type="checkbox" class="task-finish" checked>
									 <span class="custom-checkbox"></span>
								</label>
								SEO Optimisation
								<span class="pull-right">
									<a href="#" class="task-del"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
								</span>
							</li>
							<li class="list-group-item">
								<label class="label-checkbox inline">
									 <input type="checkbox" class="task-finish">
									 <span class="custom-checkbox"></span>
								</label>
								Unit Testing
								<span class="pull-right">
									<a href="#" class="task-del"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
								</span>
							</li>
							<li class="list-group-item">
								<label class="label-checkbox inline">
									 <input type="checkbox" class="task-finish">
									 <span class="custom-checkbox"></span>
								</label>
								Mobile Development 
								<span class="pull-right">
									<a href="#" class="task-del"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
								</span>
								<span class="badge badge-success m-right-xs">3</span>
							</li>
							<li class="list-group-item">
								<label class="label-checkbox inline">
									 <input type="checkbox" class="task-finish">
									 <span class="custom-checkbox"></span>
								</label>
								Database Migration
								<span class="pull-right">
									<a href="#" class="task-del"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
								</span>
							</li>
							<li class="list-group-item">
								<label class="label-checkbox inline">
									 <input type="checkbox" class="task-finish">
									 <span class="custom-checkbox"></span>
								</label>
								New Frontend Layout <span class="label label-warning m-left-xs">PENDING</span>
								<span class="pull-right">
									<a href="#" class="task-del"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
								</span>
							</li>
							<li class="list-group-item">
								<label class="label-checkbox inline">
									 <input type="checkbox" class="task-finish">
									 <span class="custom-checkbox"></span>
								</label>
								Bug Fixes <span class="label label-danger m-left-xs">IMPORTANT</span>
								<span class="pull-right">
									<a href="#" class="task-del"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
								</span>
							</li>
						</ul><!-- /list-group -->
					</div>
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
			<div class="col-lg-6">
				<div class="panel panel-default">	
					<div class="panel-heading clearfix">
						<span class="pull-left">Feeds</span>
						<ul class="tool-bar">
							<li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a></li>
							<li><a href="#feedList" data-toggle="collapse"><i class="fa fa-arrows-v"></i></a></li>
						</ul>
					</div>		
					<ul class="list-group collapse in" id="feedList">
						<li class="list-group-item clearfix">
							<div class="activity-icon small">
								<i class="fa fa-plus"></i>
							</div>
							<div class="pull-left m-left-sm">
								<span><a href="invoice.html">IS5810-001 </a>new</span><br/>
								<small class="text-muted"><i class="fa fa-clock-o"></i> 2m ago</small>
							</div>
						</li>
						<li class="list-group-item clearfix">
							<div class="activity-icon bg-success small">
								<i class="fa fa-truck"></i>
							</div>
							<div class="pull-left m-left-sm">
								<span><a href="invoice.html">IS5810-004 </a>SUCCEED</span><br/>
								<small class="text-muted"><i class="fa fa-clock-o"></i> 30m ago</small>
							</div>	
						</li>
						<li class="list-group-item clearfix">
							<div class="activity-icon bg-info small">
								<i class="fa fa-comment"></i>
							</div>
							<div class="pull-left m-left-sm">
								<span><a href="invoice.html">IS5810-006 </a>PENDING</span><br/>
								<small class="text-muted"><i class="fa fa-clock-o"></i> 1hr ago</small>
							</div>
						</li>
						<li class="list-group-item clearfix">
							<div class="activity-icon bg-success small">
								<i class="fa fa-truck"></i>
							</div>
							<div class="pull-left m-left-sm">
								<span><a href="invoice.html">IS5810-008</a> SUCCEED</span><br/>
								<small class="text-muted"><i class="fa fa-clock-o"></i> 2days ago</small>
							</div>	
						</li>
					</ul><!-- /list-group -->	
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- ./row -->
	</div><!-- /.col -->
</div><!-- /.row -->

@endsection