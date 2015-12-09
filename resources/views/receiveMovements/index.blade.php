@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home') }}</a>
		 	</li>
		 	<li><i class="fa fa-download"></i>
			 	<a href="/receives"> {{ trans('receive.label.name') }}</a>
		 	</li>
		 	<li class="active">{{ trans('receive.label.movement') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('receive.label.movement') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
	   @include('receiveMovements.partial.form_search')
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">

  		@include('receiveMovements.partial.table')

		<span class="text-center block">{!! $receiveItems->appends($filter)->render() !!}</span>
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

			$('#datetimepicker-start').datetimepicker({
                format: 'DD/MM/YYYY'
            });
			$('#datetimepicker-end').datetimepicker({
                format: 'DD/MM/YYYY'
            });
		});
	</script>

@endsection