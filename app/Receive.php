<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Receive extends Model
{
    const CREATE 	= 'create';
    const PADDING 	= 'padding';
    const SUCCESS 	= 'success';
    const CANCEL 	= 'cancel';

    protected $fillable = [
		'document_no',
		'po_no',
		'ref_no',
		'project_id',
		'project_code',
		'status',
		'remark',
		'created_at',
		'updated_at',
    ];

    public static function boot()
	{
	    parent::boot();

	    static::creating(function ($model)
	    {
	    	if($model->status == null)
	    		$model->status = static::CREATE;
	    });

	    static::created(function ($model)
	    {
	    	$model->document_no = 'DC' . (1000000 + $model->id);

	    	$model->save();
	    });
    }

    public function receiveItems()
    {
    	return $this->hasMany(ReceiveItem::class);
    }

    public function setStatusPadding()
    {
    	$this->status = static::PADDING;

    	foreach($this->receiveItems as $item){
    		$item->status = ReceiveItem::PADDING;

    		Log::debug('set-status-receive-padding: line item', [
    			'receive' => $this->toArray(),
			]);

    		$item->save();
    	}

    	$this->save();
    }

    public function setStatusSuccess($successItems)
    {
    	$statusReceive = false;

    	foreach($this->receiveItems as $item){
    		if(in_array($item->id, $successItems)){
    			$item->status = ReceiveItem::SUCCESS;

		    	Log::debug('set-status-receive-item-success: line item', [
		    		'receive&items' => $this->toArray(),
				]);

    			$item->save();
    		}
    	}

    	$totalItem = $this->receiveItems()
    		->count(['id']);

    	$success = $this->receiveItems()
    		->whereStatus(ReceiveItem::SUCCESS)
    		->count(['id']);

    	if($success == $totalItem){
    		$this->status = static::SUCCESS;

    		$this->save();
    	}

    	Log::debug('set-status-receive-item-success', [
    		'success' => $success,
    		'totalItem' => $totalItem,
		]);
    }

   	public function statusHtml()
   	{

   		return statusHtmlRender($this->status);
   	}
}
