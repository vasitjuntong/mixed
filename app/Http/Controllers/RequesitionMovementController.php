<?php

namespace App\Http\Controllers;

use Excel;
use App\Http\Requests;
use App\RequesitionItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequesitionSearchMovementRequest;

class RequesitionMovementController extends Controller
{
    public function index(Request $request)
    {   
        $filter = $request->except(['orderBy']);

        $limit = $request->get('limit', 20);
        $item_status = array_get($request->all(), 'item_status', array());
        $orderBy = array_get($request->all(), 'sort_by', array());

        $items = RequesitionItem::whereByFilter($filter, $limit, $orderBy);

        return view('requesitionMovements.index', [
            'items' => $items,
            'filter' => $filter,
            'urlExport' => url("/requesition-movement/download-excel?{$request->getQueryString()}"),
            'item_status' => $item_status,
        ]);
    }

    public function downloadExcel(RequesitionSearchMovementRequest $request)
    {
        $filter = $request->except(['item_status', 'orderBy']);
        $orderBy = array_get($request->all(), 'sort_by', array());

        $items = RequesitionItem::whereByFilterAll($filter, $orderBy);

        $datetime = date('d-m-Y_H-i-s');

        Excel::create("movement_requesition_{$datetime}", function($excel) use ($items) {
            $excel->sheet('Requesition', function($sheet) use ($items) {
                $sheet->setAutoSize(true);
                $sheet->row(1, array(
                    trans('requesition.attributes.created_at'),
                    trans('requesition.attributes.document_no'),
                    trans('requesition.attributes.site_id'),
                    trans('requesition.attributes.site_name'),
                    trans('requesition.attributes.project_code'),
                    trans('requesition.attributes.create_by'),
                    trans('requesition.attributes.remark'),
                    trans('requesition_item.attributes.mix_no'),
                    trans('requesition_item.attributes.product_code'),
                    trans('requesition_item.attributes.location_id'),
                    trans('requesition_item.attributes.product_description'),
                    trans('requesition_item.attributes.unit'),
                    trans('requesition_item.attributes.qty'),
                    trans('requesition_item.attributes.remark'),
                    trans('requesition_item.attributes.status'),
                ));
                    
                $sheet->row(1, function($row){
                    $row->setBorder('solid', 'solid', 'solid', 'solid');

                    $row->setFont(array(
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });

                 $i = 2;

                foreach($items as $item){
                    $sheet->row($i, array(
                        // Receive data
                        $item->requesition->created_at->format('d/m/Y H:i'),
                        $item->requesition->document_no,
                        $item->requesition->site_id,
                        $item->requesition->site_name,
                        $item->requesition->project_code,
                        $item->requesition->user->name,
                        $item->requesition->remark,
                        // Item
                        $item->mix_no,
                        $item->product_code,
                        $item->location_name,
                        $item->product_description,
                        $item->product->unit->name,
                        $item->qty,
                        $item->remark,
                        $item->status,
                    ));
                    $i ++;
                }
            });

        })->export('xls');
    }
}
