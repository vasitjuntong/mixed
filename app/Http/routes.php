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
	resource('/receives', 'ReceiveController');
	get('/receives/add-products/{id}', 'ReceiveController@addProducts');
	post('/receives/add-products/{receive_id}', 'ReceiveController@storeProducts');
	get('/receives/review/{id}', 'ReceiveController@review');
	post('/receives/status-padding/{id}', 'ReceiveController@statusPadding');
	get('/receives/status-success/{id}', 'ReceiveController@statusSuccess');
	post('/receives/status-success/{id}', 'ReceiveController@storeStatusSuccess');
	post('/receives/update-qty', 'ReceiveController@updateQty');

	get('/product-lists', 'ProductListController@index');

	// Setting.
	Route::group(['middleware' => ['auth', 'product']], function(){
		resource('/products', 'ProductController');
	});

	Route::group(['middleware' => ['auth', 'product_type']], function(){
		resource('/product-types', 'ProductTypeController');
	});

	Route::group(['middleware' => ['auth', 'unit']], function(){
		resource('/units', 'UnitController');
	});
	
	Route::group(['middleware' => ['auth', 'location']], function(){
		resource('/locations', 'LocationController');
	});
	
	Route::group(['middleware' => ['auth', 'project']], function(){
		resource('/projects', 'ProjectController');
	});

	Route::group(['middleware' => ['auth', 'user']], function(){
		resource('/users', 'UserController');
		get('/users/assign-role/{id}', 'UserController@assignRole');
		post('/users/assign-role/{id}', 'UserController@storeAssignRole');
	});
});

Route::group(['prefix' => 'api'], function(){
	get('product-typeahead', function(){

		$product = App\Product::select('id', 'code as name', 'mix_no', 'description')
			->orderBy('name', 'desc')
			->get();

		return $product;
	});
});
	