<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitCreateRequest;
use App\Http\Requests\UnitUpdateRequest;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('units.index', compact('units'));
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
    public function store(UnitCreateRequest $request)
    {
        Unit::create($request->all());

        flash()->success(
            trans('unit.label.name'),
            trans('unit.message_alert.create_success')
        );

        return redirect('/units');
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
        $unit = Unit::find($id);

        return view('units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitUpdateRequest $request, $id)
    {
        $unit = new Unit($request->all());

        Unit::where('id', $id)
            ->update($unit->getAttributes());

        flash()
            ->success(
                trans('unit.label.name'),
                trans('unit.message_alert.update_success')
            );

        return redirect('/units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $response = Unit::deleteByCondition($id);


        if($request->ajax())
            return $response;

        if($response['status']){
            flash()
                ->success(
                    trans('unit.label.name'),
                    $response['message']
                );
        }else{
            flash()
                ->success(
                    trans('unit.label.name'),
                    $response['message']
                );
        }


        return redirect('/units');

    }
}
