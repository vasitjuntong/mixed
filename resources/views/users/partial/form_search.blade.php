<div class="panel panel-default">
	<div class="panel-body">
		{!! Form::open([
			'method' => 'get',
			'url' => '/users',
		]) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="name">{{ trans('user.attributes.name') }}</label>
					{!! Form::text('name', array_get($filter, 'name') ?: null, [
						'class' => 'form-control',
					]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="email">{{ trans('user.attributes.email') }}</label>
					{!! Form::text('email', array_get($filter, 'email') ?: null, [
						'class' => 'form-control',
					]) !!}
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-info btn-sm">
						<i class="fa fa-search"></i>
						{{ trans('user.buttons.search') }}
					</button>
				</div>
			</div>

		</div>

		{!! Form::close() !!}
	</div>
</div>