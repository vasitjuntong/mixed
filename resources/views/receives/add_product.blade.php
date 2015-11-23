@extends('layouts.app')

@section('breadcrump')

	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-home"></i>
			 	<a href="/receives"> {{ trans('receive.label.name')}}</a>
		 	</li>
		 	<li><i class="fa fa-home"></i>
			 	<a href="/receives/{{ $receive->id }}"> {{ trans('receive.label.edit')}}</a>
		 	</li>
		 	<li class="active">{{ trans('receive.label.add_product') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('receive.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->

@endsection

@section('content')

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			{{ trans('receive.label.add_product') }}
		</div>
		<div class="panel-body">
			<form method="POST" action="/receives/add-products" enctype="multipart/form-data">
				{{ csrf_field() }}

				@include('receives.partial.add_product_form')
	            
	           <div class="row">
		           	<div class="col-md-12"> 
		      			<button type="submit" class="btn btn-success btn-sm">
		      				{{ trans('receive.buttons.create') }}
		      			</button>
		            </div>
	           </div>
			</form>
		</div>
	</div><!-- /panel -->
</div>

@endsection

@section('style')
	@parent

	<link href="/css/chosen/chosen.min.css" rel="stylesheet">
@endsection

@section('script')
	@parent

	<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
	<script>
		$(function(){
			$(".chosen-select").chosen();
		})
	</script>
@endsection