<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\Location;
use App\Requesition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequesitionCreateRequest;

class RequesitionController extends Controller
{
    protected $requesition;

    public function __construct(Requesition $requesition)
    {
        $this->requesition = $requesition;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requesitions = $this->requesition
            ->orderBy('created_at', 'desc')
            ->get();

        return view('requesitions.index', [
            'requesitions' => $requesitions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::lists('code', 'id');
        
        return view('requesitions.create_modal', [
            'projects' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequesitionCreateRequest $request)
    {
        $data = $request->all();

        $project_id = $request->get('project_id');

        $data['project_code'] = Project::find($project_id)->code;
        $data['user_id']      = $request->user()->id;

        $requesition = '';

        DB::transaction(function() use (&$requesition, $data) {
            $requesition = Requesition::create($data);

        });

        if($requesition){

            return [
                'status' => 'success',
                'urlRedirect' => url("/requesitions"),
            ];
        }
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
        if($locations != null){
            $locationLists = $locationLists + $locations->toArray();
        }
        
        return view('requesitions.add_product', [
            'requesition' => $requesition,
            'items' => $requesition->items,
            'locationLists' => $locationLists,
        ]);
    }

    public function storeProduct()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
