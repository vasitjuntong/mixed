<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
    	'name',
    ];

    public function products()
    {
    	return $this->hasMany(Product::class, 'unit_id', 'id');
    }

    public static function deleteByCondition($id)
    {
    	$query = self::with(array(
				'products'
			))
			->whereId($id)
			->first();

		if($query->products()->count())
			return [
				'status' => false,
				'title' => trans('unit.label.name'),
				'message' => trans('unit.message_alert.delete_unsuccess'),
			];

		$response = $query->delete();

		return [
			'status' => $response,
			'title' => trans('unit.label.name'),
			'message' => trans('unit.message_alert.delete_success'),
		];
    }
}
