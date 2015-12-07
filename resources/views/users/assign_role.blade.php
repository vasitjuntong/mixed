@extends('layouts.app')

@section('breadcrump')
	<div id="breadcrumb">
		<ul class="breadcrumb">
		 	<li><i class="fa fa-home"></i>
			 	<a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
		 	</li>
		 	<li><i class="fa fa-user"></i>
			 	<a href="index.html"> {{ trans('user.label.name')}}</a>
		 	</li>
		 	<li class="active">{{ trans('user.label.assign_role') }}</li>	 
		</ul>
	</div><!-- /breadcrumb-->
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">{{ trans('user.label.assign_role') }}: {{ $user->name }}</h3>
		</div><!-- /page-title -->			
	</div><!-- /main-header -->
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
	   <form action="/users/assign-role/{{ $user->id }}" method="POST" class="form-horizontal" role="form">
			{{ csrf_field() }}

			<div class="form-group">
				<label class="col-lg-2 control-label">{{ trans('user.label.assign_role') }}</label>
				<div class="col-lg-10">
					@foreach($roles as $role)
						<label class="label-checkbox">
							<input 
								name="roles[]" 
								type="checkbox" 
								value="{{ $role->id }}"
								{{ in_array($role->id, $userRoles->toArray())?'checked':'' }}>
							<span class="custom-checkbox"></span>
							{{ $role->label }}
						</label>	
					@endforeach
				</div><!-- /.col -->
			</div>

			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary btn-sm">
						{{ trans('user.buttons.assign_role') }}
					</button>
				</div>
			</div>
		</form>
	</div>
</div>	

<div id="modal-content"></div>

@endsection

@section('script')
	@parent

@endsection