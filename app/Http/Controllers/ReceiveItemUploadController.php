<?php

namespace App\Http\Controllers;

use Log;
use App\Receive;
use App\UploadReceiveItem;
use Illuminate\Http\Request;
use App\Http\Requests\ReceiveItemUploadRequest;

class ReceiveItemUploadController extends Controller
{
    public function __construct(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
    }

    public function index($id)
    {
        $receive = Receive::with([
            'receiveItems',
        ])
            ->where('id', $id)
            ->first();

        return view('receiveItemUploads.index', [
            'receive' => $receive,
        ]);
    }

    public function store(ReceiveItemUploadRequest $request, UploadReceiveItem $upload, $id)
    {
        $receive = Receive::find($id);

        $file = $request->file('file');
        $upload->upload($file->getRealPath(), $id);

        if (empty($upload->getErrors()) && !empty($upload->getData())) {
            $responseSave = $upload->save($receive);

            Log::debug('update-receive-item: save', [
                $responseSave,
            ]);

            flash()->success(
                trans('receive.label.name'),
                trans('receive_item_upload.message_alert.success')
            );

            return [
                'status'      => 'success',
                'urlRedirect' => url("/receives/add-products/{$id}"),
            ];
        }

        return [
            'status' => 'error',
            'errors' => $upload->getErrors(),
        ];
    }
}
