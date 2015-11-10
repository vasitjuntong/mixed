@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-home"></i>
			 	<a href="/units"> {{ trans('unit.label.name')}}</a>
		 	</li>
		 	<li class="active">{{ trans('main.button.update') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('unit.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-offset-3 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('main.button.update') }}{{ trans('unit.label.name') }}
				</div>
				<div class="panel-body">
					<form method="POST" action="/units/{{ $unit->id }}">

						{{ method_field('PATCH') }}

						@include('units.partial.form')

						<button type="submit" class="btn btn-success btn-sm">
							{{ trans('main.button.update') }}
						</button>
					</form>
				</div>
			</div><!-- /panel -->
		</div>
	</div>
@endsection