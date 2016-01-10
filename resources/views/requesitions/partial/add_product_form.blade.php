{!! Form::hidden('product_id', null, [
	'ng-model' => 'formData.product_id',
]) !!}
<div class="col-md-3">
	<div ng-class="{'has-error': formErrors.product_code}" class="form-group">

		<label for="product_code" class="control-label">
			{{ trans('requesition_item.attributes.product_code') }}
		</label>

		{!! Form::text('product_code', null, [
			'class' => 'form-control input-sm typeahead',
			'placeholder' => trans('requesition_item.attributes.product_code'),
			'ng-model' => 'formData.product_code',
			'ng-change' => 'checkProduct(formData.product_code)',
			'autocomplete' => 'off',
		]) !!}

		<span ng-show="formErrors.product_code"
			ng-repeat="errorMessage in formErrors.product_code" 
			id="helpBlock2" 
			class="help-block text-error">
			@{{ errorMessage }}
		</span>
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
			'ng-model' => 'formData.mix_no',
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
			'ng-model' => 'formData.product_description',
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
			'ng-model' => 'formData.unit',
			'readonly' => 'readonly',
		]) !!}
	</div>
</div>

<div class="clearfix"></div>

<div class="col-md-3">
	<div ng-class="{'has-error': formErrors.qty}" class="form-group">

		<label for="qty" class="control-label">
			{{ trans('requesition_item.attributes.qty') }}
		</label>
		<div class="input-group">
			{!! Form::input('number', 'qty', null, [
				'ng-model' => 'formData.qty',
				'class' => 'form-control input-sm',
				'placeholder' => trans('requesition_item.attributes.qty'),
				'min' => 0
			]) !!}
			<div class="input-group-addon">
				Stock: @{{ formData.stock }}
			</div>
		</div>
		<span ng-show="formErrors.qty"
			ng-repeat="errorMessage in formErrors.qty" 
			id="helpBlock2" 
			class="help-block text-error">
			@{{ errorMessage }}
		</span>
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
