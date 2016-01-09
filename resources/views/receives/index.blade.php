@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
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
	   <a href="{{ $urlDownloadExcel }}" class="btn btn-success btn-sm">
	   		<span class="fa fa-download"></span>
	   		{{ trans('receive.buttons.excel') }}
	   </a>
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">
  		@include('receives.partial.table')
  	</div>
</div>

<div id="modal_content"></div>

@endsection

@section('style')
	@parent
	<link rel="stylesheet" href="/css/jquery.dataTables_themeroller.css">
@endsection

@section('script')
	@parent
	<script src="/js/jquery.dataTables.min.js"></script>	
	
	<script>
		$(function(){
			$('a#create').click(function(e){
				e.preventDefault();
				
				var button = $(this);
				var buttonOldLabel = button.html();
				var modal_content = $('div#modal_content');

                button.attr('disabled', 'disabled');
                button.html('<i class="fa fa-spinner fa-spin"></i> Loading...');

				$.ajax({
					type: 'get',
					url: button.attr('href'),
					success: function(result){
						modal_content.html(result);
						$('#modal-create').modal('show');

                        button.removeAttr('disabled');
                        button.html(buttonOldLabel);
					},
                    error: function(response){
                        console.log(response);
                        
                        button.removeAttr('disabled');
                        button.html(buttonOldLabel);
                    }
				});

				return false;
			});

			$('#dataTables').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
                "order": [[ 0, "desc" ]],
                "aoColumns": [
                    { "sType": "date" },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ]
			});
		});
	</script>
@endsection