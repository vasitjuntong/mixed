<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MovementAll extends Model
{
    const STATUS_CEATE = 'create';
    const STATUS_PADDING = 'padding';
    const STATUS_SUCCESS = 'success';
    const STATUS_CANCEL = 'cancel';

    const TYPE_RECEIVE = 'receive';
    const TYPE_REQUISITION = 'requisition';

    protected $fillable = [
        'table_id',
        'type',
        'project',
        'dn',
        'product_mix_no',
        'product_description',
        'product_qty',
        'product_unit',
        'location_or_site_name',
        'status',
    ];

    public static function whereFilter(array $filter, $itemStatus, $orderBy)
    {
        $model = static::where(function ($query) use ($filter, $itemStatus) {
            $project = array_get($filter, 'project');
            if ($project != null) {
                $query->where('project', $project);
            }

            $dn = array_get($filter, 'dn');
            if ($dn != null) {
                $query->where('dn', 'LIKE', "%$dn%");
            }

            $productPoNo = array_get($filter, 'po_no');
            if ($productPoNo != null) {
                $query->where('product_po_no', 'LIKE', "%$productPoNo%");
            }

            $item_status = array_get($filter, 'item_status');
            if ($item_status != null) {
                $query->whereIn('status', $item_status);
            }

            $created_at_start = array_get($filter, 'created_at_start');
            $created_at_end = array_get($filter, 'created_at_end');

            if ($created_at_start != null && $created_at_end != null) {
                $created_at_start = changeFormatDateToDb($created_at_start);
                $created_at_end = changeFormatDateToDb($created_at_end);

                $query->whereBetween('created_at', [
                    "{$created_at_start} 00:00:00",
                    "{$created_at_end} 23:59:59",
                ]);
            }
        });

        $keys = array_keys($orderBy);
        foreach ($keys as $key) {
            $keyReplace = str_replace('__', '.', $key);
            $model->orderBy($keyReplace, $orderBy[$key]);
        }

        return $model->paginate(30);
    }

    public function statusHtml()
    {
        return statusHtmlRender($this->status);
    }
}
