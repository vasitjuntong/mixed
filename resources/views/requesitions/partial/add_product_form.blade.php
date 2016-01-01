{!! Form::hidden('product_id', null, [
	'v-model' => 'product_id',
]) !!}
<div class="col-md-3">
	<div class="form-group {{ $errors->has('product_code') ? 'has-error':'' }} ">

		<label for="product_code" class="control-label">
			{{ trans('requesition_item.attributes.product_code') }}
		</label>

		{!! Form::text('product_code', null, [
			'class' => 'form-control input-sm typeahead',
			'placeholder' => trans('requesition_item.attributes.product_code'),
			'v-model' => 'product_code',
			'autocomplete' => 'off',
		]) !!}

		@if($errors->has('product_code'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('product_code') }}
			</span>
		@endif
	</div>
</div>

<div class="col-md-3">
	<div class="form-group">

		<label for="mix_no" class="control-label">
			{{ trans('product.attributes.mix_no') }}
		</label>

		{!! Form::text('mix_no', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('product.attributes.mix_no'),
			'v-model' => 'mix_no',
			'readonly' => 'readonly',
		]) !!}
	</div>
</div>

<div class="col-md-4">
	<div class="form-group">

		<label for="product_description" class="control-label">
			{{ trans('product.attributes.description') }}
		</label>

		{!! Form::text('product_description', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('product.attributes.description'),
			'v-model' => 'product_description',
			'readonly' => 'readonly',
		]) !!}
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">

		<label for="unit" class="control-label">
			{{ trans('product.attributes.unit') }}
		</label>

		{!! Form::text('unit', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('product.attributes.unit'),
			'v-model' => 'unit',
			'readonly' => 'readonly',
		]) !!}
	</div>
</div>

<div class="clearfix"></div>

<div class="col-md-2">
	<div class="form-group {{ $errors->has('qty') ? 'has-error':'' }}">

		<label for="qty" class="control-label">
			{{ trans('requesition_item.attributes.qty') }}
		</label>

		{!! Form::input('number', 'qty', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('requesition_item.attributes.qty'),
			'min' => 0
		]) !!}

		@if($errors->has('qty'))
			<span id="help-block-qty" class="help-block text-error">
				{{ $errors->first('qty') }}
			</span>
		@endif
	</div>
</div>

<div class="clearfix"></div>

<div class="col-md-12">
	<div class="form-group">

		<label for="remark" class="control-label">
			{{ trans('requesition_item.attributes.remark') }}
		</label>

		{!! Form::textarea('remark', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('requesition_item.attributes.remark'),
			'rows' => 2
		]) !!}
	</div>
</div>
