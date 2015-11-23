<div class="form-group {{ $errors->has('product_id') ? 'has-error':'' }} ">

	<label for="product_id" class="control-label">
		{{ trans('receive_item.attributes.product_id') }}
	</label>

	<input 
		type="text"
		name="product_id"
		class="form-control input-sm" 
		placeholder="{{ trans('receive_item.attributes.product_id') }}" >

	@if($errors->has('product_id'))
		<span id="helpBlock2" class="help-block text-error">
			{{ $errors->first('product_id') }}
		</span>
	@endif
</div>