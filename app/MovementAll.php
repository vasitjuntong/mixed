<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\MovementAll
 *
 * @property integer $id
 * @property string $table_id
 * @property string $type
 * @property string $project
 * @property string $dn
 * @property string $ref_no
 * @property string $po_no
 * @property string $created_by
 * @property string $product_mix_no
 * @property string $product_description
 * @property string $product_qty
 * @property string $product_unit
 * @property string $product_remark
 * @property string $location_or_site_name
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
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
        'ref_no',
        'po_no',
        'created_by',
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

    public static function whereFilterAll(array $filter, $itemStatus, array $orderBy)
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

        return $model->get();
    }

    public function statusHtml()
    {
        return statusHtmlRender($this->status);
    }
}
