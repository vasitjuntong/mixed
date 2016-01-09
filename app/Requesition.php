<?php

namespace App;

use Log;
use Illuminate\Database\Eloquent\Model;

class Requesition extends Model
{
    const CREATE = 'create';
    const PADDING = 'padding';
    const SUCCESS = 'success';
    const CANCEL = 'cancel';

    protected $fillable = [
        'user_id',
        'project_id',
        'project_code',
        'site_id',
        'site_name',
        'receive_company_name',
        'receive_contact_name',
        'receive_phone',
        'receive_date',
        'status',
    ];

    protected $dates = ['receive_date'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->status == null) {
                $model->status = static::CREATE;
            }

            $model->document_no = $model->genDoNo();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(RequesitionItem::class);
    }

    public static function whereByFilter(array $filter, $limit = 20)
    {
        return static::with([
            'user',
            'project',
        ])
            ->paginate($limit);
    }

    public function statusHtml()
    {
        return statusHtmlRender($this->status);
    }

    public function setStatusSuccess($items)
    {
        foreach ($this->items as $item) {
            if (in_array($item->id, $items)) {
                $item->status = RequesitionItem::SUCCESS;

                Log::debug('set-status-requesition-item-success: line item', [
                    'requesition&items' => $this->toArray(),
                ]);

                $item->save();
            }
        }

        $padding = $this->items()
            ->whereStatus(RequesitionItem::PADDING)
            ->count(['id']);

        if ($padding == 0) {
            $this->status = static::SUCCESS;

            $this->save();
        }

        Log::debug('set-status-receive-item-success', [
        ]);
    }

    public function setStatusCancel($items)
    {
        foreach ($this->items as $item) {
            if (in_array($item->id, $items)) {
                $item->status = RequesitionItem::CANCEL;

                if($item->save()){
                    Log::info('Requesition-item: set canel item', [
                        'requesition_id' => $item->requesition_id,
                        'product_id' => $item->product_id,
                        'location_id' => $item->location_id,
                    ]);
                }
            }
        }

        $padding = $this->items()
            ->whereStatus(RequesitionItem::PADDING)
            ->count(['id']);

        if ($padding == 0) {
            $total = $this->items()
                ->count(['id']);

            $cancel = $this->items()
                ->whereStatus(Requesition::CANCEL)
                ->count(['id']);

            if ($total == $cancel) {
                $this->status = static::CANCEL;
            } else {
                $this->status = static::SUCCESS;
            }

            $this->save();
        }
    }

    public function resetStockByItemId($item_id)
    {

    }

    public function genDoNo()
    {
        $prefix = "IS" . date('Ym');
        $number = 001;

        $requesitionNumber = RequesitionNumber::whereName($prefix)
            ->first();

        if (is_null($requesitionNumber)) {
            RequesitionNumber::create([
                'name' => $prefix,
                'number' => $number,
            ]);
        } else {
            $number = $requesitionNumber->number + 1;

            $requesitionNumber->number = $number;
            $requesitionNumber->save();
        }

        $number = $this->genO($number);

        return "{$prefix}-{$number}";
    }

    public function genO($number)
    {
        $count = strlen($number);

        switch ($count) {
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
}
