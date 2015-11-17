@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('product_list.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('product_list.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<span>In Stock</span><span class="badge badge-success">8</span>
		<span>Stock Minimum</span><span class="badge badge-warning">2</span>
		<span>Out of Stock</span><span class="badge badge-danger">2</span>
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">
		@include('productLists.partial.table')
  	</div>
</div>

@endsection