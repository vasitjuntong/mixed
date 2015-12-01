<?php

namespace App\Http\Controllers;

use App\Product;
use App\Project;
use App\Receive;
use App\Location;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiveCreateRequest;
use App\Http\Requests\ReceiveUpdateRequest;
use App\Http\Requests\AddProductReceiveRequest;
use DB;
use Exception;
use Log;

class ReceiveController extends Controller
{
    public function index()
    {
        $receives = Receive::orderBy('id', 'desc')
            ->paginate(20);

        return view('receives.index', compact('receives'));
}

    public function create()
    {
        $projects = Project::orderBy('code', 'desc')
            ->lists('code', 'id');
        
        return view('receives.create', compact('projects'));
    }

    public function store(ReceiveCreateRequest $request)
    {
        $data = $request->all();

        $project = Project::find($request->get('project_id'), ['code']);

        $data['project_code'] = $project->code;

        $receive = Receive::create($data);

        return redirect("/receives/add-products/{$receive->id}");
    }

    public function addProducts($id)
    {
        $receive = Receive::with([
                'receiveItems',
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

        $locations = Location::orderBy('name', 'desc')
            ->lists('name', 'id');

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
            $receiveItem = $receive->receiveItems()
                ->where('product_id', array_get($request->all(), 'product_id'))
                ->where('location_id', array_get($request->all(), 'location_id'))
                ->first();

            $receiveItem->setRawAttributes(
                array_except($request->all(), ['_token'])
            );

            $receiveItem->save();
        } else {
            $receive->receiveItems()
                ->create($request->all());
        }

        return redirect("/receives/add-products/{$receive_id}");
    }

    public function show($id)
    {
        // $receive = Receive::with([
        //         'receiveItems',
        //     ])
        //     ->where('id', $id)
        //     ->first();

        // $receiveItems = $receive->receiveItems()
        //     ->orderBy('id', 'asc')
        //     ->get();

        // return view('receives.add_product', compact(
        //     'receive', 
        //     'products', 
        //     'locationLists',
        //     'receiveItems'
        // ));
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

        return redirect("/receives/add-products/{$receive->id}");
    }

    public function review($id)
    {
        $receive = Receive::with([
                'receiveItems'    
            ])
            ->where('id', $id)
            ->first();

        $receiveItems = $receive->receiveItems;

        return view('receives.review', compact('receive', 'receiveItems'));
    }

    public function statusPadding($id)
    {   
        $receive = Receive::find($id);
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

            return redirect()
                ->back();
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
        $receive = Receive::find($id);

        try{
            DB::transaction(function() use ($receive, $request) {

                $receive->setStatusSuccess($request->get('receive_item_ids'));
            });

            return [
                'status' => true,
                'title' => trans('receive.label.name'),
                'message' => trans('receive.message_alert.status_success_message'),
                'url' => url("/receives/status-success/{$receive->id}"),
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

    public function destroy($id)
    {
        //
    }
}
