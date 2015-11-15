<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	const USE_SERIAL_NO 	= 'use_serian_no';
	const UNUSE_SERIAL_NO 	= 'unuse_serian_no';

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

    public static function named($name)
    {
        return (new static )->saveAs($name);
    }

    protected function saveAs($name)
    {
        $this->pic_name       = sprintf('%s-%s', time(), $name);
        $this->pic_path       = sprintf('%s/%s', $this->baseDir, $this->pic_name);
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
}
