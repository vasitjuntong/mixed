<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReceiveCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'po_no'         => 'required',
            'ref_no'        => 'required|unique:receives',
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
