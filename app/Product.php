<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const USE_SERIAL_NO = 'use_serian_no';
    const UNUSE_SERIAL_NO = 'unuse_serian_no';

    protected $baseDir = 'uploads/products';

    protected $fillable = [
        'product_type_id',
        'unit_id',
        'mix_no',
        'code',
        'description',
        'stock_min',
        'use_serial_no',
        'pic_path',
        'pic_name',
        'thumbnail_path',
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->stock_min == null) {
                $model->stock_min = 0;
            }
        });


        static::created(function ($model) {
            $model->mix_no = 100000 + $model->getKey();
            $model->save();

            foreach (Location::all() as $location) {
                $stock = new Stock([
                    'location_id' => $location->id,
                    'qty'         => 0,
                ]);

                $model->stock()->save($stock);
            }
        });

        static::deleting(function ($model) {
            $model->removePic();
        });
    }

    public function getOnHandAttribute()
    {
        return $this->stock()->sum('qty');
    }

    public function getOnStockAttribute()
    {
        return 0;
    }

    public function getOnOrderAttribute()
    {
        return 0;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

    public function receiveItems()
    {
        return $this->hasMany(ReceiveItem::class, 'product_id', 'id');
    }

    public static function whereByFilter(array $filter, $limit = 20)
    {

        return static::with([
            'unit',
            'productType',
            'receiveItems',
        ])
            ->where(function ($query) use ($filter) {
                $mix_no = array_get($filter, 'mix_no');
                if (!is_null($mix_no)) {
                    $query->where('mix_no', 'like', "%{$mix_no}%");
                }

                $code = array_get($filter, 'code');
                if (!is_null($code)) {
                    $query->where('code', 'like', "%{$code}%");
                }

                $description = array_get($filter, 'description');
                if (!is_null($description)) {
                    $query->where('description', 'like', "%{$description}%");
                }

                $unit = array_get($filter, 'unit');
                if (!is_null($unit)) {
                    $query->whereHas('unit', function ($query) use ($unit) {
                        $query->where('name', 'like', "%{$unit}%");
                    });
                }

            })
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public static function whereByFilterWithStock(array $filter, $limit = 20)
    {
        return static::with([
            'unit',
            'productType',
            'receiveItems',
            'stock',
        ])
            ->where(function ($query) use ($filter) {
                $mix_no = array_get($filter, 'mix_no');
                if (!is_null($mix_no)) {
                    $query->where('mix_no', 'like', "%{$mix_no}%");
                }

                $code = array_get($filter, 'code');
                if (!is_null($code)) {
                    $query->where('code', 'like', "%{$code}%");
                }

                $description = array_get($filter, 'description');
                if (!is_null($description)) {
                    $query->where('description', 'like', "%{$description}%");
                }

                $unit = array_get($filter, 'unit');
                if (!is_null($unit)) {
                    $query->whereHas('unit', function ($query) use ($unit) {
                        $query->where('name', 'like', "%{$unit}%");
                    });
                }

            })
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public static function deleteByCondition($id)
    {
        $query = Product::with([
            'receiveItems',
        ])
            ->where('id', $id)
            ->first();

        if ($query->receiveItems AND $query->receiveItems()->count()) {
            return [
                'status'  => false,
                'title'   => trans('product.label.name'),
                'message' => trans('product.message_alert.delete_unsuccess'),
            ];
        }

        $response = $query->delete();

        return [
            'status'  => $response,
            'title'   => trans('product.label.name'),
            'message' => trans('product.message_alert.delete_success'),
        ];
    }

    public static function named($name)
    {
        return (new static)->saveAs($name);
    }

    protected function saveAs($name)
    {
        $this->pic_name = sprintf('%s-%s', time(), $name);
        $this->pic_path = sprintf('%s/%s', $this->baseDir, $this->pic_name);
        $this->thumbnail_path = sprintf('%s/tn-%s', $this->baseDir, $this->pic_name);

        return $this;
    }

    public function move($file)
    {
        $file->move($this->baseDir, $this->pic_name);

        Image::make($this->pic_path)
            ->fit(200)
            ->save($this->thumbnail_path);

        return $this;
    }

    public function removePic()
    {
        if (file_exists($this->pic_path)) {
            unlink($this->pic_path);
        }

        if (file_exists($this->thumbnail_path)) {
            unlink($this->thumbnail_path);
        }
    }
}
