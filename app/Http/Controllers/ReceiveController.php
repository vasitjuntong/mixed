<?php

namespace App\Http\Controllers;

use DB;
use Excel;
use Log;
use Auth;
use Response;
use Exception;
use Validator;
use App\Product;
use App\Project;
use App\Receive;
use App\Location;
use App\ReceiveItem;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiveCreateRequest;
use App\Http\Requests\ReceiveUpdateRequest;
use App\Http\Requests\AddProductReceiveRequest;

class ReceiveController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->all();

        $receives = Receive::whereByFilterAll($filter);

        return view('receives.index', [
            'receives' => $receives,
            'urlDownloadExcel' => url("/receives/download-excel?{$request->getQueryString()}"),
        ]);
}

    public function create(Request $request)
    {
        $projects = Project::orderBy('code', 'desc')
            ->lists('code', 'id');

        if($request->ajax()){

            return view('receives.create_modal', compact('projects'));
        }
        
        return view('receives.create', compact('projects'));
    }

    public function store(ReceiveCreateRequest $request)
    {
        $data = $request->all();
        $project = Project::find($request->get('project_id'), ['code']);
        $data['project_code'] = $project->code;
        $data['user_id'] = $request->user()->id;

        $receive = '';

        DB::transaction(function() use (&$receive, $data) {
            $receive = Receive::create($data);
        });

        if($request->ajax()){

            \Log::info('create-receive: success', array(
                $receive,
            ));

            return [
                'status' => 'success',
                'urlRedirect' => url("/receives/add-products/{$receive->id}"),
            ];
        }

        return redirect("/receives/add-products/{$receive->id}");
    }

    public function addProducts($id)
    {
        $receive = Receive::with([
                'receiveItems',
                'receiveItems.product',
                'receiveItems.product.unit',
            ])
            ->whereId($id)
            ->whereStatus(Receive::CREATE)
            ->first();

        if($receive == null){
            flash()->error(
                trans('receive.label.name'),
                trans('receive.message_alert.warning_receive_is_not_create')
            );

            return redirect()
                ->back();
        }

        $locations = Location::lists('name', 'id');

        $locationLists = [null => trans('main.label.select')];
        if($locations != null)
            $locationLists = $locationLists + $locations->toArray();

        $receiveItems = $receive->receiveItems()
            ->orderBy('id', 'asc')
            ->get();

        return view('receives.add_product', compact(
            'receive', 
            'products', 
            'locationLists',
            'receiveItems'
        ));
    }

    public function storeProducts(AddProductReceiveRequest $request, $receive_id)
    {
        $receive = Receive::find($receive_id);

        $count = $receive->receiveItems()
            ->where('product_id', array_get($request->all(), 'product_id'))
            ->where('location_id', array_get($request->all(), 'location_id'))
            ->count();

        if($count) {
            flash()->error(
                trans('receive.label.name'),
                trans('receive.message_alert.warning_product_is_exists')
            );
        } else {
            $receive->receiveItems()
                ->create($request->all());
        }

        return redirect("/receives/add-products/{$receive_id}");
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $receive = Receive::find($id);

        $projects = Project::orderBy('code', 'desc')
            ->lists('code', 'id');

        return view('receives.edit', compact('receive', 'projects'));
    }

    public function update(ReceiveUpdateRequest $request, $id)
    {
        $data = $request->all();
        $project = Project::find($request->get('project_id'), ['code']);
        $data['project_code'] = $project->code;

        $receive = Receive::find($id);
        $receive->update($data);

        return redirect("/receives/review/{$receive->id}");
    }

    public function review($id)
    {
        $receive = Receive::with([
                'receiveItems',  
                'receiveItems.product',  
                'receiveItems.product.unit',  
            ])
            ->where('id', $id)
            ->first();

        $receiveItems = $receive->receiveItems;

        $projectLists = Project::lists('code', 'id');

        return view('receives.review', compact('receive', 'receiveItems', 'projectLists'));
    }

    public function statusPadding($id)
    {   
        $receive = Receive::with([
            'receiveItems',
        ])
            ->whereStatus(Receive::CREATE)
            ->whereId($id)
            ->first();

        if($receive == null){
            return [
                'status' => false,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.item_is_empty'),
                'url' => url('/receives/review/'. $id),
            ];
        }

        try{
            DB::transaction(function() use ($receive) {
                $receive->setStatusPadding();
            });
        } catch(Exception $e) {
            Log::error('set-status-padding-unsuccess',[
                $e
            ]);

            return [
                'status' => false,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.status_padding_unsuccess_message'),
                'url' => url('/receives/review/'. $id),
            ];
        } 

        return [
            'status' => true,
            'title' => trans('receive.label.name'),
            'message' => trans('receive.message_alert.status_padding_message'),
            'url' => url('/receives/review/'. $id),
        ];
    }

    public function statusSuccess($id)
    {
        $receive = Receive::with([
                'receiveItems',
            ])
            ->whereStatus(Receive::PADDING)
            ->whereId($id)
            ->first();

        if($receive == null){
            flash()->error(
                trans('receive.label.name'),
                trans('receive.message_alert.warning_receive_is_not_padding')
            );

            return redirect('/receives');
        }

        $receiveItems = $receive->receiveItems()
            ->paginate(20);

        return view('receives.status_success', compact(
            'receive',
            'receiveItems'
        ));
    }

    public function storeStatusSuccess(Request $request, $id)
    {
        $receive = Receive::with([
                'receiveItems',
                'receiveItems.product',
                'receiveItems.product.stock',
            ])
            ->whereId($id)
            ->first();

        try{
            DB::transaction(function() use (&$receive, $request) {

                $receive->setStatusSuccess($request->get('receive_item_ids'));
            });

            $url = url('/receives');

            if($receive->status != Receive::SUCCESS){
                $url = url("/receives/status-success/{$receive->id}");
            }

            return [
                'status' => true,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.status_success_message'),
                'url' => $url,
            ];
        } catch(Exception $e) {

            Log::error('receive-item-unsuccess', array($e));

            return [
                'status' => false,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.status_success_unsuccess_message'),
                'url' => url("/receives/status-success/{$receive->id}"),
            ];
        }
    }

    public function storeStatusCancel(Request $request, $id)
    {
        $receive = Receive::with([
                'receiveItems',
                'receiveItems.product',
                'receiveItems.product.stock',
            ])
            ->whereId($id)
            ->first();

        try{
            DB::transaction(function() use (&$receive, $request) {

                $receive->setStatusCancel($request->get('receive_item_ids'));
            });

            $url = url('/receives');

            if($receive->status == Receive::PADDING){
                $url = url("/receives/status-success/{$receive->id}");
            }

            return [
                'status' => true,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.status_cancel_message'),
                'url' => $url,
            ];
        } catch(Exception $e) {

            Log::error('receive-item-unsuccess', array($e));

            return [
                'status' => false,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.status_success_unsuccess_message'),
                'url' => url("/receives/status-success/{$receive->id}"),
            ];
        }
    }

    public function updateQty(Request $request)
    {
        $id = $request->get('pk');
        $qty = $request->get('value');

        $mgs = [];
        $roles = [
            'value' => 'required|integer|digits_between:1,10',
        ];
        $attributes = [
            'value' => trans('receive_item.attributes.qty')
        ];

        $validator = Validator::make($request->all(), $roles, $mgs, $attributes);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'mgs' => $validator->errors()->first('value')
            ]);
        }

        $item = ReceiveItem::find($id);

        $item->qty = $qty;

        $item->save();

    }

    public function downloadExcel(Request $request)
    {
        $filter = $request->all();

        $receives = Receive::whereByFilterAll($filter);

        $datetime = date('d-m-Y_H-i');

        Excel::create("receive_{$datetime}", function($excel) use ($receives) {
            $excel->sheet('Receive', function($sheet) use ($receives) {
                $sheet->setAutoSize(true);
                $sheet->row(1, array(
                    trans('receive.attributes.created_at'),
                    trans('receive.attributes.document_no'),
                    trans('receive.attributes.po_no'),
                    trans('receive.attributes.ref_no'),
                    trans('receive.attributes.project_code'),
                    trans('receive.attributes.create_by'),
                    trans('receive.attributes.remark'),
                ));
                    
                $sheet->row(1, function($row){
                    $row->setBorder('solid', 'solid', 'solid', 'solid');

                    $row->setFont(array(
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });

                 $i = 2;

                foreach($receives as $receive){
                    $sheet->row($i, array(
                        // Receive data
                        $receive->created_at->format('d/m/Y H:i'),
                        $receive->document_no,
                        $receive->po_no,
                        $receive->ref_no,
                        $receive->project_code,
                        $receive->user->name,
                        $receive->remark,
                    ));
                    $i ++;
                }
            });

        })->export('xls');
    }

    public function editReceive($id)
    {
        $rules = [
            'po_no' => [
                'po_no' => 'required',
            ],
            'ref_no' => [
                'ref_no' => 'required',
            ],
            'project_id' => [
                'project_id' => 'required',
            ],
        ];

        $pk = request()->get('pk');
        $value = request()->get('value');
        $attribute = request()->get('name');

        $data = [
            $attribute => $value,
        ];
        
        $validator = Validator::make($data, $rules[$attribute]);

        if($validator->passes()){
            $receive = Receive::find($pk);
            if($attribute == 'project_id'){
                $receive->$attribute = $value;
                $receive->project_code = Project::find($value)->code;
            }else{
                $receive->$attribute = $value;
            }

            $receive->save();

            return Response::json('success', 200);
        }   

        return Response::json($validator->errors()->first($attribute), 422);            
    }

    public function destroy($id)
    {
        //
    }
}
