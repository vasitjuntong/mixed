<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductCreateRequest extends Request
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
            'product_type_id'   => 'required',
            'unit_id'           => 'required',
            'mix_no'            => 'required|unique:products',
            'code'              => 'required|unique:products|max:255',
            'description'       => 'required',
            'stock_min'         => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'product_type_id'   => trans('product.attributes.product_type_id'),
            'unit_id'           => trans('product.attributes.unit_id'),
            'mix_no'            => trans('product.attributes.mix_no'),
            'code'              => trans('product.attributes.code'),
            'description'       => trans('product.attributes.description'),
            'stock_min'         => trans('product.attributes.stock_min'),
            'use_serial_no'     => trans('product.attributes.use_serial_no'),
            'pic_path'          => trans('product.attributes.pic_path'),
            'pic_name'          => trans('product.attributes.pic_name'),
            'created_at'        => trans('product.attributes.created_at'),
            'updated_at'        => trans('product.attributes.updated_at'),
        ];
    }   
}
