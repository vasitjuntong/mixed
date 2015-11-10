<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectCreateRequest extends Request
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
            'code' => 'required|unique:projects|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'code' => trans('project.attributes.code'),
        ];
    }   
}
