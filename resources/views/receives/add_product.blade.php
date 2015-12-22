@extends('layouts.app')

@section('breadcrump')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a href="/"> {{ trans('main.breadcrump.home')}}</a>
            </li>
            <li><i class="fa fa-download"></i>
                <a href="/receives"> {{ trans('receive.label.name')}}</a>
            </li>
            <li><i class="fa fa-edit"></i>
                <a href="/receives/{{ $receive->id }}/edit"> {{ trans('receive.label.update')}}</a>
            </li>
            <li class="active">{{ trans('receive_item.label.name') }}</li>
        </ul>
    </div><!-- /breadcrumb-->
    <div class="main-header clearfix">
        <div class="page-title">
            <h3 class="no-margin">
                {{ trans('receive.label.name') }} {{ $receive->document_no }}
            </h3>
        </div><!-- /page-title -->
    </div><!-- /main-header -->

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12" id="app">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('receive.label.add_product') }}
                </div>
                <div class="panel-body">

                    {!! Form::open([
                        'method' => 'POST',
                        'url' => "/receives/add-products/{$receive->id}",
                    ]) !!}

                    <div class="row">
                        @include('receives.partial.add_product_form')
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-sm">
                                <span class="fa fa-plus"></span>
                                {{ trans('receive.buttons.add_product') }}
                            </button>
                            <a id="upload-file-excel" class="btn btn-success btn-sm"
                               href="/receive-upload/{{ $receive->id }}">
                                <span class="fa fa-file-excel-o"></span>
                                {{ trans('receive.buttons.upload_excel') }}
                            </a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            @include('receives.partial.product_table')

            @if($receiveItems->count())
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open([
                                'method' => 'post',
                                'url' => "/receives/status-padding/{$receive->id}",
                                'class' => 'form-confirm',
                                'data-title-confirm' => trans('receive.message_alert.review_confirm'),
                                'data-message-cancel' => trans('receive.message_alert.review_cancel'),
                                'data-confirm-ok' => trans('main.confirm_button.ok'),
                                'data-confirm-cancel' => trans('main.confirm_button.cancel')
                            ]) !!}

                        <button type="submit" class="btn btn-success">
                            {{ trans('receive.buttons.confirm_receive') }}
                        </button>

                        {!! Form::close() !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div id="modal_content"></div>

@endsection

@section('style')
    @parent

    <link href="/css/chosen/chosen.min.css" rel="stylesheet">
    <link href="/css/bootstrap-editable.css" rel="stylesheet">
@endsection

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.min.js"></script>
    <script src="/js/bootstrap-editable.min.js"></script>
    <script src="/js/typeahead.min.js"></script>
    <script src="/js/libs/vue_addproduct.js"></script>
    <script src="/js/chosen.jquery.min.js"></script>
    <script src="/js/libs/form_confirm.js"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('a#upload-file-excel').click(function (e) {
                e.preventDefault();

                var that = $(this);
                var modal_content = $('div#modal_content');

                $.ajax({
                    type: 'get',
                    url: that.attr('href'),
                    success: function (result) {
                        modal_content.html(result);
                        $('#modal-create').modal('show');
                    }
                });

                return false;
            });

            $.fn.editableform.buttons = '<button class="btn btn-success btn-sm editable-submit" type="submit"><i class="fa fa-check"></i></button>'
                    + ' <button class="btn btn-danger btn-sm editable-cancel" type="button"><i class="fa fa-times"></i></button>';

            $('a#editable-qty').editable({
                success: function (response, newValue) {
                    if (response.status == 'error') return response.mgs;
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
            $(".chosen-select").chosen({
                search_contains: true
            });
        })
    </script>
@endsection