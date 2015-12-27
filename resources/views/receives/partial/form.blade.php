<div class="row">

	<div class="col-sm-12 col-md-12">
		<div id="po_no" class="form-group {{ $errors->has('po_no') ? 'has-error':'' }} ">
			<label for="po_no" class="control-label">
				{{ trans('receive.attributes.po_no') }}
			</label>

			{!! Form::text('po_no', null, [
				'class' => 'form-control input-sm',
				'placeholder' => trans('receive.attributes.po_no'),
			]) !!}
			
			@if($errors->has('po_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('po_no') }}
				</span>
			@endif
		</div>
	</div>

	<div class="col-sm-12 col-md-12">
		<div id="ref_no" class="form-group {{ $errors->has('ref_no') ? 'has-error':'' }} ">
			<label for="ref_no" class="control-label">
				{{ trans('receive.attributes.ref_no') }}
			</label>

			{!! Form::text('ref_no', null, [
				'class' => 'form-control input-sm',
				'placeholder' => trans('receive.attributes.ref_no'),
			]) !!}

			@if($errors->has('ref_no'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('ref_no') }}
				</span>
			@endif
		</div>
	</div>

	<div class="col-sm-12 col-md-12">
		<div id="project_id" class="form-group {{ $errors->has('project_id') ? 'has-error':'' }} ">
			<label for="project_id" class="control-label">
				{{ trans('receive.attributes.project_id') }}
			</label>

			{!! Form::select('project_id', $projects, null, [
				'class' => 'form-control chosen-select',
				'placeholder' => trans('receive.attributes.project_id'),
			]) !!}

			@if($errors->has('project_id'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('project_id') }}
				</span>
			@endif
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-sm-12 col-md-12">
		<div id="remark" class="form-group {{ $errors->has('remark') ? 'has-error':'' }} ">
			<label for="remark" class="control-label">
				{{ trans('receive.attributes.remark') }}
			</label>

			{!! Form::textarea('remark', null, [
				'class' => 'form-control input-sm',
				'placeholder' => trans('receive.attributes.remark'),
				'rows' => 2
			]) !!}

			@if($errors->has('remark'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('remark') }}
				</span>
			@endif
		</div>
	</div>	
</div>