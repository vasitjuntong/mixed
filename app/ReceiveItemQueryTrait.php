<?php 

namespace App;

trait ReceiveItemQueryTrait
{
    public static function whereByFilterAll(array $filter, array $orderBy = array())
    {
        $model = static::select('receive_items.*')
            ->with([
                'receive',
                'receive.user',
                'product',
                'product.unit',
                'location',
            ])
            ->leftJoin('receives', 'receive_items.receive_id', '=', 'receives.id')
            ->join('products', 'receive_items.product_id', '=', 'products.id')
            ->join('locations', 'receive_items.location_id', '=', 'locations.id')
            ->join('users', 'receives.user_id', '=', 'users.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->join('projects', 'receives.project_id', '=', 'projects.id')
            ->where(function ($query) use ($filter) {
                $mix_no = array_get($filter, 'mix_no');
                if (!is_null($mix_no)) {
                    $query->where('receive_items.mix_no', 'like', "%{$mix_no}%");
                }

                $product_code = array_get($filter, 'product_code');
                if (!is_null($product_code)) {
                    $query->where('receive_items.product_code', 'like', "%{$product_code}%");
                }

                $po_no = array_get($filter, 'po_no');
                if (!is_null($po_no)) {
                    $query->whereHas('receive', function ($query) use ($po_no) {
                        $query->where('po_no', 'like', "%{$po_no}%");
                    });
                }

                $document_no = array_get($filter, 'document_no');
                if (!is_null($document_no)) {
                    $query->whereHas('receive', function ($query) use ($document_no) {
                        $query->where('document_no', 'like', "%{$document_no}%");
                    });
                }

                $ref_no = array_get($filter, 'ref_no');
                if (!is_null($ref_no)) {
                    $query->whereHas('receive', function ($query) use ($ref_no) {
                        $query->where('ref_no', 'like', "%{$ref_no}%");
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
                    $query->whereIn('receive_items.status', $item_status);
                }

                $created_at_start = array_get($filter, 'created_at_start');
                $created_at_end = array_get($filter, 'created_at_end');

                if ($created_at_start != null && $created_at_end != null) {
                    $created_at_start = changeFormatDateToDb($created_at_start);
                    $created_at_end = changeFormatDateToDb($created_at_end);

                    $query->whereHas('receive', function ($query) use ($created_at_start, $created_at_end) {
                        $query->whereBetween('receives.created_at', [
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
            $model->orderBy('receives.created_at', 'desc');
        }

        return $model->get();
    }

    public static function whereByFilter(array $filter, $limit = 20, array $orderBy = array())
    {
        $model = static::select('receive_items.*')
            ->with([
                'receive',
                'receive.user',
                'product',
                'product.unit',
                'location',
            ])
            ->leftJoin('receives', 'receive_items.receive_id', '=', 'receives.id')
            ->join('products', 'receive_items.product_id', '=', 'products.id')
            ->join('locations', 'receive_items.location_id', '=', 'locations.id')
            ->join('users', 'receives.user_id', '=', 'users.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->join('projects', 'receives.project_id', '=', 'projects.id')
            ->where(function ($query) use ($filter) {
                $mix_no = array_get($filter, 'mix_no');
                if (!is_null($mix_no)) {
                    $query->where('receive_items.mix_no', 'like', "%{$mix_no}%");
                }

                $product_code = array_get($filter, 'product_code');
                if (!is_null($product_code)) {
                    $query->where('receive_items.product_code', 'like', "%{$product_code}%");
                }
                
                $po_no = array_get($filter, 'po_no');
                if (!is_null($po_no)) {
                    $query->whereHas('receive', function ($query) use ($po_no) {
                        $query->where('po_no', 'like', "%{$po_no}%");
                    });
                }

                $document_no = array_get($filter, 'document_no');
                if (!is_null($document_no)) {
                    $query->whereHas('receive', function ($query) use ($document_no) {
                        $query->where('document_no', 'like', "%{$document_no}%");
                    });
                }

                $ref_no = array_get($filter, 'ref_no');
                if (!is_null($ref_no)) {
                    $query->whereHas('receive', function ($query) use ($ref_no) {
                        $query->where('ref_no', 'like', "%{$ref_no}%");
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
                    $query->whereIn('receive_items.status', $item_status);
                }

                $created_at_start = array_get($filter, 'created_at_start');
                $created_at_end = array_get($filter, 'created_at_end');

                if ($created_at_start != null && $created_at_end != null) {
                    $created_at_start = changeFormatDateToDb($created_at_start);
                    $created_at_end = changeFormatDateToDb($created_at_end);

                    $query->whereHas('receive', function ($query) use ($created_at_start, $created_at_end) {
                        $query->whereBetween('receives.created_at', [
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
            $model->orderBy('receives.created_at', 'desc');
        }

        $created_at_start = array_get($filter, 'created_at_start');
        $created_at_end = array_get($filter, 'created_at_end');

        if ($created_at_start == null && $created_at_end == null) {

            return new \Illuminate\Pagination\Paginator([], 20);
        }

        return $model->paginate($limit);
    }
}