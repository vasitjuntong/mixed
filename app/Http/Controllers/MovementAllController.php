<?php

namespace App\Http\Controllers;

use App\MovementAll;
use Illuminate\Http\Request;
use App\Http\Requests\MovementAllSearchRequest;

class MovementAllController extends Controller
{
    public function getIndex(Request $request)
    {
        $filter = $request->except(['orderBy']);

        $item_status = array_get($request->all(), 'item_status', []);
        $orderBy = array_get($request->all(), 'sort_by', []);

        $model = new MovementAll();

        return view('movementAll.index', [
            'model'       => $model,
            'filter'      => $filter,
            'item_status' => $item_status,
            'urlExport'   => url("/product-lists/movement/download-excel?{$request->getQueryString()}"),
        ]);
    }

    public function getSearch(MovementAllSearchRequest $request)
    {
        $filter = $request->except(['orderBy']);

        $item_status = array_get($request->all(), 'item_status', []);
        $orderBy = array_get($request->all(), 'sort_by', []);

        $model = MovementAll::whereFilter($filter, $item_status, $orderBy);

        return view('movementAll.search', [
            'model'       => $model,
            'filter'      => $filter,
            'item_status' => $item_status,
            'urlExport'   => url("/product-lists/movement/download-excel?{$request->getQueryString()}"),
        ]);
    }
}
