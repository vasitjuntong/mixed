@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('project.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('project.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('project.label.create') }}{{ trans('project.label.name') }}
	</div>
	<div class="panel-body">
		<form method="POST" action="/projects">

			@include('projects.partial.form')

			<button 
				type="submit" 
				class="btn btn-success btn-sm">
				<i class="fa fa-plus"></i>
				{{ trans('main.button.create') }}
			</button>

		</form>
	</div>
</div><!-- /panel -->
<div class="panel panel-default table-responsive">
	<div class="panel-body">
		@include('projects.partial.table')
		<span class="text-center block">{!! $projects->render() !!}</span>
	</div>
</div>

@endsection

@section('script')
	@parent

	<script type="text/javascript" src="/js/libs/form_confirm_delete.js"></script>
@endsection