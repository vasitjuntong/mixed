<?php

namespace App\Http\Controllers;

use Log;
use App\Requesition;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\UploadRequesitionItem;
use App\Http\Requests\RequesitionItemUploadRequest;

class RequesitionItemUploadController extends Controller
{
    public function __construct(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
    }

    public function index($id)
    {
        $requesition = Requesition::with([
            'items',
        ])
            ->where('status', Requesition::CREATE)
            ->where('id', $id)
            ->first();

        return view('requesitionItemUploads.index', [
            'requesition' => $requesition,
        ]);
    }

    public function store(RequesitionItemUploadRequest $request, UploadRequesitionItem $upload, $id)
    {
        $requesition = Requesition::find($id);

        $file = $request->file('file');
        $upload->upload($file->getRealPath(), $id);
        if (empty($upload->getErrors()) && !empty($upload->getData())) {
            $responseSave = $upload->save($requesition);

            Log::debug('update-requesition-item: save', [
                $responseSave,
            ]);

            flash()->success(
                trans('requesition.label.name'),
                trans('requesition_item_upload.message_alert.success')
            );

            return [
                'status'      => 'success',
                'urlRedirect' => url("/requesitions/add-products/{$id}"),
            ];
        }

        return [
            'status' => 'error',
            'errors' => $upload->getErrors(),
        ];
    }

}
