{{ csrf_field() }}

<div class="form-group {{ $errors->has('name') ? 'has-error':'' }} ">
	<label for="name" class="control-label">
		{{ trans('location.attributes.name') }}
	</label>
	<input 
		type="text"
		name="name"
		class="form-control input-sm" 
		placeholder="{{ trans('location.attributes.name') }}"
		value="{{ old('name') ? old('name') : ((isset($location) && $location != null) ? $location->name : '')  }}" 
		autofocus>
		@if($errors->has('name'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('name') }}
			</span>
		@endif
</div>