<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
	protected $primaryKey = 'product_id';

    protected $fillable = ['qty'];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
