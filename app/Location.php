<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Location
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReceiveItem[] $receiveItems
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Stock[] $stocks
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Location extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $products = Product::all();
            foreach ($products as $product) {
                $model->stocks()->create([
                    'product_id' => $product->id,
                    'qty'        => 0,
                ]);
            }
        });
    }

    public function receiveItems()
    {
        return $this->hasMany(ReceiveItem::class, 'location_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public static function deleteByCondition($id)
    {
        $query = self::with([
            'receiveItems',
            'stocks' => function ($query) {
                $query->where('qty', '>', 0);
            },
        ])
            ->where('id', $id)
            ->first();

        if ($query->receiveItems->count() || $query->stocks->count()) {
            return [
                'status'  => false,
                'title'   => trans('location.label.name'),
                'message' => trans('location.message_alert.delete_unsuccess'),
            ];
        }

        $response = $query->delete();

        return [
            'status'  => $response,
            'title'   => trans('location.label.name'),
            'message' => trans('location.message_alert.delete_success'),
        ];
    }
}
