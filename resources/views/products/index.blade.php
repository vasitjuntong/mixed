@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('product.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('product.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-body">
		<span>In Stock</span><span class="badge badge-success m-left-xs">8</span>
		<span>Stock Minimum</span><span class="badge badge-warning m-left-xs">2</span>
		<span>Out of Stock</span><span class="badge badge-danger m-left-xs">2</span>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
	   <a href="/products/create" class="btn btn-info">{{ trans('main.button.create') }}</a>
	</div>
</div>
<div class="panel panel-default">
  	<div class="panel-body row">
		@include('products.partial.table')
  	</div>
</div>

@endsection