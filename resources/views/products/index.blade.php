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
	   <a href="/products/create" class="btn btn-info btn-sm">{{ trans('product.buttons.create') }}</a>
	</div>
</div>
<div class="panel panel-default table-responsive">
  	<div class="panel-body">
		@include('products.partial.table')
		<span class="text-center block">{!! $products->render() !!}</span>
  	</div>
</div>

@endsection

@section('script')
	@parent

	<script type="text/javascript" src="/js/libs/form_confirm_delete.js"></script>
@endsection