{!! Form::open([
	'method' => 'get',
	'url' => '/product-lists/movement/search',
]) !!}
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="document_no">{{ trans('movement_all.form_search.document_no') }}</label>
            {!! Form::text('dn', array_get($filter, 'dn') ?: null, [
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="po_no">{{ trans('movement_all.form_search.po_no') }}</label>
            {!! Form::text('po_no', array_get($filter, 'po_no') ?: null, [
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="project">{{ trans('movement_all.form_search.project') }}</label>
            {!! Form::text('project', array_get($filter, 'project') ?: null, [
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="mix_no">{{ trans('movement_all.form_search.mix_no') }}</label>
            {!! Form::text('mix_no', array_get($filter, 'mix_no') ?: null, [
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="item_status">{{ trans('movement_all.form_search.item_status') }}</label>
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
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('created_at_start')?'has-error':'' }}">
            <label class="control-label"
                   for="created_at_start">{{ trans('movement_all.form_search.created_at_start') }}</label>

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
        <div class="form-group {{ $errors->has('created_at_end')?'has-error':'' }}">
            <label class="control-label"
                   for="created_at_end">{{ trans('movement_all.form_search.created_at_end') }}</label>

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
                {{ trans('movement_all.buttons.search') }}
            </button>
            <a href="/product-lists/movement" class="btn btn-default btn-sm">
                <i class="fa fa-refresh"></i>
                {{ trans('movement_all.buttons.refresh') }}
            </a>
            <a href="{{ $urlExport }}" class="btn btn-default btn-sm">
                <i class="fa fa-download"></i>
                {{ trans('movement_all.buttons.excel') }}
            </a>
        </div>
    </div>

</div>

{!! Form::close() !!}