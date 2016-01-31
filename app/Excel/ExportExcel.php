<?php

namespace App\Excel;

use Excel;

abstract class ExportExcel
{
    protected $data = [];
    protected $fileName = 'requesition';

    public function setFileName($name)
    {
        $this->fileName = $name;

        return $this;
    }

    abstract protected function columns();

    public function add(array $data)
    {
        $this->data[] = $data;

        return $this;
    }

    public function download()
    {
        $data = $this->data;
        $columns = $this->columns();

        Excel::create($this->fileName, function ($excel) use ($columns, $data) {
            $excel->sheet('Requisition', function($sheet) use ($columns, $data) {
                $sheet->setAutoSize(true);
                $sheet->row(1, $columns);
                $sheet->row(1, function($row){
                    $row->setBorder('solid', 'solid', 'solid', 'solid');
                    $row->setFont(array(
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });
                $i = 2;
                foreach($this->data as $column => $item){
                    $row = [];
                    foreach($this->columns() as $column => $label){
                        $row[$column] = array_get($item, $column);
                    }
                    $sheet->row($i, $row);
                    $i ++;
                }
            });
        })->export('xls');
    }
}