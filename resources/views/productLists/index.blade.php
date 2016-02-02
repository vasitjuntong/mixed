@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('product_list.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<span>In Stock</span><span class="badge badge-success">0</span>
				<span>Stock Minimum</span><span class="badge badge-warning">0</span>
				<span>Out of Stock</span><span class="badge badge-danger">0</span>
			</div>
			<div class="col-md-6 text-right">
				<a href="/product-lists/movement"
					class="btn btn-success btn-sm">
					Movement All
				</a>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default table-responsive">
  	<div class="panel-body">
		@include('productLists.partial.table')
  	</div>
</div>
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
			$('#dataTables').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"oSearch": {"sSearch": '{{ request()->get('search') }}'},
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