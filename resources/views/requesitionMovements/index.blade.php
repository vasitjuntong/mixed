@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home') }}</a>
		 	</li>
		 	<li><i class="fa fa-download"></i>
			 	<a href="/requisitions"> {{ trans('requesition.label.name') }}</a>
		 	</li>
		 	<li class="active">{{ trans('requesition.label.movement') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('requesition.label.movement') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
	   @include('requesitionMovements.partial.form_search')
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">
  		@include('requesitionMovements.partial.table')
  	</div>
</div>

<div id="modal_content"></div>

@endsection

@section('style')
	@parent
	
	<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">
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