<?php
namespace App\Excel;

class ExportExcelRequisition extends ExportExcel
{
    protected function columns()
    {
        return [
            'number'              => 'Number',
            'product'             => 'Product',
            'product_description' => 'Description',
            'qty'                 => 'QTY',
            'unit'                => 'Unit',
        ];
    }
}