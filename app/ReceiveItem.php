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

    public static function whereByFilterAll(array $filter)
    {
    	return static::with([
            'receive',
            'receive.user',
            'product',
            'product.unit',
        ])
        ->where(function($query) use ($filter){
            $po_no = array_get($filter, 'po_no');
            if( ! is_null($po_no)){
            	$query->whereHas('receive', function($query) use ($po_no) { 
                	$query->where('po_no', 'like', "%{$po_no}%");
            	});
            }

            $document_no = array_get($filter, 'document_no');
            if( ! is_null($document_no)){
            	$query->whereHas('receive', function($query) use ($document_no) {
                	$query->where('document_no', 'like', "%{$document_no}%");
            	});
            }

            $ref_no = array_get($filter, 'ref_no');
            if( ! is_null($ref_no)){
            	$query->whereHas('receive', function($query) use ($ref_no) {
                	$query->where('ref_no', 'like', "%{$ref_no}%");
            	});
            }

            $project = array_get($filter, 'project');
            if( ! is_null($project)){
                $query->whereHas('receive.project', function($query) use ($project) {
                    $query->where('code', 'like', "%{$project}%");
                });
            }

            $create_by = array_get($filter, 'create_by');
            if( ! is_null($create_by)){
                $query->whereHas('receive.user', function($query) use ($create_by) {
                    $query->orWhere('name', 'like', "%{$create_by}%");
                    $query->orWhere('email', 'like', "%{$create_by}%");
                });
            }

            $item_status = array_get($filter, 'item_status');
            if( ! is_null($item_status)){
                $query->whereIn('status', $item_status);
            }

            $created_at_start = array_get($filter, 'created_at_start');
            $created_at_end = array_get($filter, 'created_at_end');

            if($created_at_start != null && $created_at_end != null){
                $created_at_start = changeFormatDateToDb($created_at_start);
                $created_at_end = changeFormatDateToDb($created_at_end);

                $query->whereHas('receive', function($query) use ($created_at_start, $created_at_end) {
	                $query->whereBetween('created_at', [
	                    "{$created_at_start} 00:00:00",
	                    "{$created_at_end} 23:59:59",
	                ]);
                });
            }
        })
        ->orderBy('receive_id', 'desc')
        ->get();
    }

    public static function whereByFilter(array $filter, $limit = 20)
    {
    	return static::with([
            'receive',
            'receive.user',
            'product',
            'product.unit',
        ])
        ->where(function($query) use ($filter){
            $po_no = array_get($filter, 'po_no');
            if( ! is_null($po_no)){
            	$query->whereHas('receive', function($query) use ($po_no) { 
                	$query->where('po_no', 'like', "%{$po_no}%");
            	});
            }

            $document_no = array_get($filter, 'document_no');
            if( ! is_null($document_no)){
            	$query->whereHas('receive', function($query) use ($document_no) {
                	$query->where('document_no', 'like', "%{$document_no}%");
            	});
            }

            $ref_no = array_get($filter, 'ref_no');
            if( ! is_null($ref_no)){
            	$query->whereHas('receive', function($query) use ($ref_no) {
                	$query->where('ref_no', 'like', "%{$ref_no}%");
            	});
            }

            $project = array_get($filter, 'project');
            if( ! is_null($project)){
                $query->whereHas('receive.project', function($query) use ($project) {
                    $query->where('code', 'like', "%{$project}%");
                });
            }

            $create_by = array_get($filter, 'create_by');
            if( ! is_null($create_by)){
                $query->whereHas('receive.user', function($query) use ($create_by) {
                    $query->orWhere('name', 'like', "%{$create_by}%");
                    $query->orWhere('email', 'like', "%{$create_by}%");
                });
            }

            $item_status = array_get($filter, 'item_status');
            if( ! is_null($item_status)){
                $query->whereIn('status', $item_status);
            }

            $created_at_start = array_get($filter, 'created_at_start');
            $created_at_end = array_get($filter, 'created_at_end');

            if($created_at_start != null && $created_at_end != null){
                $created_at_start = changeFormatDateToDb($created_at_start);
                $created_at_end = changeFormatDateToDb($created_at_end);

                $query->whereHas('receive', function($query) use ($created_at_start, $created_at_end) {
	                $query->whereBetween('created_at', [
	                    "{$created_at_start} 00:00:00",
	                    "{$created_at_end} 23:59:59",
	                ]);
                });
            }
        })
        ->orderBy('receive_id', 'desc')
        ->paginate($limit);
    }

    public function receive()
    {
    	return $this->belongsTo(Receive::class);
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
