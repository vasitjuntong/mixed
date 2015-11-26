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
            ->where('id', $id)
            ->first();

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

        if($count){
            $receiveItem = $receive->receiveItems()
                ->where('product_id', array_get($request->all(), 'product_id'))
                ->where('location_id', array_get($request->all(), 'location_id'))
                ->first();

            $receiveItem->setRawAttributes(
                array_except($request->all(), ['_token'])
            );

            $receiveItem->save();
        }
        else{
            $receive->receiveItems()
                ->create($request->all());
            dd('count 0');
        }

        return redirect("/receives/add-products/{$receive_id}");
    }

    public function show($id)
    {
        $receive = Receive::with([
                'receiveItems',
            ])
            ->where('id', $id)
            ->first();

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

    public function destroy($id)
    {
        //
    }
}
