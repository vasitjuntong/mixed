<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequesitionSearchMovementRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'created_at_start' => 'required',
            'created_at_end' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'created_at_start' => trans('requesition.form_search.created_at_start'),
            'created_at_end' => trans('requesition.form_search.created_at_end'),
        ];
    }
}
