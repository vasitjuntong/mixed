<?php

namespace App\Http\Requests;

class RequesitionItemUploadRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:xls,xlsx',
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [
            'file' => trans('receive_item_upload.attributes.file'),
        ];
    }
}
