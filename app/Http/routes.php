<?php

get('/', 'HomeController@index');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

// Component.
Route::group(['prefix' => 'receives'], function(){
	resource('/', 'ReceiveController');
	get('/add-products/{id}', 'ReceiveController@addProducts');
	post('/add-products/{receive_id}', 'ReceiveController@storeProducts');
	get('/review/{id}', 'ReceiveController@review');
	post('/status-padding/{id}', 'ReceiveController@statusPadding');

	get('/status-success/{id}', 'ReceiveController@statusSuccess');
	post('/status-success/{id}', 'ReceiveController@storeStatusSuccess');
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