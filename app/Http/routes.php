<?php

get('/', 'HomeController@index');

// Component.
resource('/receives', 'ReceiveController');
get('/receives/add-products/{id}', 'ReceiveController@addProducts');

get('/product-lists', 'ProductListController@index');

// Setting.
resource('/products', 'ProductController');
resource('/product-types', 'ProductTypeController');
resource('/units', 'UnitController');
resource('/locations', 'LocationController');
resource('/projects', 'ProjectController');