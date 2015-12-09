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

	get('/receives/movement', 'ReceiveMovementController@index');
	get('/receives/movement/download-excel', 'ReceiveMovementController@downloadExcel');

	// Component.
	get('/receives/download-excel', 'ReceiveController@downloadExcel');
	resource('/receives', 'ReceiveController');
	get('/receives/add-products/{id}', 'ReceiveController@addProducts');
	post('/receives/add-products/{receive_id}', 'ReceiveController@storeProducts');
	get('/receives/review/{id}', 'ReceiveController@review');
	post('/receives/status-padding/{id}', 'ReceiveController@statusPadding');
	get('/receives/status-success/{id}', 'ReceiveController@statusSuccess');
	post('/receives/status-success/{id}', 'ReceiveController@storeStatusSuccess');
	post('/receives/status-cancel/{id}', 'ReceiveController@storeStatusCancel');
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
		$data = [];

		$products = App\Product::with([
				'unit'
			])
			->orderBy('code', 'desc')
			->get(['id', 'unit_id', 'code', 'mix_no', 'description']);

		foreach($products as $product){
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

get('/excel', function(){

	$receive = App\ReceiveItem::with([
			'receive',
			'receive.user',
			'product',
			'product.unit',
		])
		->get();

	dd($receive->toArray());

	Excel::create('Filename', function($excel) use ($receive) {

	    // Our first sheet
	    $excel->sheet('First sheet', function($sheet) use ($receive) {
	    	$sheet->setAutoSize(true);
			$sheet->row(1, array(
			     trans('receive.attributes.created_at'),
			     trans('receive.attributes.document_no'),
			     trans('receive.attributes.po_no'),
			     trans('receive.attributes.ref_no'),
			     trans('receive.attributes.project_code'),
			     trans('receive.attributes.create_by'),
			     trans('receive.attributes.remark'),
			     trans('receive_item.attributes.mix_no'),
			     trans('receive_item.attributes.product_code'),
			     trans('receive_item.attributes.location_id'),
			     trans('receive_item.attributes.product_description'),
			     trans('receive_item.attributes.unit'),
			     trans('receive_item.attributes.qty'),
			     trans('receive_item.attributes.remark'),
			     trans('receive_item.attributes.status'),
			));
			
			$sheet->row(1, function($row){

				$row->setBorder('solid', 'solid', 'solid', 'solid');

				$row->setFont(array(
				    'size'       => '16',
				    'bold'       =>  true
				));
			});

			$i = 2;

			foreach($receive as $item){
				$sheet->row($i, array(
					// Receive data
					$item->receive->created_at->format('d/m/Y H:i'),
					$item->receive->document_no,
					$item->receive->po_no,
					$item->receive->ref_no,
					$item->receive->project_code,
					$item->receive->user->name,
					$item->receive->remark,
					// Item
					$item->mix_no,
					$item->product_code,
					$item->location_name,
					$item->product_description,
					$item->product->unit->name,
					$item->qty,
					$item->remark,
					$item->status,
				));
				$i ++;
			}
	    });

	})->export('xls');
});

	