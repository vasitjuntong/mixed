<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReceiveItem
 *
 * @property-read \App\Receive $receive
 * @property-read \App\Product $product
 * @property-read \App\Location $location
 * @property integer $id
 * @property integer $receive_id
 * @property integer $product_id
 * @property string $mix_no
 * @property string $product_code
 * @property string $product_description
 * @property integer $location_id
 * @property string $location_name
 * @property integer $qty
 * @property string $remark
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ReceiveItem extends Model
{
    use ReceiveItemQueryTrait;

    const CREATE = 'create';
    const PADDING = 'padding';
    const SUCCESS = 'success';
    const CANCEL = 'cancel';

    protected $fillable = [
        'receive_id',
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->status == null) {
                $model->status = static::CREATE;
            }

            if ($model->qty == null) {
                $model->qty = 1;
            }

            if ($model->location_id != null) {
                $location = Location::find($model->location_id, ['name']);

                if ($location) {
                    $model->location_name = $location->name;
                }
            }
        });

        static::created(function ($model) {

        });

        static::updating(function ($model) {
            if ($model->qty == null) {
                $model->qty = 1;
            }
        });
    }

    public function receive()
    {
        return $this->belongsTo(Receive::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function statusHtml()
    {
        return statusHtmlRender($this->status);
    }
}
