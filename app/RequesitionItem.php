<?php

namespace App;

use Log;
use Illuminate\Database\Eloquent\Model;

/**
 * App\RequesitionItem
 *
 * @property-read \App\Requesition $requesition
 * @property-read \App\Product $product
 * @property-read \App\Location $location
 * @property integer $id
 * @property integer $requesition_id
 * @property integer $product_id
 * @property string $group
 * @property string $number
 * @property string $mix_no
 * @property string $product_code
 * @property string $product_description
 * @property integer $location_id
 * @property string $location_name
 * @property integer $qty
 * @property string $remark
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class RequesitionItem extends Model
{
    const CREATE = 'create';
    const PADDING = 'padding';
    const SUCCESS = 'success';
    const CANCEL = 'cancel';

    protected $fillable = [
        'requesition_id',
        'product_id',
        'group',
        'number',
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
        static::created(function($model) {
            MovementAll::create([
                'table_id' => $model->id,
                'type' => MovementAll::TYPE_REQUISITION,
                'project' => $model->requesition->project->code,
                'dn' => $model->requesition->document_no,
                'po_no' => $model->requesition->po_no,
                'ref_no' => $model->requesition->ref_no,
                'created_by' => auth()->user()->name,
                'product_mix_no' => $model->product->mix_no,
                'product_description' => $model->product->description,
                'product_qty' => $model->qty,
                'product_unit' => $model->product->unit->name,
                'location_or_site_name' => $model->requesition->site_name,
                'status' => $model->status,
            ]);
        });


        static::updated(function($model) {

            $movement = MovementAll::where('table_id', $model->id)
                ->where('type', MovementAll::TYPE_REQUISITION)
                ->first();

            $movement->status = $model->status;
            $movement->save();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requesition()
    {
        return $this->belongsTo(Requesition::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public static function whereByFilterAll(array $filter, array $orderBy = array())
    {
        $model = static::select('requesition_items.*')
            ->with([
                'requesition',
                'requesition.user',
                'product',
                'product.unit',
                'location',
            ])
            ->leftJoin('requesitions', 'requesition_items.requesition_id', '=', 'requesitions.id')
            ->join('products', 'requesition_items.product_id', '=', 'products.id')
            ->join('locations', 'requesition_items.location_id', '=', 'locations.id')
            ->join('users', 'requesitions.user_id', '=', 'users.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->join('projects', 'requesitions.project_id', '=', 'projects.id')
            ->where(function ($query) use ($filter) {
                $mix_no = array_get($filter, 'mix_no');
                if (!is_null($mix_no)) {
                    $query->where('requesition_items.mix_no', 'like', "%{$mix_no}%");
                }

                $product_code = array_get($filter, 'product_code');
                if (!is_null($product_code)) {
                    $query->where('requesition_items.product_code', 'like', "%{$product_code}%");
                }

                $site_id = array_get($filter, 'site_id');
                if (!is_null($site_id)) {
                    $query->whereHas('requesition', function ($query) use ($site_id) {
                        $query->where('site_id', 'like', "%{$site_id}%");
                    });
                }

                $document_no = array_get($filter, 'document_no');
                if (!is_null($document_no)) {
                    $query->whereHas('requesition', function ($query) use ($document_no) {
                        $query->where('document_no', 'like', "%{$document_no}%");
                    });
                }

                $site_name = array_get($filter, 'site_name');
                if (!is_null($site_name)) {
                    $query->whereHas('requesition', function ($query) use ($site_name) {
                        $query->where('site_name', 'like', "%{$site_name}%");
                    });
                }

                $project = array_get($filter, 'project');
                if (!is_null($project)) {
                    $query->where('projects.code', 'like', "%{$project}%");
                }

                $create_by = array_get($filter, 'create_by');
                if (!is_null($create_by)) {
                    $query->where(function ($query) use ($create_by) {
                        $query->orWhere('users.name', 'like', "%{$create_by}%");
                        $query->orWhere('users.email', 'like', "%{$create_by}%");
                    });
                }

                $item_status = array_get($filter, 'item_status');
                if (!is_null($item_status)) {
                    $query->whereIn('requesition_items.status', $item_status);
                }

                $created_at_start = array_get($filter, 'created_at_start');
                $created_at_end = array_get($filter, 'created_at_end');

                if ($created_at_start != null && $created_at_end != null) {
                    $created_at_start = changeFormatDateToDb($created_at_start);
                    $created_at_end = changeFormatDateToDb($created_at_end);

                    $query->whereHas('requesition', function ($query) use ($created_at_start, $created_at_end) {
                        $query->whereBetween('requesitions.created_at', [
                            "{$created_at_start} 00:00:00",
                            "{$created_at_end} 23:59:59",
                        ]);
                    });
                }
            });

        if (!empty($orderBy)) {
            $keys = array_keys($orderBy);
            foreach ($keys as $key) {
                $keyReplace = str_replace('__', '.', $key);
                $model->orderBy($keyReplace, $orderBy[$key]);
            }
        } else {
            $model->orderBy('requesitions.created_at', 'desc');
        }

        $created_at_start = array_get($filter, 'created_at_start');
        $created_at_end = array_get($filter, 'created_at_end');

        if ($created_at_start == null && $created_at_end == null) {

            return new static;
        }

        return $model->get();
    }

    public static function whereByFilter(array $filter, $limit = 20, array $orderBy = array())
    {
        $model = static::select('requesition_items.*')
            ->with([
                'requesition',
                'requesition.user',
                'product',
                'product.unit',
                'location',
            ])
            ->leftJoin('requesitions', 'requesition_items.requesition_id', '=', 'requesitions.id')
            ->join('products', 'requesition_items.product_id', '=', 'products.id')
            ->join('locations', 'requesition_items.location_id', '=', 'locations.id')
            ->join('users', 'requesitions.user_id', '=', 'users.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->join('projects', 'requesitions.project_id', '=', 'projects.id')
            ->where(function ($query) use ($filter) {
                $mix_no = array_get($filter, 'mix_no');
                if (!is_null($mix_no)) {
                    $query->where('requesition_items.mix_no', 'like', "%{$mix_no}%");
                }

                $product_code = array_get($filter, 'product_code');
                if (!is_null($product_code)) {
                    $query->where('requesition_items.product_code', 'like', "%{$product_code}%");
                }
                
                $site_id = array_get($filter, 'site_id');
                if (!is_null($site_id)) {
                    $query->whereHas('requesition', function ($query) use ($site_id) {
                        $query->where('site_id', 'like', "%{$site_id}%");
                    });
                }

                $document_no = array_get($filter, 'document_no');
                if (!is_null($document_no)) {
                    $query->whereHas('requesition', function ($query) use ($document_no) {
                        $query->where('document_no', 'like', "%{$document_no}%");
                    });
                }

                $site_name = array_get($filter, 'site_name');
                if (!is_null($site_name)) {
                    $query->whereHas('requesition', function ($query) use ($site_name) {
                        $query->where('site_name', 'like', "%{$site_name}%");
                    });
                }

                $project = array_get($filter, 'project');
                if (!is_null($project)) {
                    $query->where('projects.code', 'like', "%{$project}%");
                }

                $create_by = array_get($filter, 'create_by');
                if (!is_null($create_by)) {
                    $query->where(function ($query) use ($create_by) {
                        $query->orWhere('users.name', 'like', "%{$create_by}%");
                        $query->orWhere('users.email', 'like', "%{$create_by}%");
                    });
                }

                $item_status = array_get($filter, 'item_status');
                if (!is_null($item_status)) {
                    $query->whereIn('requesition_items.status', $item_status);
                }

                $created_at_start = array_get($filter, 'created_at_start');
                $created_at_end = array_get($filter, 'created_at_end');

                if ($created_at_start != null && $created_at_end != null) {
                    $created_at_start = changeFormatDateToDb($created_at_start);
                    $created_at_end = changeFormatDateToDb($created_at_end);

                    $query->whereHas('requesition', function ($query) use ($created_at_start, $created_at_end) {
                        $query->whereBetween('requesitions.created_at', [
                            "{$created_at_start} 00:00:00",
                            "{$created_at_end} 23:59:59",
                        ]);
                    });
                }
            });

        if (!empty($orderBy)) {
            $keys = array_keys($orderBy);
            foreach ($keys as $key) {
                $keyReplace = str_replace('__', '.', $key);
                $model->orderBy($keyReplace, $orderBy[$key]);
            }
        } else {
            $model->orderBy('requesitions.created_at', 'desc');
        }

        $created_at_start = array_get($filter, 'created_at_start');
        $created_at_end = array_get($filter, 'created_at_end');

        if ($created_at_start == null && $created_at_end == null) {

            return new \Illuminate\Pagination\Paginator([], 20);
        }

        return $model->paginate($limit);
    }

    public function add($id, $data)
    {
        $errorItemInRequestDup = array();

        $product_code = array_get($data, 'product_code');
        $qty_request = array_get($data, 'qty');

        $product = Product::with([
            'stock' => function ($query) {
                $query->where('qty', '>', 0);
                $query->orderBy('qty', 'desc');
            },
            'stock.location',
        ])
            ->where('code', $product_code)
            ->first(['id']);

        $qty = $qty_request;
        foreach ($product->stock as $stock) {
            $qty_hold = 0;

            if($qty == 0){
                break;
            }

            if ($qty > $stock->qty) {

                $qty_hold = $stock->qty;
                $qty = $qty - $qty_hold;

            } else if ($qty == $stock->qty) {

                $qty_hold = $stock->qty;
                $qty = $qty - $qty_hold;

            } else if ($qty < $stock->qty) {
                $qty_hold = $qty;
                $qty = 0;
            }

            $data['requesition_id'] = $id;
            $data['qty'] = $qty_hold;
            $data['location_id'] = $stock->location_id;
            $data['location_name'] = $stock->location->name;
            $data['status'] = static::CREATE;

            if(! $this->checkItemInRequest($id, $product_code, $stock->location_id)){
                if(static::create($data)){
                    $stock->qty = $stock->qty - $qty_hold;
                    // $stock->save();
                }
            }else{
                $errorItemInRequestDup[] = $product_code;
            }

            if(! empty($errorItemInRequestDup)){
                flash()
                    ->error(
                        trans('requesition_item.label.name'),
                        trans('requesition_item.message_alert.item_duplicate_on_request')
                    );
            }
        }
    }

    public function checkItemInRequest($requessition_id, $product_code, $location_id)
    {
        return self::where('requesition_id', $requessition_id)
                    ->where('product_code', $product_code)
                    ->where('location_id', $location_id)
                    ->count();
    }

    public function resetStock()
    {
        $stock = Stock::where('product_id', $this->product_id)
           ->where('location_id', $this->location_id)
           ->first(['id', 'qty']);

        if($stock != null){
            $stock->qty += $this->qty;

            Log::debug('Requesition: reset item qty: success', [
                'product_id' => $this->product_id,
                'location_id' => $this->location_id,
                'qty_return' => $this->qty,
                'qty_total' => $stock->qty,
            ]);

            return $stock->save();
        }

        Log::debug('Requesition: reset item qty: error', [
            'product_id' => $this->product_id,
            'location_id' => $this->location_id,
            'qty_return' => $this->qty,
            'qty_total' => $stock->qty,
        ]);

        return false;
    }

    public function statusHtml()
    {
        return statusHtmlRender($this->status);
    }
}
