@extends('layouts.app')

@section('breadcrump')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a href="index.html"> {{ trans('main.breadcrump.home')}}</a>
            </li>
            <li class="active">{{ trans('requesition.label.name') }}</li>
        </ul>
    </div><!-- /breadcrumb-->
    <div class="main-header clearfix">
        <div class="page-title">
            <h3 class="no-margin">{{ trans('requesition.label.name') }}</h3>
        </div><!-- /page-title -->
    </div><!-- /main-header -->
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body text-right">
            <a
                    id="create"
                    href="/requisitions/create"
                    class="btn btn-warning btn-sm">

                <span class="fa fa-plus"></span>
                {{ trans('requesition.label.new_requesition') }}
            </a>
            <a href="/requisition-movement" class="btn btn-success btn-sm">
                <span class="fa fa-clock-o"></span>
                {{ trans('requesition.label.movement') }}
            </a>
        </div>
    </div>

    <div class="panel panel-default table-responsive">
        <div class="panel-body">
            @include('requesitions.partial.table')
        </div>
    </div>

    <div id="modal_content"></div>

@endsection

@section('style')
    @parent

    <link rel="stylesheet" href="/css/jquery.dataTables_themeroller.css">
@endsection

@section('script')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>

    <script>
        $(function () {
            $('a#create').click(function (e) {
                e.preventDefault();

                var link = $(this);
                var oldLink = link.html();
                var modal_content = $('div#modal_content');

                link.attr('disabled', 'disabled');
                link.html('<i class="fa fa-spinner fa-spin"></i> Loading...');

                $.ajax({
                    type: 'get',
                    url: link.attr('href'),
                    success: function (result) {
                        modal_content.html(result);
                        $('#modal-create').modal('show');

                        link.removeAttr('disabled');
                        link.html(oldLink);
                    }
                });

                return false;
            });

            $('#dataTables').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "order": [[0, "desc"]],
                "aoColumns": [
                    { "sType": "date" },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ]
            });
        });
    </script>

@endsection