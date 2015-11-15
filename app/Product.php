<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	const USE_SERIAL_NO 	= 'use_serian_no';
	const UNUSE_SERIAL_NO 	= 'unuse_serian_no';

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
		'created_at',
		'updated_at',
    ];
}
