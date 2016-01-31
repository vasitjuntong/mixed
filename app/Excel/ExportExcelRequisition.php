<?php
namespace App\Excel;

class ExportExcelRequisition extends ExportExcel
{
    protected function columns()
    {
        return [
            'group'   => 'Group',
            'number'  => 'Number',
            'product' => 'Product',
            'qty'     => 'QTY',
            'unit'    => 'Unit',
        ];
    }
}