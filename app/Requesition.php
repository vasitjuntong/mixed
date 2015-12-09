<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requesition extends Model
{

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
    
    public function whereByFilter(array $filter, $limit)
    {
    	return static::with()
    }
}
