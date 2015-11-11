<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductTypeUpdateRequest extends Request
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
        $product_type_id = $this->route()->parameters()['product_types'];

        return [
            'name' => "required|regex:/^[A-Za-z0-9ก-๙]+/|unique:product_types,name,{$product_type_id}",
            'code_prefix'   => 'integer|max:255',
            'code_default'  => 'integer|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('product_type.attributes.name'),
        ];
    } 
}
