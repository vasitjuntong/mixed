<?php

get('/', 'HomeController@index');

resource('/products', 'ProductController');
resource('/units', 'UnitController');
resource('/locations', 'LocationController');
resource('/projects', 'ProjectController');