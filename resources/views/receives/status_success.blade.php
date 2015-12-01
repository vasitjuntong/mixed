@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('receive.label.status_success') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('receive.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default table-responsive">
  	<div class="panel-body">
	  	<div class="row">
	  		<dl class="col-md-offset-3 col-md-3">
			  	<dt>{{ trans('receive.attributes.created_at') }}</dt>
			  	<dd>{{ $receive->created_at->format('d/m/Y H:i') }}</dd>
			  	<dt>{{ trans('receive.attributes.document_no') }}</dt>
			  	<dd>{{ $receive->document_no ?: '-' }}</dd>
			  	<dt>{{ trans('receive.attributes.po_no') }}</dt>
			  	<dd>{{ $receive->po_no ?: '-' }}</dd>
			  	<dt>{{ trans('receive.attributes.ref_no') }}</dt>
			  	<dd>{{ $receive->ref_no ?: '-' }}</dd>
			</dl>
	  		<dl class="col-md-3">
			  	<dt>{{ trans('receive.attributes.status') }}</dt>
			  	<dd>{!! $receive->statusHtml() !!}</dd>
			  	<dt>{{ trans('receive.attributes.create_by') }}</dt>
			  	<dd>{{ $receive->create_by ?: '-' }}</dd>
			  	<dt>{{ trans('receive.attributes.remark') }}</dt>
			  	<dd>{{ $receive->remark ?: '-' }}</dd>
			</dl>
	  	</div>
  	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
	   	<a 	href="/receives/status-success/{{ $receive->id }}"
	   		class="btn btn-info" 
	   		id="chk_all"
	   		data-title-confirm="{{ trans('receive.label.name') }}"
	   		data-message-confirm="{{ trans('receive.message_alert.success_confirm') }}"
	   		data-confirm-ok="{{ trans('main.confirm_button.ok') }}"
	   		data-confirm-cancel="{{ trans('main.confirm_button.cancel') }}"
	   		data-message-cancel="{{ trans('receive.message_alert.success_confirm_cancel') }}">
	   		{{ trans('receive.buttons.confirm_receive') }}
   		</a>
	</div>
</div>

@include('receives.partial.success_table')

@endsection

@section('script')
	@parent

	<script>
		$(function(){
			$("input[id=chk_all]").change(function(){
				if($("input[id=chk_all]").is(':checked')){
					$.each($("input[name='products[]']"), function() {
						$(this).prop('checked', true);
					});
				}else{
					$.each($("input[name='products[]']"), function() {
						$(this).prop('checked', false);
					});
				}
			});

			$('a#chk_all').click(function(e){
				e.preventDefault();

				var that = $(this);

				swal({   
				title: that.attr('data-title-confirm'),   
				text: that.attr('data-message-confirm'),   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: that.attr('data-confirm-ok'),   
				cancelButtonText: that.attr('data-confirm-cancel'),   
				closeOnConfirm: false,   
				closeOnCancel: false }, 
				function(isConfirm){   
					if (isConfirm) {

						var values = new Array();
						$.each($("input[name='products[]']:checked"), function() {
						  values.push($(this).val());
						});

						console.log(that.attr('href'));
						$.ajaxSetup({
					        headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        }
						});

						$.ajax({
							type: 'post',
							url: that.attr('href'),
							data: {receive_item_ids: values},

							success:function(data){
								console.log(data); 
								if(data.status){
									swal({   
										title: data.title,   
										text: data.message,
										type: "success",   
										timer: 3000,   
										showConfirmButton: false 
									});

									setTimeout(function(){
										window.location = data.url;
									}, 2000);
								}else{
									swal({   
										title: data.title,   
										text: data.message,
										type: "error",   
										timer: 3000,   
										showConfirmButton: false 
									});
								}
							}
						});
					} else {     
						swal({   
							title: that.attr('data-title-confirm'),   
							text: that.attr('data-message-cancel'),
							type: "error",   
							timer: 2000,   
							showConfirmButton: false 
						});
					} 
				});
			});
		});
	</script>
@endsection