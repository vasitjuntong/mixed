<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequesitionCreateRequest extends Request
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
            'project_id'    => 'required',
            'site_id'       => 'required|max:255',
            'site_name'     => 'required|max:255',
            'receive_company_name' => 'required|max:255',
            'receive_contact_name' => 'required|max:255',
            'receive_phone'        => 'required|max:255',
            'receive_date'         => 'required|date_format:Y-m-d',
        ];
    }
}
