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
	<div class="panel-body text-right">
	   <a 
	   		id="create"
	   		href="/receives/create" 
	   		class="btn btn-warning btn-sm">

	   		<span class="fa fa-plus"></span>
	   		{{ trans('receive.label.new_receive') }}
	   </a>
	   <a href="/receives/movement" class="btn btn-success btn-sm">
	   		<span class="fa fa-clock-o"></span>
	   		{{ trans('receive.label.movement') }}
	   </a>
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">

  		@include('receives.partial.table')

		<span class="text-center block">{!! $receives->render() !!}</span>
  	</div>
</div>

<div id="modal_content"></div>

@endsection

@section('style')
	@parent
	<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">
	<link rel="stylesheet" href="/css/jquery.dataTables_themeroller.css">
@endsection

@section('script')
	@parent
	<script src="/js/jquery.dataTables.min.js"></script>	
	
	<script>
		$(function(){
			$('a#create').click(function(e){
				e.preventDefault();
				
				var that = $(this);
				var modal_content = $('div#modal_content');

				$.ajax({
					type: 'get',
					url: that.attr('href'),
					success: function(result){
						modal_content.html(result);
						$('#modal-create').modal('show');
					}
				});

				return false;
			});

			$('#dataTables').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
			});
		});
	</script>

@endsection