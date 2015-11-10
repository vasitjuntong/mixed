<?php

get('/', 'HomeController@index');

resource('/product-types', 'ProductTypeController');

resource('/products', 'ProductController');
resource('/units', 'UnitController');
resource('/locations', 'LocationController');
resource('/projects', 'ProjectController');