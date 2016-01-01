<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequesitionItemAddProductRequest extends Request
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
            'product_code'  => 'required|exists:products,code',
            'location_id'   => 'required',
            'qty'           => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'product_code'      => trans('product.attributes.code'),
            'location_id'       => trans('location.attributes.name'),
            'qty'               => trans('requesition_item.attributes.qty'),
        ];
    }
}
