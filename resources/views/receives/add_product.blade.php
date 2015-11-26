@extends('layouts.app')

@section('breadcrump')

	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-download"></i>
			 	<a href="/receives"> {{ trans('receive.label.name')}}</a>
		 	</li>
		 	<li><i class="fa fa-edit"></i>
			 	<a href="/receives/{{ $receive->id }}/edit"> {{ trans('receive.label.update')}}</a>
		 	</li>
		 	<li class="active">{{ trans('receive_item.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">
				{{ trans('receive.label.name') }} {{ $receive->document_no }}
			</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->

@endsection

@section('content')

<div class="row">
	<div class="col-md-12" id="app">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('receive.label.add_product') }}
			</div>
			<div class="panel-body">

				{!! Form::open([
					'method' => 'POST',
					'url' => "/receives/add-products/{$receive->id}",
				]) !!}

					<div class="row">
						@include('receives.partial.add_product_form')
					</div>
		            
		           <div class="row">
			           	<div class="col-md-12"> 
			      			<button type="submit" class="btn btn-success btn-sm">
			      				{{ trans('receive.buttons.create') }}
			      			</button>
			            </div>
		           </div>
				{!! Form::close() !!}
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
			   @include('receives.partial.product_table')
			</div>
		</div>
	</div>
</div>

@endsection

@section('style')
	@parent

	<link href="/css/chosen/chosen.min.css" rel="stylesheet">
@endsection

@section('script')
	@parent
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.min.js"></script>
	<script type="text/javascript" src="/js/typeahead.min.js"></script>
	<script type="text/javascript" src="/js/libs/vue_addproduct.js"></script>
	<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
	<script>
		$(function(){
			$(".chosen-select").chosen();
		})
	</script>
@endsection