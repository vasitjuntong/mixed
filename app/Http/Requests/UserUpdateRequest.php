<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
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
        $user_id = $this->route()->parameters()['users'];

        return [
            'name' => "required|unique:users,name,{$user_id}",
            'email' => "required|unique:users,email,{$user_id}",
            'password' => "between:5,20|regex:/^[A-Za-z0-9]+/",
        ];
    }
}
