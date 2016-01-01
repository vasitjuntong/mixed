<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
});

Route::group(['middleware' => 'auth'], function () {
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

    Route::get('/dashboard', 'HomeController@index');
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/receives/movement', 'ReceiveMovementController@index');
    Route::get('/receives/movement/download-excel', 'ReceiveMovementController@downloadExcel');

    Route::get('/receive-upload/{id}', 'ReceiveItemUploadController@index');
    Route::post('/receive-upload/{id}', 'ReceiveItemUploadController@store');

    // Component.
    Route::get('/receives/download-excel', 'ReceiveController@downloadExcel');
    Route::resource('/receives', 'ReceiveController');
    Route::get('/receives/add-products/{id}', 'ReceiveController@addProducts');
    Route::post('/receives/add-products/{receive_id}', 'ReceiveController@storeProducts');
    Route::get('/receives/review/{id}', 'ReceiveController@review');
    Route::post('/receives/status-padding/{id}', 'ReceiveController@statusPadding');
    Route::get('/receives/status-success/{id}', 'ReceiveController@statusSuccess');
    Route::post('/receives/status-success/{id}', 'ReceiveController@storeStatusSuccess');
    Route::post('/receives/status-cancel/{id}', 'ReceiveController@storeStatusCancel');
    Route::post('/receives/update-qty', 'ReceiveController@updateQty');

    Route::resource('/requesitions', 'RequesitionController');
    Route::get('/requesitions/add-products/{id}', 'RequesitionController@addProducts');
    Route::post('/requesitions/add-products/{id}', 'RequesitionController@storeProduct');
    Route::post('/requesitions/status-padding/{id}', 'RequesitionController@statusPadding');
    Route::get('/requesitions/processes/{id}', 'RequesitionController@process');
    Route::post('/requesitions/process-success/{id}', 'RequesitionController@processSuccess');
    Route::post('/requesitions/process-cancel/{id}', 'RequesitionController@processCancel');

    Route::get('/requesition-movement', 'RequesitionMovementController@index');
    Route::get('/requesition-movement/download-excel', 'RequesitionMovementController@downloadExcel');

    Route::get('/requesition-upload/{id}', 'RequesitionItemUploadController@index');
    Route::post('/requesition-upload/{id}', 'RequesitionItemUploadController@store');

    Route::get('/product-lists', 'ProductListController@index');

    // Setting.
    Route::group(['middleware' => ['auth', 'product']], function () {
        Route::resource('/products', 'ProductController');
    });

    Route::group(['middleware' => ['auth', 'product_type']], function () {
        Route::resource('/product-types', 'ProductTypeController');
    });

    Route::group(['middleware' => ['auth', 'unit']], function () {
        Route::resource('/units', 'UnitController');
    });

    Route::group(['middleware' => ['auth', 'location']], function () {
        Route::resource('/locations', 'LocationController');
    });

    Route::group(['middleware' => ['auth', 'project']], function () {
        Route::resource('/projects', 'ProjectController');
    });

    Route::group(['middleware' => ['auth', 'user']], function () {
        Route::resource('/users', 'UserController');
        Route::get('/users/assign-role/{id}', 'UserController@assignRole');
        Route::post('/users/assign-role/{id}', 'UserController@storeAssignRole');
    });
});

Route::group(['prefix' => 'api'], function () {
    Route::get('product-typeahead', function () {
        $data = [];

        $products = App\Product::with([
            'unit',
        ])
            ->orderBy('code', 'desc')
            ->get(['id', 'unit_id', 'code', 'mix_no', 'description']);

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'name' => $product->code,
                'mix_no' => $product->mix_no,
                'description' => $product->description,
                'unit' => $product->unit->name,
            ];
        }

        return $data;
    });
});