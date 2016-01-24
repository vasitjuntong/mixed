<?php

namespace App\Http\Controllers;

use Excel;
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

    public function getDownloadExcel(MovementAllSearchRequest $request)
    {
        $filter = $request->except(['item_status', 'orderBy']);
        $item_status = array_get($request->all(), 'item_status', []);
        $orderBy = array_get($request->all(), 'sort_by', array());

        $model = MovementAll::whereFilterAll($filter, $item_status, $orderBy);

        $datetime = date('d-m-Y_H-i-s');

        Excel::create("movement_all_{$datetime}", function($excel) use ($model) {
            $excel->sheet('Movement', function($sheet) use ($model) {
                $sheet->setAutoSize(true);
                $sheet->row(1, array(
                    trans('movement_all.attributes.created_at'),
                    trans('movement_all.attributes.type'),
                    trans('movement_all.attributes.dn'),
                    trans('movement_all.attributes.po_no'),
                    trans('movement_all.attributes.ref_no'),
                    trans('movement_all.attributes.project'),
                    trans('movement_all.attributes.create_by'),
                    trans('movement_all.attributes.product_mix_no'),
                    trans('movement_all.attributes.product_description'),
                    trans('movement_all.attributes.product_unit'),
                    trans('movement_all.attributes.product_qty'),
                    trans('movement_all.attributes.product_remark'),
                    trans('movement_all.attributes.status'),
                ));

                $sheet->row(1, function($row){
                    $row->setBorder('solid', 'solid', 'solid', 'solid');

                    $row->setFont(array(
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });

                $i = 2;

                foreach($model as $item){
                    $sheet->row($i, array(
                        $item->created_at->format('d/m/Y H:i'),
                        $item->type,
                        $item->dn,
                        $item->po_no,
                        $item->ref_no,
                        $item->project_code,
                        $item->created_by,

                        // Items.
                        $item->product_mix_no,
                        $item->product_description,
                        $item->product_qty,
                        $item->product_unit,
                        $item->product_remark,
                        $item->status,
                    ));
                    $i ++;
                }
            });

        })->export('xls');

    }
}
