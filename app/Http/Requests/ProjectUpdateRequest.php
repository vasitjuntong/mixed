<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectUpdateRequest extends Request
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
        $project_id = $this->route()->parameters()['projects'];

        return [
            'code' => "required|regex:/^[A-Za-z0-9ก-๙]+/|unique:projects,code,{$project_id}",
        ];
    }

    public function attributes()
    {
        return [
            'code' => trans('project.attributes.code'),
        ];
    } 
}
