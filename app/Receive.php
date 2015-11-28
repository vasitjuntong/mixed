<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    	DB::transaction(function(){
	    	$this->status = static::PADDING;

	    	foreach($this->receiveItems as $item){
	    		$item->status = static::PADDING;

	    		$item->save();
	    	}

	    	$this->save();
    	});
    }

   	public function statusHtml()
   	{

   		return statusHtmlRender($this->status);
   	}
}
