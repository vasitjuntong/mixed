<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationCreateRequest;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationCreateRequest $request)
    {
        Location::create($request->all());

        flash()->success(
            trans('location.label.name'),
            trans('location.message_alert.create_success')
        );

        return redirect('/locations');
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
        $location = Location::find($id);

        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationUpdateRequest $request, $id)
    {
        $location = new Location($request->all());

        Location::where('id', $id)
            ->update($location->getAttributes());

        flash()
            ->success(
                trans('location.label.name'),
                trans('location.message_alert.update_success')
            );

        return redirect('/locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $response = Location::deleteByCondition($id);


        if($request->ajax())
            return $response;

        if($response['status']){
            flash()
                ->success(
                    trans('location.label.name'),
                    $response['message']
                );
        }else{
            flash()
                ->success(
                    trans('location.label.name'),
                    $response['message']
                );
        }


        return redirect('/locations');

    }
}
