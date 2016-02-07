@extends('layouts.print')

@section('breadcrump')

	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-download"></i>
			 	<a href="/requisitions"> {{ trans('requesition.label.name')}}</a>
		 	</li>
		 	<li class="active">{{ trans('requesition.label.review') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">
				{{ trans('requesition.label.name') }} {{ $requesition->document_no }}
			</h3>
		</div>	
	</div>

@endsection

@section('content')
	
	@include('requesitions.partial.show_paper')
	@include('requesitions.partial.show_table')
	@include('requesitions.partial.show_panel')

@endsection

@section('style')
	@parent

    <link href="/css/bootstrap-editable.css" rel="stylesheet">
@endsection

@section('script')
	@parent
	
	<script type="text/javascript" src="/js/libs/form_confirm.js"></script>
    <script src="/js/bootstrap-editable.min.js"></script>
	<script>
		$(function(){
			$('#invoicePrint').click(function()	{
				window.print();
			});

			$('a#process_padding').click(function(e){
				e.preventDefault();

				$('form#process_padding').submit();

				return false;
			});

            $.fn.editableform.buttons = '<button class="btn btn-success btn-sm editable-submit" type="submit"><i class="fa fa-check"></i></button>'
                    + ' <button class="btn btn-danger btn-sm editable-cancel" type="button"><i class="fa fa-times"></i></button>';

            $('a#editable-requisition').editable({
                success: function (response, newValue) {
                    if (response.status == 'error') return response.mgs;
                    console.log(response);
                },
                error: function (response) {
                	console.log(response.responseText);
                    return response.responseText;
                }
            });

            $('a#editable-requisition-select').editable({
            	type: 'select',
                success: function (response, newValue) {
                    if (response.status == 'error') return response.mgs;
                    console.log(response);
                },
                error: function (response) {
                	console.log(response.responseText);
                    return response.responseText;
                }
            });

            $('a#editable-requisition-date').editable({
            	type: 'date',
            	format: 'yyyy-mm-dd',    
        		viewformat: 'dth M yyyy',
                success: function (response, newValue) {
                    if (response.status == 'error') return response.mgs;
                },
                error: function (response) {
                    return response.responseText;
                }
            });

			$('a#editable-qty').editable({
				success: function (response, newValue) {
					if (response.status == 'error') return response.mgs;
				},
				error: function (response) {
					return response.responseText;
				}
			});
		});
	</script>
@endsection