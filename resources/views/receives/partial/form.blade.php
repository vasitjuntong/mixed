<div class="row">
	<div class="col-md-2">
		<div class="form-group {{ $errors->has('document_no') ? 'has-error':'' }} ">
			<label for="document_no" class="control-label">
				{{ trans('receive.attributes.document_no') }}
			</label>
			<input 
				type="text"
				name="document_no"
				class="form-control input-sm" 
				placeholder="{{ trans('receive.attributes.document_no') }}"
				value="{{ old('document_no') ? old('document_no') : ((isset($receive) && $receive != null) ? $receive->document_no : '')  }}">
			@if($errors->has('document_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('document_no') }}
				</span>
			@endif
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group {{ $errors->has('po_no') ? 'has-error':'' }} ">
			<label for="po_no" class="control-label">
				{{ trans('receive.attributes.po_no') }}
			</label>
			<input 
				type="text"
				name="po_no"
				class="form-control input-sm" 
				placeholder="{{ trans('receive.attributes.po_no') }}" 
				value="{{ old('po_no') ? old('po_no') : ((isset($receive) && $receive != null) ? $receive->po_no : '')  }}">
			@if($errors->has('po_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('po_no') }}
				</span>
			@endif
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group {{ $errors->has('ref_no') ? 'has-error':'' }} ">
			<label for="ref_no" class="control-label">
				{{ trans('receive.attributes.ref_no') }}
			</label>
			<input 
				type="text"
				name="ref_no"
				class="form-control input-sm" 
				placeholder="{{ trans('receive.attributes.ref_no') }}" 
				value="{{ old('ref_no') ? old('ref_no') : ((isset($receive) && $receive != null) ? $receive->ref_no : '')  }}">
			@if($errors->has('ref_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('ref_no') }}
				</span>
			@endif
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group {{ $errors->has('project_id') ? 'has-error':'' }} ">
			<label for="project_id" class="control-label">
				{{ trans('receive.attributes.project_id') }}
			</label>
			<select class="form-control chosen-select" name="project_id">

				<option value="">
					{{ trans('main.label.select') }}
				</option>

				@foreach($projects as $id => $code)
					<option 
						value="{{ $id }}"
						{{ old('project_id') == $id? 'selected': 
							(isset($product) AND $product->project_id == $id)? 'selected':'' }}
						>{{ $code }}</option>
				@endforeach
			</select>

			@if($errors->has('project_id'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('project_id') }}
				</span>
			@endif
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="form-group {{ $errors->has('remark') ? 'has-error':'' }} ">
			<label for="remark" class="control-label">
				{{ trans('receive.attributes.remark') }}
			</label>
			<textarea
				type="text"
				name="remark"
				class="form-control input-sm" 
				placeholder="{{ trans('receive.attributes.remark') }}">{{ old('remark') ? old('remark') : ((isset($receive) && $receive != null) ? $receive->remark : '')  }}</textarea> 
			@if($errors->has('remark'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('remark') }}
				</span>
			@endif
		</div>
	</div>	
</div>