<div class="panel panel-default">
    <div class="panel-body hidden-print">
        <div class="btn-group" role="group" aria-label="...">
            <a class="btn btn-warning btn-sm" href="/requisitions">
                <i class="fa fa-chevron-left"></i>
                {{ trans('requesition.buttons.back_to_requesition') }}
            </a>
        </div>
        <div class="btn-group pull-right" role="group" aria-label="...">
            <a class="btn btn-success btn-sm" id="invoicePrint">
                <i class="fa fa-file-excel-o"></i> Export Excel
            </a>
            <a class="btn btn-success btn-sm" id="invoicePrint">
                <i class="fa fa-print"></i> Print
            </a>
            @if($requesition->status != \App\Requesition::SUCCESS)
                <div class="btn-group dropup">
                    <button type="button"
                            class="btn btn-default btn-sm dropdown-toggle"
                            data-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fa fa-cog"></i>
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        @if($requesition->status == \App\Receive::PADDING)
                            <li>
                                <a href="/requisitions/processes/{{ $requesition->id }}">
                                    <i class="fa fa-flag fa-lg"></i>
                                    {{ trans('requesition.buttons.process_success') }}
                                </a>
                            </li>
                        @endif

                        @if($requesition->status == \App\Receive::CREATE)
                            <li>
                                {!! Form::open([
                                    'id' => 'process_padding',
                                    'method' => 'post',
                                    'url' => "/requisitions/status-padding/{$requesition->id}",
                                    'class' => 'form-confirm',
                                    'data-title-confirm' => trans('requesition.message_alert.review_confirm'),
                                    'data-message-cancel' => trans('requesition.message_alert.review_cancel'),
                                    'data-confirm-ok' => trans('main.confirm_button.ok'),
                                    'data-confirm-cancel' => trans('main.confirm_button.cancel')
                                ]) !!}

                                <a href id="process_padding">
                                    <i class="fa fa-flag fa-lg"></i>
                                    {{ trans('requesition.buttons.process_padding') }}</a>

                                {!! Form::close() !!}
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            @if($requesition->status == \App\Requesition::CREATE)
                <a class="btn btn-info btn-sm" href="/requisitions/add-products/{{ $requesition->id }}">
                    <i class="fa fa-plus"></i> {{ trans('requesition.buttons.add_product') }}
                </a>
            @endif
        </div>
    </div>
</div>