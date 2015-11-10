<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocationUpdateRequest extends Request
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
        $location_id = $this->route()->parameters()['locations'];

        return [
            'name' => "required|regex:/^[A-Za-z0-9ก-๙]+/|unique:locations,name,{$location_id}",
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('location.attributes.name'),
        ];
    } 
}
