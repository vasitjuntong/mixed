@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('product_type.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('product_type.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('product_type.label.create') }}{{ trans('product_type.label.name') }}
	</div>
	<div class="panel-body">
		<form method="POST" action="/product-types">

			@include('productTypes.partial.form')

			<button 
				type="submit" 
				class="btn btn-success btn-sm">

				{{ trans('main.button.create') }}
			</button>

		</form>
	</div>
</div><!-- /panel -->
<div class="panel panel-default">
	<div class="panel-body">
		@include('productTypes.partial.table')
	</div>
</div>

@endsection

@section('script')
	@parent

	<script type="text/javascript">
		$(function(){
			$('table form').submit(function(e){

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
							$.ajax({
								type: that.attr('method'),
								url: that.attr('action'),
								data: that.serialize(),

								success:function(data){
									if(data.status){
										// swal(data.title, data.message, "success");

										swal({   
											title: data.title,   
											text: data.message,
											type: "success",   
											timer: 3000,   
											showConfirmButton: false 
										});

										setTimeout(function(){
											location.reload();
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
								timer: 3000,   
								showConfirmButton: false 
							});

							setTimeout(function(){
								location.reload();
							}, 2000);
						} 
					});
				e.preventDefault();
			});
        }); 

	</script>
@endsection