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
        'user_id',
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

            $model->document_no = $model->genDoNo();
	    });
    }

    public function receiveItems()
    {
    	return $this->hasMany(ReceiveItem::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    	$padding = $this->receiveItems()
    		->whereStatus(ReceiveItem::PADDING)
    		->count(['id']);

    	if($padding == 0){
    		$this->status = static::SUCCESS;

    		$this->save();

            // Add stock by receive item from receive.
            $this->addStock();
    	}

    	Log::debug('set-status-receive-item-success', [
		]);
    }

   	public function statusHtml()
   	{

   		return statusHtmlRender($this->status);
   	}

    public function genDoNo()
    {
        $prefix = "GR" . date('Ym');
        $number = 001;

        $receiveNumber = ReceiveNumber::whereName($prefix)
            ->first();

        if(is_null($receiveNumber)){
            ReceiveNumber::create([
                'name' => $prefix,
                'number' => $number,
            ]);
        }else{
            $number = $receiveNumber->number + 1;

            $receiveNumber->number = $number;
            $receiveNumber->save();
        }

        $number = $this->genO($number);

        return "{$prefix}-{$number}";
    }

    public function genO($number)
    {
        $count = strlen($number);

        switch($count){
            case 1:
                return '00' . $number;
                break;
            case 2: 
                return '0' . $number;
                break;
            default:
                return $number;
                break;
        }
    }

    public function addStock()
    {
        $items = $this->receiveItems;

        foreach($items as $item){
            $stock = $item->product->stock()->first();
            $stockNow = $stock->qty;

            $stockAdd = $item->qty;

            $stock->qty = $stockNow + $stockAdd;

            Log::info('add-stock: receive item', [
                'product' => $item->product->toArray(),
                'stockNow' => $stockNow,
                'stockAdd' => $stockAdd,
                'StockNew' => $stock->qty,
            ]);

            $stock->save();
        }
    }
}
