<div class="col-md-4">
	<div class="form-group {{ $errors->has('product_id') ? 'has-error':'' }} ">

		<label for="product_id" class="control-label">
			{{ trans('receive_item.attributes.product_id') }}
		</label>

		{!! Form::text('product_id', null, [
			'class' => 'form-control input-sm typeahead',
			'placeholder' => trans('receive_item.attributes.product_id'),
			'v-model' => 'product_id',
			'autocomplete' => 'off',
		]) !!}

		@if($errors->has('product_id'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('product_id') }}
			</span>
		@endif
	</div>
</div>
<div class="col-md-2">
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

		<label for="description" class="control-label">
			{{ trans('product.attributes.description') }}
		</label>

		{!! Form::text('description', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('product.attributes.description'),
			'v-model' => 'description',
			'readonly' => 'readonly',
		]) !!}
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">

		<label for="qty" class="control-label">
			{{ trans('receive_item.attributes.qty') }}
		</label>

		{!! Form::input('number', 'qty', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('receive_item.attributes.qty'),
			'min' => 0
		]) !!}
	</div>
</div>

<div class="col-md-12">
	<div class="form-group {{ $errors->has('location_id') ? 'has-error':'' }} ">

		<label for="location_id" class="control-label">
			{{ trans('receive_item.attributes.location_name') }}
		</label>

		{!! Form::select('location_id', $locationLists, null, [
			'class' => 'form-control',
		]) !!}

		@if($errors->has('location_id'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('location_id') }}
			</span>
		@endif
	</div>
</div>

<div class="col-md-12">
	<div class="form-group">

		<label for="remark" class="control-label">
			{{ trans('receive_item.attributes.remark') }}
		</label>

		{!! Form::textarea('remark', null, [
			'class' => 'form-control input-sm',
			'placeholder' => trans('receive_item.attributes.remark'),
			'rows' => 2
		]) !!}
	</div>
</div>