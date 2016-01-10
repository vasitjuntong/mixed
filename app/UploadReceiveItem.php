<?php namespace App;

use Log;
use Excel;
use Validator;
use Maatwebsite\Excel\Collections\CellCollection;

class UploadReceiveItem
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

                if (static::checkReceiveItemExists($id, $v->product_code, $v->location)) {
                    $message[] = 'Product is exists on the Receive.';
                }

                if (!$validate->passes()) {
                    foreach ($validate->errors()->toArray() as $key => $error) {
                        $message[] = $error[0];
                    }
                }

                if (empty($message)) {
                    $data[] = static::setData($v);
                } else {
                    $errors[$i] = "Row {$i}: " . implode(' ,', $message);
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
    public function save(Receive $receive)
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
            $count = $receive->receiveItems()
                ->where('product_id', array_get($data, 'product_id'))
                ->where('location_id', array_get($data, 'location_id'))
                ->count();

            if (!$count) {
                $result[$i] = $receive->receiveItems()
                    ->save(new ReceiveItem($data));
            } else {
                Log::warning('upload-receive-item: product is exists on receive_items table.', [
                    $data,
                ]);
            }

            $i ++;
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
        $rules = $rules ?: static::rules();
        $attributes = $attributes ?: static::attributes();

        return Validator::make($data, $rules, [], $attributes);
    }

    public static function rules()
    {
        return [
            'product_code' => "required|exists:products,code",
            'location'     => 'required|exists:locations,name',
            'qty'          => 'required|integer',
        ];
    }

    public static function attributes()
    {
        return [
            'product_code' => trans('product.attributes.code'),
            'location'     => trans('location.attributes.name'),
            'qty'          => trans('receive_item.attributes.qty'),
            'remark'       => trans('receive_item.attributes.remark'),
        ];
    }

    /**
     * @param $receive_id
     * @param $product_code
     * @param $location
     *
     * @return bool
     */
    public static function checkReceiveItemExists($receive_id, $product_code, $location)
    {
        $receive = Receive::whereHas('receiveItems', function ($query) use ($product_code, $location) {
            $query->where('product_code', $product_code);
            $query->where('location_name', $location);
        })
            ->whereId($receive_id)
            ->count();

        if (!$receive) {
            return false;
        }

        return true;
    }

    public static function setData(CellCollection $v)
    {
        $product = Product::whereCode($v->product_code)->first();
        $location = Location::whereName($v->location)->first();

        return [
            'product_id'          => $product->id,
            'product_code'        => $product->code,
            'mix_no'              => $product->mix_no,
            'product_description' => $product->description,
            'location_id'         => $location->id,
            'location_name'       => $location->name,
            'qty'                 => $v->qty,
            'remark'              => $v->remark,
        ];
    }
}

