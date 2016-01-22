<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MovementAllSearchRequest extends Request
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
            'created_at_start' => 'required',
            'created_at_end'   => 'required',
        ];
    }
}
