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
        $receive = Receive::find($id);

        $locations = Location::orderBy('name', 'desc')
            ->lists('name', 'id');

        $locationLists = [null => trans('main.label.select')];
        if($locations != null)
            $locationLists = $locationLists + $locations->toArray();

        return view('receives.add_product', compact(
            'receive', 
            'products', 
            'locationLists'
        ));
    }

    public function storeProducts(AddProductReceiveRequest $request, $receive_id)
    {
        $receive = Receive::find($receive_id);

        $receive->receiveItems()
            ->create($request->all());

        return redirect("/receives/add-products/{$receive_id}");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
