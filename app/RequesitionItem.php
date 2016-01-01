<?php

namespace App;

use Log;
use Illuminate\Database\Eloquent\Model;

class RequesitionItem extends Model
{
    const CREATE = 'create';
    const PADDING = 'padding';
    const SUCCESS = 'success';
    const CANCEL = 'cancel';

    protected $fillable = [
        'requesition_id',
        'product_id',
        'mix_no',
        'product_code',
        'product_description',
        'location_id',
        'location_name',
        'qty',
        'remark',
        'status',
    ];

    public function requesition()
    {
        return $this->belongsTo(Requesition::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function add($id, $data)
    {
        $product_code = array_get($data, 'product_code');
        $qty_request = array_get($data, 'qty');

        $product = Product::with([
            'stock' => function ($query) {
                $query->where('qty', '>', 0);
                $query->orderBy('qty', 'desc');
            },
            'stock.location',
        ])
            ->where('code', $product_code)
            ->first(['id']);

        $qty = $qty_request;
        foreach ($product->stock as $stock) {
            $qty_hold = 0;

            if($qty == 0){
                break;
            }

            if ($qty > $stock->qty) {

                $qty_hold = $stock->qty;
                $qty = $qty - $qty_hold;

            } else if ($qty == $stock->qty) {

                $qty_hold = $stock->qty;
                $qty = $qty - $qty_hold;

            } else if ($qty < $stock->qty) {
                $qty_hold = $qty;
                $qty = 0;
            }

            $data['requesition_id'] = $id;
            $data['qty'] = $qty_hold;
            $data['location_id'] = $stock->location_id;
            $data['location_name'] = $stock->location->name;
            $data['status'] = self::CREATE;

            if(self::create($data)){
                $stock->qty = $stock->qty - $qty_hold;
                $stock->save();
            }
        }
    }

    public function resetStock()
    {
        $stock = Stock::where('product_id', $this->product_id)
           ->where('location_id', $this->location_id)
           ->first(['id', 'qty']);

        if($stock != null){
            $stock->qty += $this->qty;

            Log::debug('Requesition: reset item qty: success', [
                'product_id' => $this->product_id,
                'location_id' => $this->location_id,
                'qty_return' => $this->qty,
                'qty_total' => $stock->qty,
            ]);

            return $stock->save();
        }

        Log::debug('Requesition: reset item qty: error', [
            'product_id' => $this->product_id,
            'location_id' => $this->location_id,
            'qty_return' => $this->qty,
            'qty_total' => $stock->qty,
        ]);

        return false;
    }

    public function statusHtml()
    {
        return statusHtmlRender($this->status);
    }
}
