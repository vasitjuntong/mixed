@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('movement_all.label.name') }}</li>	 
		</ul>
	</div>
@endsection

@section('content')

	@include('movementAll.partial.form_search')
	@include('movementAll.partial.table')

@endsection

@section('script')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="/js/bootstrap-datetimepicker.js"></script>

	<script>
		$(function(){
			$('#datetimepicker-start').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#datetimepicker-end').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		});
	</script>

@endsection