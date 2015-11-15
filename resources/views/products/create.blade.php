@extends('layouts.app')

@section('breadcrump')

	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-home"></i>
			 	<a href="/products"> {{ trans('product.label.name')}}</a>
		 	</li>
		 	<li class="active">{{ trans('product.label.create') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('product.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->

@endsection

@section('content')

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">New Product</div>
		<div class="panel-body">
			<form method="POST" action="/products" enctype="multipart/form-data">
				{{ csrf_field()}}

				@include('products.partial.form')
	            
	           <div class="row">
		           	<div class="col-md-12"> 
		      			<button type="submit" class="btn btn-success btn-sm">
		      				{{ trans('main.button.create') }}
		      			</button>
		            </div>
	           </div>
			</form>
		</div>
	</div><!-- /panel -->
</div>
@endsection