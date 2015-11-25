<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddProductReceiveRequest extends Request
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
            'product_id'    => 'required|exists:products,code',
            'location_id'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'product_id'    => trans('product.attributes.code'),
            'location_id'   => trans('location.attributes.name'),
        ];
    }
}
