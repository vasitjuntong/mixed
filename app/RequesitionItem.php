<?php

namespace App;

use Log;
use Illuminate\Database\Eloquent\Model;

class RequesitionItem extends Model
{
    const CREATE = 'create';
    const PADDING = 'padding';
    const SUCCESS = 'success';
    const CANCEL = 'cancel';

    protected $fillable = [
        'requesition_id',
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
        $product_code = array_get($data, 'product_code');
        $qty_request = array_get($data, 'qty');

        Log::debug('Requesition-item: data', [
            $data,
        ]);

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
            $data['status'] = self::CREATE;

            if(self::create($data)){
                $stock->qty = $stock->qty - $qty_hold;
                $stock->save();
            }
        }
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
