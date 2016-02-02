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
 * @property-read \App\User $user
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
            MovementAll::create([
                'table_id' => $model->id,
                'type' => MovementAll::TYPE_RECEIVE,
                'project' => $model->receive->project->code,
                'dn' => $model->receive->document_no,
                'po_no' => $model->receive->po_no,
                'ref_no' => $model->receive->ref_no,
                'created_by' => auth()->user()->name,
                'product_mix_no' => $model->product->mix_no,
                'product_description' => $model->product->description,
                'product_qty' => $model->qty,
                'product_unit' => $model->product->unit->name,
                'location_or_site_name' => $model->location->name,
                'status' => $model->status,
            ]);
        });

        static::updating(function ($model) {
            if ($model->qty == null) {
                $model->qty = 1;
            }
        });

        static::updated(function ($model) {

            $movement = MovementAll::where('table_id', $model->id)
                ->where('type', MovementAll::TYPE_RECEIVE)
                ->first();

            $movement->status = $model->status;
            $movement->save();

        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
