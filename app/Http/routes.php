<?php

Route::group(['middleware' => 'guest'], function(){
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
});

Route::group(['middleware' => 'auth'], function(){
	// Authentication routes...
	Route::get('auth/logout', 'Auth\AuthController@getLogout');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');

	get('/dashboard', 'HomeController@index');
	get('/', 'HomeController@index');
	get('/home', 'HomeController@index');
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
});
	