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
		 	<li class="active">{{ trans('receive.label.create') }}</li>	 
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
			New Receive
		</div>
		<div class="panel-body">
				{{ csrf_field()}}
			{!! Form::open([
				'method' 	=> 'post',
				'url' 		=> '/receives',
			]) !!}

				@include('receives.partial.form')
	            
	           <div class="row">
		           	<div class="col-md-12"> 
		      			<button type="submit" class="btn btn-success btn-sm">
		      				{{ trans('receive.buttons.create') }}
		      			</button>
		            </div>
	           </div>
			{!! Form::close() !!}
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
			$(".chosen-select").chosen({
				search_contains: true
			});
		})
	</script>
@endsection