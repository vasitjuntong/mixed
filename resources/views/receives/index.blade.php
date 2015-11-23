@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('receive.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('receive.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
	   <a href="/receives/create" class="btn btn-info btn-sm">
	   		<span class="fa fa-plus"></span>
	   		{{ trans('receive.buttons.create') }}
	   </a>
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">

  		@include('receives.partial.table')

		<span class="text-center block">{!! $receives->render() !!}</span>
  	</div>
</div>

@endsection