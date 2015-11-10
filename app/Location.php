<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
    	'name',
    ];

    public function receiveItems()
    {
    	return $this->hasMany(ReceiveItem::class, 'location_id', 'id');
    }

    public static function deleteByCondition($id)
    {
    	$query = self::with([
    			'receiveItems',
    		])
    		->where('id', $id)
    		->first();

    	if($query->receiveItems()->count())
			return [
				'status' => false,
				'title' => trans('location.label.name'),
				'message' => trans('location.message_alert.delete_unsuccess'),
			];

		$response = $query->delete();

		return [
			'status' => $response,
			'title' => trans('location.label.name'),
			'message' => trans('location.message_alert.delete_success'),
		];
    }
}
