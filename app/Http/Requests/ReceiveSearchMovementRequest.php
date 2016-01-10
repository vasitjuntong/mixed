<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReceiveSearchMovementRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'created_at_end' => 'required',
            'created_at_start'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'created_at_start' => trans('receive.form_search.created_at_start'),
            'created_at_end'   => trans('receive.form_search.created_at_end'),
        ];
    }   
}
