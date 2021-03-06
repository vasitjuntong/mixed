{!! Form::open([
	'method' => 'get',
	'url' => '/products',
]) !!}
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="mix_no">{{ trans('product.attributes.mix_no') }}</label>
			{!! Form::text('mix_no', array_get($filter, 'mix_no') ?: null, [
				'class' => 'form-control input-sm',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="code">{{ trans('product.attributes.code') }}</label>
			{!! Form::text('code', array_get($filter, 'code') ?: null, [
				'class' => 'form-control input-sm',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="description">{{ trans('product.attributes.description') }}</label>
			{!! Form::text('description', array_get($filter, 'description') ?: null, [
				'class' => 'form-control input-sm',
			]) !!}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="unit">{{ trans('product.attributes.unit') }}</label>
			{!! Form::text('unit', array_get($filter, 'unit') ?: null, [
				'class' => 'form-control input-sm',
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