<?php

namespace App\Http\Controllers;

use App\Receive;
use App\UploadReceiveItem;
use Illuminate\Http\Request;
use Log;

class ReceiveItemUploadController extends Controller
{
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

    public function store(Request $request, UploadReceiveItem $upload, $id)
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

            return redirect("/receives/add-products/{$id}");
        }


        return redirect("/receive-upload/{$id}")
            ->with('errors', $upload->getErrors());
    }
}
