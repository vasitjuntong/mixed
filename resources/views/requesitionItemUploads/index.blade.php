<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{ trans('requesition_item_upload.label.name') }}
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'url' => "/requisition-upload/{$requesition->id}",
                    'files' => true,
                    'id' => 'upload-file-excel',
                    'class' => 'form-horizontal',
                ]) !!}

                <div id="file" class="form-group {{ $errors->has('file')?'has-error':'' }}">
                    <label class="col-sm-2 control-group">
                        {{ trans('requesition_item_upload.attributes.file') }}
                        <i class="text-danger"> *</i>
                    </label>
                    <div class="col-sm-10">
                        {!! Form::file('file', null, [
                        'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="btn-group">
                            <button class="btn btn-info btn-sm">
                                <span class="fa fa-download"></span>
                                {{ trans('requesition_item_upload.buttons.upload') }}
                            </button>
                        </div>
                        <div class="btn-group">
                            <a href="/file-examples/requisition_item_ex.xlsx">
                                <span class="fa fa-file-excel-o"></span>
                                File example
                            </a>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

                <div id="response-errors"
                     class="alert alert-danger"
                     style="display: none"
                >
                    <ul style="list-style: none;">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/libs/form-horizontal-create.js"></script>
