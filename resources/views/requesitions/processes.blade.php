@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
			<li><i class="fa"></i>
				<a href="/requisitions/{{ $requesition->id }}"> Requisition</a>
			</li>
		 	<li class="active">Process</li>
		</ul>
	</div>
@endsection

@section('content')

<div class="panel panel-default table-responsive">
  	<div class="panel-body">
	  	<div class="row">
	  		<dl class="col-sm-offset-3 col-sm-3 col-md-offset-3 col-md-3">
			  	<dt>{{ trans('requesition.attributes.created_at') }}</dt>
			  	<dd>{{ $requesition->created_at->format('d/m/Y H:i') }}</dd>
			  	<dt>{{ trans('requesition.attributes.document_no') }}</dt>
			  	<dd>{{ $requesition->document_no ?: '-' }}</dd>
			  	<dt>{{ trans('requesition.attributes.site_id') }}</dt>
			  	<dd>{{ $requesition->site_id ?: '-' }}</dd>
			  	<dt>{{ trans('requesition.attributes.site_name') }}</dt>
			  	<dd>{{ $requesition->site_name ?: '-' }}</dd>
			</dl>
	  		<dl class="col-sm-3 col-md-3">
			  	<dt>{{ trans('requesition.attributes.status') }}</dt>
			  	<dd>{!! $requesition->statusHtml() !!}</dd>
			  	<dt>{{ trans('requesition.attributes.create_by') }}</dt>
			  	<dd>{{ $requesition->create_by ?: '-' }}</dd>
			  	<dt>{{ trans('requesition.attributes.remark') }}</dt>
			  	<dd>{{ $requesition->remark ?: '-' }}</dd>
			</dl>
	  	</div>
  	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
	   	<a 	href="/requisitions/process-success/{{ $requesition->id }}"
	   		class="btn btn-success btn-sm"  
	   		id="chk_all"
	   		data-title-confirm="{{ trans('requesition.label.name') }}"
	   		data-message-confirm="{{ trans('requesition.message_alert.success_confirm') }}"
	   		data-message-cancel="{{ trans('requesition.message_alert.success_confirm_cancel') }}"
	   		data-confirm-ok="{{ trans('main.confirm_button.ok') }}"
	   		data-confirm-cancel="{{ trans('main.confirm_button.cancel') }}">
	   		{{ trans('requesition.buttons.success_status') }}
   		</a>
	   	<a 	href="/requisitions/process-cancel/{{ $requesition->id }}"
	   		class="btn btn-danger btn-sm" 
	   		id="chk_all"
	   		data-title-confirm="{{ trans('requesition.label.name') }}"
	   		data-message-confirm="{{ trans('requesition.message_alert.cancel_confirm') }}"
	   		data-message-cancel="{{ trans('requesition.message_alert.cancel_confirm_cancel') }}"
	   		data-confirm-ok="{{ trans('main.confirm_button.ok') }}"
	   		data-confirm-cancel="{{ trans('main.confirm_button.cancel') }}">
	   		{{ trans('requesition.buttons.cancel_status') }}
   		</a>
	</div>
</div>

@include('requesitions.partial.processes_table')

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

						$.ajaxSetup({
					        headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        }
						});

						$.ajax({
							type: 'post',
							url: that.attr('href'),
							data: {requesition_item_ids: values},

							success:function(data){
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