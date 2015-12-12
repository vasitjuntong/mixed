@extends('layouts.app')

@section('breadcrump')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a href="/"> {{ trans('main.breadcrump.home')}}</a>
            </li>
            <li><i class="fa fa-product-hunt"></i>
                <a href="/receives/add-products/{{ $receive->id }}"> {{ trans('receive.label.add_product')}}</a>
            </li>
            <li class="active">{{ trans('receive_item_upload.label.name') }}</li>
        </ul>
    </div>
    <div class="main-header clearfix">
        <div class="page-title">
            <h3 class="no-margin">{{ trans('receive_item_upload.label.name') }}</h3>
        </div>
    </div>
@endsection

@section('content')

    <div class="panel panel-default table-responsive">
        <div class="panel-body">
            {!! Form::open([
                'url' => "/receive-upload/{$receive->id}",
                'files' => true,
            ]) !!}

            <div class="form-group {{ $errors->has('file')?'has-error':'' }}">
                <label class="control-group">{{ trans('receive_item_upload.attributes.file') }}</label>
                {!! Form::file('file', null, [
                    'class' => 'form-control',
                ]) !!}
                @if($errors->has('file'))
                    <span class="help-block text-danger">
                        {{ $errors->first('file') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="btn-group">
                    <button class="btn btn-info btn-sm">
                        <span class="fa fa-download"></span>
                        {{ trans('receive_item_upload.buttons.upload') }}
                    </button>
                </div>
                <div class="btn-group">
                    <a href="/file-examples/receive_item_ex.xlsx">
                        <span class="fa fa-file-excel-o"></span>
                        File example
                    </a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    @if(session()->has('flash_errors'))
        <div class="panel panel-default table-responsive">
            <div class="panel-body">
                <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach(session()->get('flash_errors') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

@endsection