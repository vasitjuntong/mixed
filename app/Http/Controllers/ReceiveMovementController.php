<?php

namespace App\Http\Controllers;

use App\ReceiveItem;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Excel;

class ReceiveMovementController extends Controller
{
    public function index(Request $request)
    {   
        $filter = $request->all();
        $limit = $request->get('limit', 20);
        $item_status = array_get($filter, 'item_status', array());

        $receiveItems = ReceiveItem::whereByFilter($filter, $limit);

        return view('receiveMovements.index', [
            'receiveItems' => $receiveItems,
            'filter' => $filter,
            'urlExport' => url("/receives/movement/download-excel?{$request->getQueryString()}"),
            'item_status' => $item_status,
        ]);
    }

    public function downloadExcel(Request $request)
    {
        $filter = $request->all();

        $receiveItems = ReceiveItem::whereByFilterAll($filter);

        $datetime = date('d-m-Y_H-i');

        Excel::create("movement_receive_{$datetime}", function($excel) use ($receiveItems) {
            $excel->sheet('Receive', function($sheet) use ($receiveItems) {
                $sheet->setAutoSize(true);
                $sheet->row(1, array(
                    trans('receive.attributes.created_at'),
                    trans('receive.attributes.document_no'),
                    trans('receive.attributes.po_no'),
                    trans('receive.attributes.ref_no'),
                    trans('receive.attributes.project_code'),
                    trans('receive.attributes.create_by'),
                    trans('receive.attributes.remark'),
                    trans('receive_item.attributes.mix_no'),
                    trans('receive_item.attributes.product_code'),
                    trans('receive_item.attributes.location_id'),
                    trans('receive_item.attributes.product_description'),
                    trans('receive_item.attributes.unit'),
                    trans('receive_item.attributes.qty'),
                    trans('receive_item.attributes.remark'),
                    trans('receive_item.attributes.status'),
                ));
                    
                $sheet->row(1, function($row){
                    $row->setBorder('solid', 'solid', 'solid', 'solid');

                    $row->setFont(array(
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });

                 $i = 2;

                foreach($receiveItems as $item){
                    $sheet->row($i, array(
                        // Receive data
                        $item->receive->created_at->format('d/m/Y H:i'),
                        $item->receive->document_no,
                        $item->receive->po_no,
                        $item->receive->ref_no,
                        $item->receive->project_code,
                        $item->receive->user->name,
                        $item->receive->remark,
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
