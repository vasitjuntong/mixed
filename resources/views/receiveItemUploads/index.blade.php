@extends('layouts.app')

@section('breadcrump')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a href="/"> {{ trans('main.breadcrump.home')}}</a>
            </li>
            <li><i class="fa fa-product"></i>
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

            <div class="form-group">
                <label class="control-group">{{ trans('receive_item_upload.attributes.file') }}</label>
                {!! Form::file('file', null, [
                    'class' => 'form-control',
                ]) !!}
            </div>

            <div class="form-group">
                <button class="btn btn-info">
                    {{ trans('receive_item_upload.buttons.upload') }}
                </button>
                <a href="/file-examples/receive_item_ex.xlsx">File example</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    @if(session()->has('errors'))
        <div class="panel panel-default table-responsive">
            <div class="panel-body">
                <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach(session()->get('errors') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

@endsection