<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocationCreateRequest extends Request
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

    public function rules()
    {
        return [
            'name' => 'required|unique:locations|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('location.attributes.name'),
        ];
    }   
}
