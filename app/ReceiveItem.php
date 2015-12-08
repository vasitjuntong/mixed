<?php

namespace App;

use App\Location;
use Illuminate\Database\Eloquent\Model;

class ReceiveItem extends Model
{
	const CREATE 	= 'create';
	const PADDING 	= 'padding';
	const SUCCESS 	= 'success';
	const CANCEL 	= 'cancel';

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

	    static::creating(function ($model)
	    {
	    	if($model->status == null)
	    		$model->status = static::CREATE;

	    	if($model->qty == null)
	    		$model->qty = 1;

	    	if($model->location_id != null){
	    		$location = Location::find($model->location_id, ['name']);

	    		if($location)
	    			$model->location_name = $location->name;
	    	}
	    });

	    static::created(function ($model)
    	{

    	});

    	static::updating(function ($model)
    	{
    		if($model->qty == null)
    			$model->qty = 1;
    	});
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

   	public function statusHtml()
   	{

   		return statusHtmlRender($this->status);
   	}
}
