@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="/"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li class="active">{{ trans('user.label.name') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('user.label.name') }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

@include('users.partial.form_search')

<div class="panel panel-default">
	<div class="panel-body">
	   	<a 
	   		id="create"
	   		class="btn btn-info btn-sm"
	   		href="/users/create">
	   		<i class="fa fa-user-plus"></i>
	   		Create
   		</a>
	</div>
</div>

<div class="panel panel-default table-responsive">
	<div class="panel-body">
		@include('users.partial.table')
		<span class="text-center block">{!! $users->appends($filter)->render() !!}</span>
	</div>
</div>

<div id="modal-content"></div>

@endsection

@section('script')
	@parent

	<script>
		$(function(){
			$('a#create').click(function(e){
				e.preventDefault();

				var that = $(this);

				$.ajax({
					type: 'get',
					url: that.attr('href'),
					success: function(data){
						$('div#modal-content').html(data);
						$('#modal-create').modal('show');
					}
				});

				return false;
			});
		});
	</script>
@endsection