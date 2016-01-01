@extends('layouts.print')

@section('breadcrump')

	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-download"></i>
			 	<a href="/receives"> {{ trans('receive.label.name')}}</a>
		 	</li>
		 	<li class="active">{{ trans('receive.label.review') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">
				{{ trans('receive.label.name') }} {{ $receive->document_no }}
			</h3>
		</div>	
	</div>

@endsection

@section('content')

	@include('receives.partial.review_paper')
	@include('receives.partial.review_table')
	@include('receives.partial.review_panel')

@endsection

@section('script')
	@parent

	<script type="text/javascript" src="/js/libs/form_confirm.js"></script>
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
		});
	</script>
@endsection