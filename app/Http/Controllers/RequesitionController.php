<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\Location;
use App\Requesition;
use App\RequesitionItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequesitionCreateRequest;
use App\Http\Requests\RequesitionItemAddProductRequest;

class RequesitionController extends Controller
{
    protected $item;
    protected $requesition;

    public function __construct(Requesition $requesition, RequesitionItem $item)
    {
        $this->item        = $item;
        $this->requesition = $requesition;
    }

    public function index(Request $request)
    {
        $requesitions = $this->requesition
            ->orderBy('created_at', 'desc')
            ->get();

        return view('requesitions.index', [
            'requesitions' => $requesitions,
        ]);
    }

    public function create()
    {
        $projects = Project::lists('code', 'id');

        return view('requesitions.create_modal', [
            'projects' => $projects,
        ]);
    }

    public function store(RequesitionCreateRequest $request)
    {
        $data = $request->all();

        $project_id = $request->get('project_id');

        $data['project_code'] = Project::find($project_id)->code;
        $data['user_id'] = $request->user()->id;

        $requesition = '';

        DB::transaction(function () use (&$requesition, $data) {
            $requesition = Requesition::create($data);

        });

        if ($requesition) {

            return [
                'status' => 'success',
                'urlRedirect' => url("/requesitions"),
            ];
        }
    }

    public function show($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
                'project',
                'items.unit',
            ])
            ->where('id', $id)
            ->first();

        return view('requesitions.show', [
            'requesition' => $requesition,
            'items' => $requesition->items,
        ]);
    }

    public function addProducts($id)
    {
        $requesition = $this->requesition
            ->with([
                'items',
            ])
            ->where('id', $id)
            ->first();

        $locations = Location::orderBy('name', 'desc')
            ->lists('name', 'id');

        $locationLists = [null => trans('main.label.select')];
        if ($locations != null) {
            $locationLists = $locationLists + $locations->toArray();
        }

        return view('requesitions.add_product', [
            'requesition'   => $requesition,
            'items'         => $requesition->items,
            'locationLists' => $locationLists,
        ]);
    }

    public function storeProduct(RequesitionItemAddProductRequest $request)
    {
        
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
