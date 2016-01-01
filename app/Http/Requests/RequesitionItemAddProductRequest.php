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
        $product_code = request()->get('product_code');

        return [
            'product_code'  => 'required|exists:products,code',
            'qty'           => "required|integer|qtyOver:product_code,{$product_code}",
        ];
    }

    public function attributes()
    {
        return [
            'product_code'      => trans('product.attributes.code'),
            'qty'               => trans('requesition_item.attributes.qty'),
        ];
    }
}
