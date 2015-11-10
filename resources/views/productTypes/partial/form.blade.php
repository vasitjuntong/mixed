{{ csrf_field() }}

<div class="form-group {{ $errors->has('name') ? 'has-error':'' }} ">
	<label for="name" class="control-label">
		{{ trans('product_type.attributes.name') }}
	</label>
	<input 
		type="text"
		name="name"
		class="form-control input-sm" 
		placeholder="{{ trans('product_type.attributes.name') }}"
		value="{{ old('name') ? old('name') : ((isset($productType) && $productType != null) ? $productType->name : '')  }}" 
		autofocus>
		@if($errors->has('name'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('name') }}
			</span>
		@endif
</div>

<div class="form-group {{ $errors->has('code_prefix') ? 'has-error':'' }} ">
	<label for="code_prefix" class="control-label">
		{{ trans('product_type.attributes.code_prefix') }}
	</label>

	<input 
		type="text"
		name="code_prefix"
		class="form-control input-sm" 
		placeholder="{{ trans('product_type.attributes.code_prefix') }}"
		value="{{ old('code_prefix') ? old('code_prefix') : ((isset($productType) && $productType != null) ? $productType->code_prefix : '')  }}" 
		autofocus>
		@if($errors->has('code_prefix'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('code_prefix') }}
			</span>
		@endif
</div>

<div class="form-group {{ $errors->has('code_default') ? 'has-error':'' }} ">
	<label for="code_default" class="control-label">
		{{ trans('product_type.attributes.code_default') }}
	</label>

	<input 
		type="text"
		name="code_default"
		class="form-control input-sm" 
		placeholder="{{ trans('product_type.attributes.code_default') }}"
		value="{{ old('code_default') ? old('code_default') : 
					((isset($productType) && $productType != null) ? $productType->code_default : '')  }}" 
		autofocus>
		@if($errors->has('code_default'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('code_default') }}
			</span>
		@endif
</div>