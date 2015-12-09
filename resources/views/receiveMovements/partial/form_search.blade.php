{!! Form::open([
	'method' => 'get',
	'url' => '/receives/movement',
]) !!}
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="document_no">{{ trans('receive.form_search.document_no') }}</label>
			{!! Form::text('document_no', array_get($filter, 'document_no') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="po_no">{{ trans('receive.form_search.po_no') }}</label>
			{!! Form::text('po_no', array_get($filter, 'po_no') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="ref_no">{{ trans('receive.form_search.ref_no') }}</label>
			{!! Form::text('ref_no', array_get($filter, 'ref_no') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="project">{{ trans('receive.form_search.project') }}</label>
			{!! Form::text('project', array_get($filter, 'project') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="create_by">{{ trans('receive.form_search.create_by') }}</label>
			{!! Form::text('create_by', array_get($filter, 'create_by') ?: null, [
				'class' => 'form-control',
			]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="item_status">{{ trans('receive.form_search.item_status') }}</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::CREATE }}"
					{{ in_array(\App\ReceiveItem::CREATE, array_get($filter, 'item_status')) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-info">{{ \App\ReceiveItem::CREATE }}</span>
			</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::PADDING }}"
					{{ in_array(\App\ReceiveItem::PADDING, array_get($filter, 'item_status')) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-warning">{{ \App\ReceiveItem::PADDING }}</span>
			</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::SUCCESS }}"
					{{ in_array(\App\ReceiveItem::SUCCESS, array_get($filter, 'item_status')) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-success">{{ \App\ReceiveItem::SUCCESS }}</span>
			</label>
			<label class="label-checkbox" style="margin-top: 5px;">
				<input type="checkbox" 
					name="item_status[]" 
					value="{{ \App\ReceiveItem::CANCEL }}"
					{{ in_array(\App\ReceiveItem::CANCEL, array_get($filter, 'item_status')) ? 'checked':'' }}
					>
				<span class="custom-checkbox"></span>
				<span class="label label-danger">{{ \App\ReceiveItem::CANCEL }}</span>
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="created_at_start">{{ trans('receive.form_search.created_at_start') }}</label>
			<div class='input-group date'>
				{!! Form::text('created_at_start', array_get($filter, 'created_at_start') ?: null, [
					'class' => 'form-control',
					'id' => 'datetimepicker-start',
				]) !!}
				<span class="input-group-addon">
	                <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	        </div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label" for="created_at_end">{{ trans('receive.form_search.created_at_end') }}</label>
			<div class='input-group date'>
				{!! Form::text('created_at_end', array_get($filter, 'created_at_end') ?: null, [
					'class' => 'form-control',
					'id' => 'datetimepicker-end',
				]) !!}
				<span class="input-group-addon">
	                <span class="glyphicon glyphicon-calendar"></span>
	            </span>
            </div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<button type="submit" class="btn btn-info btn-sm">
				<i class="fa fa-search"></i>
				{{ trans('receive.buttons.search') }}
			</button>
			<a href="/receives/movement" class="btn btn-default btn-sm">
				<i class="fa fa-refresh"></i>
				{{ trans('receive.buttons.refresh') }}
			</a>
			<a href="{{ $urlExport }}" class="btn btn-default btn-sm">
				<i class="fa fa-download"></i>
				{{ trans('receive.buttons.excel') }}
			</a>
		</div>
	</div>

</div>

{!! Form::close() !!}