<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductTypeCreateRequest extends Request
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
            'name'          => 'required|unique:product_types|max:255',
            'code_prefix'   => 'integer',
            'code_default'  => 'integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('product_type.attributes.name'),
            'code_prefix' => trans('product_type.attributes.code_prefix'),
            'code_default' => trans('product_type.attributes.code_default'),
        ];
    }   
}
