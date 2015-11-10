{{ csrf_field() }}

<div class="form-group {{ $errors->has('code') ? 'has-error':'' }} ">
	<label for="name" class="control-label">
		{{ trans('project.attributes.code') }}
	</label>
	<input 
		type="text"
		name="code"
		class="form-control input-sm" 
		placeholder="{{ trans('project.attributes.code') }}"
		value="{{ old('code') ? old('code') : ((isset($project) && $project != null) ? $project->code : '')  }}" 
		autofocus>
		@if($errors->has('code'))
			<span id="helpBlock2" class="help-block text-error">
				{{ $errors->first('code') }}
			</span>
		@endif
</div>