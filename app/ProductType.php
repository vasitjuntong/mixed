<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProductType extends Model
{
    protected $table = 'product_types';

    protected $fillable = [
        'name',
        'code_prefix',
        'code_default',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id', 'id');
    }

    public static function deleteByCondition($id)
    {
        $query = self::with([
            'products',
        ])
            ->where('id', $id)
            ->first();

        if ($query->products()->count()) {
            return [
                'status'  => false,
                'title'   => trans('product_type.label.name'),
                'message' => trans('product_type.message_alert.delete_unsuccess'),
            ];
        }

        $response = $query->delete();

        return [
            'status'  => $response,
            'title'   => transfont('product_type.label.name'),
            'message' => trans('product_type.message_alert.delete_success'),
        ];
    }

    public static function listSelect()
    {

    }
}
