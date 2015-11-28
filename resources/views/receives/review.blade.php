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

    <a class="btn btn-success hidden-print" id="invoicePrint"><i class="fa fa-print"></i> Print</a>

@endsection

@section('style')
	@parent

	<link href="/css/chosen/chosen.min.css" rel="stylesheet">
@endsection

@section('script')
	@parent
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.min.js"></script>
	<script type="text/javascript" src="/js/typeahead.min.js"></script>
	<script type="text/javascript" src="/js/libs/vue_addproduct.js"></script>
	<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
	<script>
		$(function(){
			$(".chosen-select").chosen({
				search_contians: true
			});
			$('#invoicePrint').click(function()	{
				window.print();
			});
		});
	</script>
@endsection