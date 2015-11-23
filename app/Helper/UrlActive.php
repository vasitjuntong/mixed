<?php 

namespace App\Helper;

use App\Http\Requests\Request;

class UrlActive{

	public function component()
	{
		$status = false;
		
		$url = [
			'product-lists',
			'product-lists/*',
			'receives',
			'receives/*',
		];

		foreach($url as $value){
			if(request()->is($value)){
				$status = true;

				break;
			}
		}

		return $status;
	}

	public function settings()
	{
		$status = false;

		$url = [
			'products',
			'products/*',
			'product-types',
			'product-types/*',
			'units',
			'units/*',
			'projects',
			'projects/*',
			'locations',
			'locations/*',
		];

		foreach($url as $value){
			if(request()->is($value)){
				$status = true;

				break;
			}
		}

		return $status;
	}
}