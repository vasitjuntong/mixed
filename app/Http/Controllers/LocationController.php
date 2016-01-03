<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
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

    public function store(LocationCreateRequest $request)
    {
        Location::create($request->all());

        flash()->success(
            trans('location.label.name'),
            trans('location.message_alert.create_success')
        );

        return redirect('/locations');
    }

    public function edit($id)
    {
        $location = Location::find($id);

        return view('locations.edit', compact('location'));
    }

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

    public function destroy(Request $request, $id)
    {
        $response = Location::deleteByCondition($id);

        if ($request->ajax()) {
            return $response;
        }

        if ($response['status']) {
            flash()
                ->success(
                    trans('location.label.name'),
                    $response['message']
                );
        } else {
            flash()
                ->success(
                    trans('location.label.name'),
                    $response['message']
                );
        }

        return redirect('/locations');

    }
}
