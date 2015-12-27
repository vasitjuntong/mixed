<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requesition extends Model
{
	protected $fillable = [

	];

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
    
    public static function whereByFilter(array $filter, $limit = 20)
    {
    	return static::with([
    		'user',
    		'project',
		])
			->paginate($limit);
    }
}
