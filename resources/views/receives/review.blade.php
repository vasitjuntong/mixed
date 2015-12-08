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
	<div class="panel panel-default">
		<div class="panel-body hidden-print">
		  	<div class="btn-group" role="group" aria-label="...">
				<a class="btn btn-warning btn-sm" href="/receives">
					<i class="fa fa-chevron-left"></i>
					{{ trans('receive.buttons.back_to_receive') }}
				</a>
			</div>
			<div class="btn-group pull-right" role="group" aria-label="...">
				<a class="btn btn-success btn-sm" id="invoicePrint">
	    			<i class="fa fa-print"></i> Print
				</a>
				<div class="btn-group">
				  	<button type="button" 
				  		class="btn btn-default btn-sm dropdown-toggle" 
			  			data-toggle="dropdown" 
			  			aria-haspopup="true" 
			  			aria-expanded="false">
					    Action <span class="caret"></span>
				  	</button>
				  	<ul class="dropdown-menu">
				    	<li>
				    		<a href="/receives/{{ $receive->id }}/edit">
				    			<i class="fa fa-edit"></i>
				    			{{ trans('receive.buttons.update') }}
			    			</a>
			    		</li>
				  		@if($receive->status == \App\Receive::PADDING)
				  			<li class="divider"></li>
					    	<li>
					    		<a href="/receives/status-success/{{ $receive->id }}">
					    			<i class="fa fa-flag fa-lg"></i>
					    			{{ trans('receive.buttons.process_success') }}
				    			</a>
				    		</li>
				    	@endif

				    	@if($receive->status == \App\Receive::CREATE)
				  			<li class="divider"></li>
					    	<li>
							   	{!! Form::open([
							   		'id' => 'process_padding',
							   		'method' => 'post',
							   		'url' => "/receives/status-padding/{$receive->id}",
							   		'class' => 'form-confirm',
							   		'data-title-confirm' => trans('receive.message_alert.review_confirm'),
							   		'data-message-cancel' => trans('receive.message_alert.review_cancel'),
							   		'data-confirm-ok' => trans('main.confirm_button.ok'),
							   		'data-confirm-cancel' => trans('main.confirm_button.cancel')
							   	]) !!}

						   		<a href id="process_padding">
						   			<i class="fa fa-flag fa-lg"></i> 
						   			{{ trans('receive.buttons.process_padding') }}</a>

							   	{!! Form::close() !!}
				    		</li>
				    	@endif
				  	</ul>
				</div>

				@if($receive->status == \App\Receive::CREATE)
		    		<a class="btn btn-info btn-sm" href="/receives/add-products/{{ $receive->id }}">
		    			<i class="fa fa-plus"></i> {{ trans('receive.buttons.add_product') }}
					</a>
				@endif
			</div>
		</div>
	</div>
</div>

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
	<script type="text/javascript" src="/js/libs/form_confirm.js"></script>
	<script>
		$(function(){
			$(".chosen-select").chosen({
				search_contians: true
			});
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