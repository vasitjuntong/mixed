{!! Form::open([
	'method' => 'get',
	'url' => '/requisition-movement',
]) !!}
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="document_no">{{ trans('requesition.form_search.document_no') }}</label>
			{!! Form::text('document_no', array_get($filter, 'document_no') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="site_id">{{ trans('requesition.form_search.site_id') }}</label>
			{!! Form::text('site_id', array_get($filter, 'site_id') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="site_name">{{ trans('requesition.form_search.site_name') }}</label>
			{!! Form::text('site_name', array_get($filter, 'site_name') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="project">{{ trans('requesition.form_search.project') }}</label>
			{!! Form::text('project', array_get($filter, 'project') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="create_by">{{ trans('requesition.form_search.create_by') }}</label>
			{!! Form::text('create_by', array_get($filter, 'create_by') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="mix_no">{{ trans('requesition.form_search.mix_no') }}</label>
			{!! Form::text('mix_no', array_get($filter, 'mix_no') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="product_code">{{ trans('requesition.form_search.product_code') }}</label>
			{!! Form::text('product_code', array_get($filter, 'product_code') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="item_status">{{ trans('requesition.form_search.item_status') }}</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::CREATE }}"
					{{ in_array(\App\ReceiveItem::CREATE, $item_status) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-info">{{ \App\ReceiveItem::CREATE }}</span>
			</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::PADDING }}"
					{{ in_array(\App\ReceiveItem::PADDING, $item_status) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-warning">{{ \App\ReceiveItem::PADDING }}</span>
			</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::SUCCESS }}"
					{{ in_array(\App\ReceiveItem::SUCCESS, $item_status) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-success">{{ \App\ReceiveItem::SUCCESS }}</span>
			</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::CANCEL }}"
					{{ in_array(\App\ReceiveItem::CANCEL, $item_status) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-danger">{{ \App\ReceiveItem::CANCEL }}</span>
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('created_at_start')?'has-error':'' }}">
			<label class="control-label" for="created_at_start">
                {{ trans('requesition.form_search.created_at_start') }}
                <span class="text-danger"> *</span>
            </label>
			<div class='input-group date'>
				{!! Form::text('created_at_start', array_get($filter, 'created_at_start') ?: null, [
					'class' => 'form-control',
					'id' => 'datetimepicker-start',
				]) !!}
				<span class="input-group-addon">
	                <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	        </div>
			@if($errors->has('created_at_start'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('created_at_start') }}
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('created_at_start')?'has-error':'' }}">
			<label class="control-label" for="created_at_end">
                {{ trans('requesition.form_search.created_at_end') }}
                <span class="text-danger"> *</span>
            </label>
			<div class='input-group date'>
				{!! Form::text('created_at_end', array_get($filter, 'created_at_end') ?: null, [
					'class' => 'form-control',
					'id' => 'datetimepicker-end',
				]) !!}
				<span class="input-group-addon">
	                <span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
			@if($errors->has('created_at_end'))
				<span id="helpBlock2" class="help-block text-error">
					{{ $errors->first('created_at_end') }}
				</span>
			@endif
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<button type="submit" class="btn btn-info btn-sm">
				<i class="fa fa-search"></i>
				{{ trans('requesition.buttons.search') }}
			</button>
			<a href="/requisition-movement" class="btn btn-default btn-sm">
				<i class="fa fa-refresh"></i>
				{{ trans('requesition.buttons.refresh') }}
			</a>
			<a href="{{ $urlExport }}" class="btn btn-default btn-sm">
				<i class="fa fa-download"></i>
				{{ trans('requesition.buttons.excel') }}
			</a>
		</div>
	</div>

</div>

{!! Form::close() !!}