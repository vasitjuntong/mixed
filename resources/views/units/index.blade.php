@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('unit.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('unit.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

@can('create_form')
<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('unit.label.create') }}{{ trans('unit.label.name') }}
	</div>
	<div class="panel-body">
		<form method="POST" action="/units">

			@include('units.partial.form')

			<button 
				type="submit" 
				class="btn btn-success btn-sm">
				<i class="fa fa-plus"></i>
				{{ trans('main.button.create') }}
			</button>

		</form>
	</div>
</div><!-- /panel -->
@endcan

<div class="panel panel-default table-responsive">
	<div class="panel-body">
		@include('units.partial.table')
		<span class="text-center block">{!! $units->render() !!}</span>
	</div>
</div>

@endsection

@section('script')
	@parent

	<script type="text/javascript" src="/js/libs/form_confirm_delete.js"></script>
@endsection