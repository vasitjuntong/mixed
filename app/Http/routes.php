<?php

get('/', 'HomeController@index');

// Component.
Route::group(['prefix' => 'receives'], function(){
	resource('/', 'ReceiveController');
	get('/add-products/{id}', 'ReceiveController@addProducts');
	post('/add-products/{receive_id}', 'ReceiveController@storeProducts');
	get('/review/{id}', 'ReceiveController@review');
});

get('/product-lists', 'ProductListController@index');

// Setting.
resource('/products', 'ProductController');
resource('/product-types', 'ProductTypeController');
resource('/units', 'UnitController');
resource('/locations', 'LocationController');
resource('/projects', 'ProjectController');

Route::group(['prefix' => 'api'], function(){
	get('product-typeahead', function(){

		$product = App\Product::select('id', 'code as name', 'mix_no', 'description')
			->orderBy('name', 'desc')
			->get();

		return $product;
	});
});