<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReceiveUpdateRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $receive_id = $this->route()->parameters()['receives'];

        return [
            'po_no'         => 'required',
            'ref_no'        => "required|unique:receives,ref_no,{$receive_id}",
            'project_id'    => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'document_no'   => trans('receive.attributes.document_no'),
            'po_no'         => trans('receive.attributes.po_no'),
            'ref_no'        => trans('receive.attributes.ref_no'),
            'project_id'    => trans('receive.attributes.project_id'),
            'status'        => trans('receive.attributes.status'),
        ];
    }
}
