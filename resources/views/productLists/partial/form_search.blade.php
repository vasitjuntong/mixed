<div class="panel panel-default">
	<div class="panel-body">
		{!! Form::open([
			'method' => 'get',
			'url' => '/products',
		]) !!}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="mix_no">{{ trans('product.attributes.mix_no') }}</label>
					{!! Form::text('mix_no', array_get($filter, 'mix_no') ?: null, [
						'class' => 'form-control',
					]) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="name">{{ trans('product.attributes.name') }}</label>
					{!! Form::text('name', array_get($filter, 'name') ?: null, [
						'class' => 'form-control',
					]) !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-info btn-sm">
						<i class="fa fa-search"></i>
						{{ trans('product.buttons.search') }}
					</button>
				</div>
			</div>

		</div>

		{!! Form::close() !!}
	</div>
</div>