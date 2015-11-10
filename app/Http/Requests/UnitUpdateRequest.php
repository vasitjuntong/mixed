<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UnitUpdateRequest extends Request
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
        $unit_id = $this->route()->parameters()['units'];

        return [
            'name' => "required|regex:/^[A-Za-z0-9ก-๙]+/|unique:units,name,{$unit_id}",
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('unit.attributes.name'),
        ];
    }   
}
