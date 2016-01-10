<?php namespace App;

use Log;
use Excel;
use Validator;
use Maatwebsite\Excel\Collections\CellCollection;

class UploadRequesitionItem
{
    protected $errors = [];
    protected $data = [];

    /**
     * @param $path
     * @param $receive_id
     */
    public function upload($path, $receive_id)
    {
        $id = $receive_id;
        $errors = [];
        $data = [];

        Excel::load($path, function ($reader) use (&$errors, $id, &$data) {
            $results = $reader->get();
            $i = 2;

            foreach ($results as $k => $v) {
                $message = [];
                $validate = static::validate($v->toArray());

                if (!$validate->passes()) {
                    foreach ($validate->errors()->toArray() as $key => $error) {
                        $message[] = $error[0];
                    }
                }

                if (empty($message)) {
                    $data[] = static::setData($v);
                } else {
                    $errors[$i] = "Row {$i}: " . implode(', ', $message);
                }

                $i++;
            }
        });

        if (!empty($errors)) {
            $this->errors = $errors;
        }

        $this->data = $data;
    }

    /**
     * @param Receive $receive
     *
     * @return array
     *
     * @throws \Exception
     */
    public function save(Requesition $requesition)
    {
        $result = [];

        if (empty($this->data)) {
            throw new \Exception('Data for save is empty.');
        }

        if (!empty($this->errors)) {
            throw new \Exception('Upload has errors. Please use getErrors() function.');
        }

        $i = 2;
        foreach ($this->data as $data) {
            $validate = static::validate($data);
            if ($validate->passes()) {
                $result[$i] = (new RequesitionItem())->add($requesition->id, $data);
            } else {
                Log::debug('Requesition-item: validate error', [$validate->errors()->toArray()]);
            }

            $i++;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    public static function validate(array $data, array $rules = [], array $attributes = [])
    {
        $rules = $rules ?: static::rules($data);
        $attributes = $attributes ?: static::attributes();

        return Validator::make($data, $rules, [], $attributes);
    }

    public static function rules($data = [])
    {
        $product_code = array_get($data, 'product_code');

        return [
            'group'        => 'required',
            'product_code' => "required|exists:products,code",
            'qty'          => "required|integer|qtyOver:product_code,{$product_code}",
            'unit'         => "required|unitOnProduct:code,{$product_code}",
        ];
    }

    public static function attributes()
    {
        return [
            'group'        => trans('requesition_item_upload.attributes.group'),
            'product_code' => trans('requesition_item_upload.attributes.product_code'),
            'qty'          => trans('requesition_item_upload.attributes.qty'),
            'unit'         => trans('requesition_item_upload.attributes.unit'),
        ];
    }

    public static function setData(CellCollection $v)
    {
        $product = Product::whereCode($v->product_code)->first();

        return [
            'group'               => $v->group,
            'number'              => $v->number,
            'product_id'          => $product->id,
            'product_code'        => $product->code,
            'mix_no'              => $product->mix_no,
            'product_description' => $product->description,
            'qty'                 => $v->qty,
            'unit'                => $v->unit,
            'remark'              => $v->remark,
        ];
    }
}

